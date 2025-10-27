<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->latest()->paginate(10);
        $totalCount = Category::count();
        return view('categories.index', compact('categories', 'totalCount'));
    }

    public function edit($id)
    {
        $category = Category::findorfail($id);
        return view('categories.create', compact('category'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        flash()
            ->option('position', 'bottom-right')  // Position on the screen
            ->option('timeout', 5000)           // How long to display (milliseconds)
            ->option('ltr', true)               // Right-to-left support
            ->success('Category Created Successfully!');
        return redirect()->route('category.index');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findorfail($id);
        $request->validate([
            'name' => 'required',
        ]);
        $category->name = $request->name;
        $category->save();
        flash()
            ->option('position', 'bottom-right')  // Position on the screen
            ->option('timeout', 5000)           // How long to display (milliseconds)
            ->option('ltr', true)               // Right-to-left support
            ->success('Category Updated Successfully!');
        return redirect()->route('category.index');
    }

    public function delete($id)
    {
        $category = Category::findorfail($id);
        $category->delete();
        flash()
            ->option('position', 'bottom-right')  // Position on the screen
            ->option('timeout', 5000)           // How long to display (milliseconds)
            ->option('ltr', true)               // Right-to-left support
            ->success('Category Deleted Successfully!');
        return redirect()->route('category.index');
    }

    // Add this autocomplete method for category search
    public function autocomplete(Request $request)
    {
        $search = $request->get('search', '');

        $categories = Category::select('id', 'name')
            ->when($search, function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('name')
            ->limit(10)
            ->get();

        return response()->json($categories);
    }
}
