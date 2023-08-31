<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;


class SeoController extends Controller
{
    //
    public function create()
    {
        $seo = Seo::first();

        if ($seo !== Null) {
            return view('backend.setting.seo.edit', compact('seo'));
        } else {
            return view('backend.setting.seo.create');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'meta_author' => 'required',
            'meta_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'google_analytics' => 'required',
            'google_verification' => 'required',
            'alexa_analytics' => 'required',
        ]);

        Seo::insert([
            'meta_author' => $request->meta_author,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,
            'google_verification' => $request->google_verification,
            'alexa_analytics' => $request->alexa_analytics,
        ]);
        $notification = array('messege' => 'SEO Insert Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }

    public function update(Request $request)
    {
        $update = $request->id;

        Seo::findOrFail($update)->update([
            'meta_author' => $request->meta_author,
            'meta_title' => $request->meta_title,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,
            'google_verification' => $request->google_verification,
            'alexa_analytics' => $request->alexa_analytics,
        ]);
        $notification = array('messege' => 'SEO Update Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }
}
