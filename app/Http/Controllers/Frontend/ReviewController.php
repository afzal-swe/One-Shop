<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);

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
