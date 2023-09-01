<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Smtp;

class SmtpController extends Controller
{
    //
    public function create()
    {
        $smtp = Smtp::first();

        if ($smtp == Null) {
            return view('backend.setting.smtp_section.create');
        } else {
            return view('backend..setting.smtp_section.edit', compact('smtp'));
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'mailer' => 'required',
        ]);

        Smtp::insert([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'user_name' => $request->user_name,
            'password' => $request->password,
        ]);
        $notification = array('messege' => 'SMTP Added Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }

    public function update(Request $request)
    {
        $update = $request->id;

        Smtp::findOrFail($update)->update([
            'mailer' => $request->mailer,
            'host' => $request->host,
            'port' => $request->port,
            'user_name' => $request->user_name,
            'password' => $request->password,
        ]);
        $notification = array('messege' => 'SMTP Update Successfully !!', 'alert-type' => "success");
        return redirect()->back()->with($notification);
    }
}
