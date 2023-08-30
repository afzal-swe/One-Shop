<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $brand = Brand::all();
        $category = Category::orderBy('id', 'DESC')->get();
        return view('backend.category.index', compact('category', 'brand'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'category_name' => 'required',
        ]);

        Category::insert([
            'brand_id' => $request->brand_id,
            'category_name' => $request->category_name,
            'category_status' => $request->category_status,
            'category_slug' => Str::of($request->category_name)->slug('-'),
            'created_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Category Added Successfully', 'alert-type' => 'success');
        return redirect()->route('category.index')->with($notification);
    }

    public function edit($id)
    {
        $brand = Brand::all();
        $edit = Category::find($id);
        return view('backend.category.edit', compact('edit', 'brand'));
    }

    public function update(Request $request)
    {
        $update = $request->id;

        Category::findOrFail($update)->update([
            'brand_id' => $request->brand_id,
            'category_name' => $request->category_name,
            'category_slug' => Str::of($request->category_name)->slug('-'),
            'updated_at' => Carbon::now(),

        ]);
        $notification = array('messege' => 'Category Update Successfully', 'alert-type' => 'success');
        return redirect()->route('category.index')->with($notification);
    }

    public function destroy($id)
    {

        Category::findOrFail($id)->delete();

        $notification = array('messege' => 'Category Delete Successfully', 'alert-type' => 'success');
        return redirect()->route('category.index')->with($notification);
    }
}
