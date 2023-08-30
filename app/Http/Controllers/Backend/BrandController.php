<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

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
            'name' => 'required|unique:' . Brand::class,
        ]);

        Brand::insert([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        $notification = array('messege' => 'Brand Insert Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $edit = Brand::find($id);
        return view('backend.brand.edit', compact('edit'));
    }

    public function update(Request $request)
    {
        $update = $request->id;
        Brand::findOrFail($update)->update([
            'name' => $request->name,
        ]);
        $notification = array('messege' => 'Brand Update Successfully', 'alert-type' => 'success');
        return redirect()->route('brand.index')->with($notification);
    }

    public function destroy($id)
    {

        Brand::findOrFail($id)->delete();

        $notification = array('messege' => 'Brand Delete Successfully', 'alert-type' => 'success');
        return redirect()->route('brand.index')->with($notification);
    }
}