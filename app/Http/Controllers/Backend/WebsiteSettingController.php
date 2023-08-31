<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class WebsiteSettingController extends Controller
{
    //
    public function create()
    {
        $setting = WebsiteSetting::find(1);

        if ($setting == Null) {
            return view('backend.setting.website_setting.create');
        } else {
            return view('backend.setting.website_setting.edit', compact('setting'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone_one' => 'required',
            'phone_two' => 'required',
        ]);

        $name = Str::of($request->website_name)->slug('-');

        if ($request->file('logo') || $request->file('favicon')) {

            $logo = $request->file('logo');
            $favicon = $request->file('favicon');

            $logo_name = $name . '.' . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(320, 120)->save("image/website/" . $logo_name);
            $logo_url = "image/website/" . $logo_name;

            $favicon_name = $name . '.' . $favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(32, 32)->save("image/website/" . $favicon_name);
            $favicon_url = "image/website/" . $favicon_name;

            WebsiteSetting::insert([
                'website_name' => $request->website_name,
                'currency' => $request->currency,
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'main_email' => $request->main_email,
                'support_email' => $request->support_email,
                'address' => $request->address,
                'description' => $request->description,
                'logo' => $logo_url,
                'favicon' => $favicon_url,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Website info added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            WebsiteSetting::insert([
                'website_name' => $request->website_name,
                'currency' => $request->currency,
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'main_email' => $request->main_email,
                'support_email' => $request->support_email,
                'address' => $request->address,
                'description' => $request->description,
                'created_at' => Carbon::now(),
            ]);
            $notification = array('messege' => 'Website info added Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }
}
