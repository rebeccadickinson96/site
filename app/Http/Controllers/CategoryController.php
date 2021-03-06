<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    protected $pagination = 10;
    public function index()
    {
        $categories = Category::orderBy('id')->paginate($this->pagination);

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'category' => 'required|unique:categories,category',
            'description' => 'sometimes'
        ]);

        $category = Category::create([
            'category' => $request->input('category'),
            'description' => $request->input('description')
        ]);


        return redirect()->back()->with(['success' => 'Successfully added ' . $category->category]);
    }

    public function update(Category $category, Request $request)
    {
        $this->validate($request, [
            'category' => 'required|unique:categories,category,' . $category->id,
            'description' => 'sometimes'
        ]);

        $category->update([
            'category' => $request->input('category'),
            'description' => $request->input('description')
        ]);

        return redirect()->back()->with(['success' => 'Successfully updated category']);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with(['success' => 'Successfully deleted category.']);
    }

    public function filterTag(Category $tag){

        $posts = $tag->posts()->with('User')->isPublished()->orderBy('date_published', 'desc')->paginate($this->pagination);

        return view('posts', compact('posts'));
    }
}
