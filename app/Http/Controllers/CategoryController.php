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
}
