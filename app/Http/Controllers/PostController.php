<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use App\Models\Views;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        if (auth()->user()->role === 'admin') {
            if ($request->has('view') && $request->get('view') === 'my') {
                $query = Post::where('user_id', $userId);
            } else {
                $query = Post::query();
            }
        } else {
            $query = Post::where('user_id', $userId);
        }
        if ($request->has('author') && !empty($request->author)) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->author . '%');
            });
        }
        if ($request->has('category_id') && !empty($request->category_id)) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }
        if ($request->has('post_id') && !empty($request->post_id)) {
            $query->where('id', $request->post_id);
        }
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        if (auth()->user()->role === 'admin' && (!request('view') || request('view') !== 'my')) {

            $posts = $query->with('user', 'category')
                ->withCount('views')
                ->orderBy('views_count', 'desc')
                ->paginate(10);
        } else {

            $posts = $query->with('user', 'category')
                ->withCount('views')
                ->latest()
                ->paginate(10);
        }
        $myPostsCount = Post::where('user_id', $userId)->count();
        $totalPostsCount = Post::count();
        $categories = Category::all();
        return view('posts.index', compact(
            'posts',
            'myPostsCount',
            'totalPostsCount',
            'categories'
        ));
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:unpublished,published'
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $imagePath;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;
        $post->status = $request->status;
        $post->save();

        flash()->success('Post Created Successfully');
        return redirect()->route('post.index');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('posts.create', ['post' => $post, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:unpublished,published'
        ]);

        $post = Post::findOrFail($id);
        $imagePath = $post->image; 

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($post->image && file_exists(public_path($post->image))) {
                unlink(public_path($post->image));
            }

            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }


        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $imagePath;
        $post->category_id = $request->category_id;
        $post->status = $request->status;
        $post->save();

        flash()->success('Post Updated Successfully');
        return redirect()->route('post.index');
    }
    public function delete($id)
    {
        $post = Post::findorfail($id);
        if ($post->image && file_exists(public_path('images/' . $post->image))) {
            unlink(public_path('images/' . $post->image));
        }
        $post->delete();
        flash()->success('Post Deleted Successfylly');
        return redirect()->route('post.index');
    }

    public function home(Request $request)
    {
        $query = Post::query();
        if ($request->has('search') && !empty($request->search)) {
            $query->wherehas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }
        $posts = $query->with('user', 'category')
            ->latest()
            ->get();
        $categories = Category::all();
        return view('index',  compact(
            'posts',
            'categories'
        ));
    }

    public function details($id)
    {
        $post = Post::with('user', 'category', 'comments')->findOrFail($id);
        if (auth()->id()) {
            $viewed = Views::where('user_id', auth()->id())->where('post_id', $post->id)->exists();
            if (!$viewed) {
                Views::create([
                    'user_id' => auth()->id(),
                    'post_id' => $post->id,
                    'ip' => 'testingIp'
                ]);
            }
        } else {
            $ipAdress = request()->ip();
            $viewedIp = Views::where('ip', $ipAdress)->where('post_id', $post->id)->exists();
            if (!$viewedIp) {
                Views::create([
                    'ip' => $ipAdress,
                    'post_id' => $post->id
                ]);
            }
        }
        $viewCount = Views::where('post_id', $post->id)->count();
        return view('posts.details', compact('post', 'viewCount'));
    }

    public function authorsPosts($id)
    {
        $author = User::findorfail($id);
        $posts = Post::with('user', 'category', 'views')->where('user_id', $id)->latest()->get();
        return view('author.index', compact('posts', 'author'));
    }
}
