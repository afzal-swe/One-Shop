<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChildCategory;



class ChildCategoryController extends Controller
{
    //
    public function index()
    {
        $child_category = ChildCategory::orderBy('id', 'DESC')->get();
        return view('backend.child_category.index', compact('child_category'));
    }
}
