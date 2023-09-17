<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class F_CategoryController extends Controller
{
    //

    // root page
    public function index()
    {
        $category = Category::where('category_status', 1)->get();
        $product = Product::where('status', '=', '1')->latest()->first();
        $today_deal = DB::table('products')->where('status', 1)->where('today_deal', 1)->orderBy('today_deal', 'DESC')->limit(5)->get();
        return view('frontend.layouts.main', compact('category', 'product', 'today_deal'));
    }

    // Singleproduct page calling
}
