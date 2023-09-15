<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Review;

class IndexController extends Controller
{
    //
    public function index($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $view_product = Product::where('slug', $slug)->increment('product_views');
        $review = Review::orderBy('id', 'DESC')->limit(6)->get();
        $related_product = Product::where('subcategory_id', $product->subcategory_id)->orderBy('id', 'DESC')->limit(10)->get();
        $featured = Product::where('status', 1)->orderBy('id', 'DESC')->limit(8)->get();
        $popular_product = Product::where('status', 1)->orderBy('product_views', 'DESC')->limit(8)->get();
        return view('frontend.product.product_details', compact('product', 'related_product', 'review', 'featured', 'popular_product'));
    }
}
