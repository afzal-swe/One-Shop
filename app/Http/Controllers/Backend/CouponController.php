<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('coupons')->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $actionbtn = '<a href="' . route('coupon.edit', [$row->id]) . '" class="btn btn-info btn-sm edit" data-id="" data-toggle="modal" data-target="#editModal"  title="Edit Data"><i class="fas fa-edit"></i></a>
                <a href="' . route('coupon.destroy', [$row->id]) . '" id="delete" class="btn btn-danger btn-sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>';

                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.offer.coupon.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required',
        ]);

        Coupon::insert([
            'coupon_code' => $request->coupon_code,
            'valid_date' => $request->valid_date,
            'coupon_amount' => $request->coupon_amount,
            'status' => $request->status,
            'type' => $request->type,
            'created_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Coupon Create Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    // Edit coupon 
    public function edit($id)
    {
        $edit = Coupon::findOrFail($id);
        return view('backend.offer.coupon.edit', compact('edit'));
    }

    // Delete Coupon
    public function destroy($id)
    {

        // DB::table('coupons')->where('id', $id)->delete();
        Coupon::findOrFail($id)->delete();

        $notification = array('messege' => 'Coupon Delete Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
