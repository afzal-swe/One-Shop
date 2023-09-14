<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);

        $check = DB::table('reviews')->where('user_id', Auth::id())->where('product_id', $request->product_id)->first();

        if ($check) {
            $notification = array('messege' => 'Already you have a review', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        } else {
            Review::insert([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'review_date' => date('d-m-Y'),
                'review_year' => date('Y'),
                'rating' => $request->rating,
                'review' => $request->review,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Thank for your Review', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }

    public function store_wishlist($id)
    {
        $check = DB::table('wishlists')->where('product_id', $id)->where('user_id', Auth::id())->first();

        if ($check) {
            $notification = array('messege' => 'Already have it on your wishlist !', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        } else {
            Wishlist::insert([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Product add on wishlist !', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }
}
