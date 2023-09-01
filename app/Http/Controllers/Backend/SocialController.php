<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class SocialController extends Controller
{
    //
    public function create()
    {
        $social = Social::first();

        if ($social == Null) {
            return view('backend.setting.social_section.create');
        } else {
            return view('backend.setting.social_section.edit', compact('social'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'facebook' => 'required',
        ]);

        Social::insert([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'created_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Social Insert Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }

    public function update(Request $request)
    {
        $update = $request->id;

        Social::findOrFail($update)->update([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Social Update Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }
}
