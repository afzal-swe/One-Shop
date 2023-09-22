<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class BrandApiController extends Controller
{
    // Show All brand api function
    public function index($id = null)
    {
        if ($id == '') {
            $brand  = Brand::get();
            return response()->json(['brands' => $brand], 200);
        } else {
            $brand  = Brand::find($id);
            return response()->json(['brands' => $brand], 200);
        }
    }

    // create brand api function
    public function store(Request $request)
    {
        if ($request->ismethod('post')) {
            $data = $request->all();

            return $data;
        }
    }
}
