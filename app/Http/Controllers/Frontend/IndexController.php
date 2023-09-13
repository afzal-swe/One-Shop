<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

class IndexController extends Controller
{
    //
    public function index($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $related_product = Product::where('subcategory_id', $product->subcategory_id)->orderBy('id', 'DESC')->limit(10)->get();
        return view('frontend.product.product_details', compact('product', 'related_product'));
    }
}
