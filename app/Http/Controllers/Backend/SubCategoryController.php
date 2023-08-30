<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class SubCategoryController extends Controller
{
    //
    public function index()
    {
        $sub_category = SubCategory::all();
        return view('backend.subcategory.index', compact('sub_category'));
    }
}
