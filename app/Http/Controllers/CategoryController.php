<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
        $categories = Category::withCount('posts')->get();
        return view('categories.index', compact('categories'));
    }
    public function edit($id){
        $category = Category::findorfail($id);
        return view('categories.create', compact('category'));
    }
    public function create(){
        return view('categories.create');
    }
    public function store(Request $request){

        $request->validate([
            'name' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        flash()->success('Category created Successfully');
        return redirect()->route('category.index');

    }
    public function update(Request $request, $id){
        $category = Category::findorfail($id);
        $request->validate([
            'name' => 'required',
        ]);
        $category->name = $request->name;
        $category->save();
        flash()->success('Category Updated Successfully');
        return redirect()->route('category.index');

    }

    public function delete($id){
        $category = Category::findorfail($id);
        $category->delete();
        flash()->success('Category deleted Successfully');
        return redirect()->route('category.index');
    }
}
