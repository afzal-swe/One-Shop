<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    //
    public function index()
    {

        $brand = Brand::orderBy('id', 'DESC')->get();

        return view('backend.brand.index', compact('brand'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:brands|max:50',
            'image' => 'required',
        ]);

        if ($request->file('image')) {

            $name = Str::of($request->name)->slug('-');

            $img = $request->file('image');
            $name_gen = $name . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(240, 120)->save("image/brand/" . $name_gen);
            $save_img = "image/brand/" . $name_gen;

            Brand::insert([
                'name' => $request->name,
                'image' => $save_img,
                'status' => $request->status,

            ]);
            $notification = array('messege' => 'Brand Insert Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }

    public function edit($id)
    {
        $edit = Brand::find($id);
        return view('backend.brand.edit', compact('edit'));
    }

    public function update(Request $request)
    {
        $update = $request->id;
        $file = Brand::findOrFail($update);

        if ($request->file('image')) {

            $img = $file->image;
            unlink($img);

            $name = Str::of($request->name)->slug('-');

            $img = $request->file('image');

            $name_gen = $name . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(240, 120)->save("image/brand/" . $name_gen);

            $save_img = "image/brand/" . $name_gen;

            Brand::findOrFail($update)->update([
                'name' => $request->name,
                'image' => $save_img,

            ]);
            $notification = array('messege' => 'Brand Insert Successfully', 'alert-type' => 'success');
            return redirect()->route('brand.index')->with($notification);
        } else {
            Brand::findOrFail($update)->update([
                'name' => $request->name,
            ]);
            $notification = array('messege' => 'Brand Insert Successfully', 'alert-type' => 'success');
            return redirect()->route('brand.index')->with($notification);
        }
    }

    public function destroy($id)
    {

        $file = Brand::findOrFail($id);

        if ($file !== 'image') {
            $img = $file->image;
            unlink($img);

            Brand::findOrFail($id)->delete();

            $notification = array('messege' => 'Brand Delete Successfully', 'alert-type' => 'success');
            return redirect()->route('brand.index')->with($notification);
        }
    }
}
