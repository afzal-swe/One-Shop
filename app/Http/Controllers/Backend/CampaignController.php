<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class CampaignController extends Controller
{
    // Campaign All Info Show this function
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('campaigns')->orderBy('id', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<a href="#"><span class="badge badge-success">Active</span></a>';
                    } else {
                        return '<a href="#"><span class="badge badge-danger">Inactive</span></a>';
                    }
                })
                ->addColumn('action', function ($row) {

                    $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"  title="Edit Data"><i class="fas fa-edit"></i></a>
                <a href="' . route('campaign.destroy', $row->id) . '" id="delete" class="btn btn-danger btn-sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('backend.offer.campaign.index');
    }

    // Store Campaign in this function

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:campaigns|max:50',
            'image' => 'required',
        ]);

        if ($request->file('image')) {

            $name = Str::of($request->title)->slug('-');

            $img = $request->file('image');
            $name_gen = $name . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(468, 90)->save("image/campaign/" . $name_gen);
            $save_img = "image/campaign/" . $name_gen;

            Campaign::insert([
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'discount' => $request->discount,
                'slug' => $name,
                'image' => $save_img,
                'month' => date('F'),
                'year' => date('Y'),
                'status' => $request->status,
                'created_at' => Carbon::now(),

            ]);
            $notification = array('messege' => 'Campaign Create Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }


    // Delete Campaign Function

    public function destroy($id)
    {
        $file = Campaign::findOrFail($id);

        if ($file !== 'image') {
            $img = $file->image;
            unlink($img);

            Campaign::findOrFail($id)->delete();

            $notification = array('messege' => 'Campaign Delete Successfully', 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        }
    }


    // Edit Campaign Function
    public function edit($id)
    {
        $update = Campaign::find($id);
        return view('backend.category.edit', compact('update'));
    }
}
