<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Piceup_point;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;

class Pickup_pointController extends Controller
{
    //
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('piceup_points')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="" data-toggle="modal" data-target="#editModal"  title="Edit Data"><i class="fas fa-edit"></i></a>
                <a href="' . route('pickup_point.delete', [$row->id]) . '" id="delete" class="btn btn-danger btn-sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.pickup_point.index');
    }

    public function store(Request $request)
    {

        Piceup_point::insert([
            'pickup_point_name' => $request->pickup_point_name,
            'pickup_point_address' => $request->pickup_point_address,
            'pickup_point_phone' => $request->pickup_point_phone,
            'pickup_point_phone_two' => $request->pickup_point_phone_two,
            'created_at' => Carbon::now(),
        ]);
        return response()->json('Successfully Insert!');
    }

    public function destroy($id)
    {

        Piceup_point::findOrFail($id)->delete();

        $notification = array('messege' => 'Brand Insert Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
