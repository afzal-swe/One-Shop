<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;

class ProductController extends Controller
{
    //
    public function index()
    {
    }

    public function create()
    {
        $brand = Brand::where('status', '=', "1")->get();
        $category = Category::where('category_status', '=', '1')->get();
        $subcategory = SubCategory::where('subcategory_status', '=', '1')->get();
    }
}
