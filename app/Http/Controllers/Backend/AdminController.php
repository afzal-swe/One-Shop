<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{

    public function supper_admin()
    {
        $today_deal = DB::table('products')->where('status', 1)->where('today_deal', 1)->orderBy('today_deal', 'DESC')->limit(5)->get();
        if (Auth()->user()->is_admin == 1) {
            return view('backend.layouts.main');
        }
        return view('frontend.layouts.main', compact('today_deal'));

        $notification = array('message' => 'Login Successfully', 'alert-type' => 'success');
    }

    public function change_password()
    {
        return view('backend.profile.change_password');
    }

    public function password_update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
            // 'password_confirmation' => 'required',
        ]);

        $current_password = Auth::user()->password;

        $oldpass = $request->old_password;
        $newpass = $request->password;

        if (Hash::check($oldpass, $current_password)) {
            $user = User::findOrFail(Auth::id());

            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();


            $notification = array('messege' => 'Password Change Successfully !', 'alert-type' => 'success');
            return redirect()->route('login')->with($notification);
        } else {
            $notification = array('messege' => 'Old Password Not Matched !', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
}
