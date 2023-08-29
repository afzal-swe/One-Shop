<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function supper_admin()
    {
        if (Auth()->user()->is_admin == 1) {
            return view('backend.layouts.main');
        }
        return view('frontend.layouts.app');
    }
}
