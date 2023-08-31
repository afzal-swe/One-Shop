<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PageController extends Controller
{
    //
    public function index()
    {
        $page = Page::all();
        return view('backend.setting.page.index', compact('page'));
    }

    public function create()
    {

        return view('backend.setting.page.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_position' => 'required',
            'page_name' => 'required',
            'page_title' => 'required',
        ]);

        Page::insert([
            'page_position' => $request->page_position,
            'page_name' => $request->page_name,
            'page_title' => $request->page_title,
            'page_description' => $request->page_description,
            'page_slug' => Str::of($request->page_title)->slug('-'),
            'page_status' => $request->page_status,
            'created_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Create a New Page !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }
}
