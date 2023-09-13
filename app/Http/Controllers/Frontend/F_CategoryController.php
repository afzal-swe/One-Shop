<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class F_CategoryController extends Controller
{
    //

    // root page
    public function index()
    {
        $category = Category::where('category_status', 1)->get();
        $product = Product::where('status', '=', '1')->latest()->first();
        // return view('frontend.layouts.main', compact('category', 'product'));
        return view('frontend.layouts.main', compact('category', 'product'));
    }

    // Singleproduct page calling
}
