<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $brand = Brand::all();
        $category = Category::orderBy('id', 'DESC')->get();
        return view('backend.category.index', compact('category', 'brand'));
    }
}
