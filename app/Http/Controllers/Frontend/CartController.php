<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Darryldecode\Cart\Cart;

class CartController extends Controller
{
    // Add To Cart Function Section
    public function add_to_cart(Request $request)
    {
        $product = Product::where('id', $request->id)->first();

        // Cart::add();
    }
}
