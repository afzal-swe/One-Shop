<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
// use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add To Cart Function Section
    public function add_to_cart(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        // $user_id = Auth::user()->id;

        // Cart::add([
        //     'id' => $product->id,
        //     'name' => $product->product_title,
        //     'price' => $product->product_price,
        //     'quantity' => $request->quantity_input,
        //     'weight' => '1',
        //     'options' => ['size' => $request->size, 'color' => $request->color, 'thumbnail' => $product->thumbnail]
        // ]);
    }
}
