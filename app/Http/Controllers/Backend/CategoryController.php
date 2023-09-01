<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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

        $slug = Str::of($request->category_name)->slug('-');

        if ($request->file('image')) {
            $img = $request->image;

            $name_gen = $slug . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(240, 120)->save("image/category/" . $name_gen);

            $save_img = "image/category/" . $name_gen;

            Category::insert([
                'brand_id' => $request->brand_id,
                'category_name' => $request->category_name,
                'category_status' => $request->category_status,
                'category_slug' => $slug,
                'image' => $save_img,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Category Added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            Category::insert([
                'brand_id' => $request->brand_id,
                'category_name' => $request->category_name,
                'category_status' => $request->category_status,
                'category_slug' => $slug,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Category Added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
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

        $file = Category::findOrFail($update);

        $slug = Str::of($request->category_name)->slug('-');

        if ($request->file('image')) {

            $img = $file->image;
            unlink($img);

            $img = $request->file('image');

            $img_name = $slug . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(240, 120)->save("image/category/" . $img_name);

            $img_url = "image/category/" . $img_name;

            Category::findOrFail($update)->update([
                'brand_id' => $request->brand_id,
                'category_name' => $request->category_name,
                'category_slug' => $slug,
                'image' => $img_url,
                'updated_at' => Carbon::now(),

            ]);
            $notification = array('messege' => 'Category Update Successfully', 'alert-type' => 'success');
            return redirect()->route('category.index')->with($notification);
        } else {
            Category::findOrFail($update)->update([
                'brand_id' => $request->brand_id,
                'category_name' => $request->category_name,
                'category_slug' => $slug,
                'updated_at' => Carbon::now(),

            ]);
            $notification = array('messege' => 'Category Update Successfully', 'alert-type' => 'success');
            return redirect()->route('category.index')->with($notification);
        }
    }

    public function destroy($id)
    {

        $file = Category::findOrFail($id);

        if ($file !== 'image') {
            $img = $file->image;
            unlink($img);

            Category::findOrFail($id)->delete();

            $notification = array('messege' => 'Category Delete Successfully', 'alert-type' => 'success');
            return redirect()->route('category.index')->with($notification);
        } else {
            Category::findOrFail($id)->delete();

            $notification = array('messege' => 'Category Delete Successfully', 'alert-type' => 'success');
            return redirect()->route('category.index')->with($notification);
        }
    }
}
