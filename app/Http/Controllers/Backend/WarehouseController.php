<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Warehouse;
use Illuminate\Support\Carbon;

class WarehouseController extends Controller
{
    //
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = DB::table('warehouses')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $actionbtn = '<a href="#" class="btn btn-info btn-sm edit" data-id="' . $row->id . '" data-toggle="modal" data-target="#editModal"  title="Edit Data"><i class="fas fa-edit"></i></a>
                    <a href="' . route('warehouse.delete', [$row->id]) . '" id="delete" class="btn btn-danger btn-sm delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>';

                    return $actionbtn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.warehouse.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'warhouse_name' => 'required',
        ]);

        Warehouse::insert([
            'warhouse_name' => $request->warhouse_name,
            'warhouse_address' => $request->warhouse_address,
            'warhouse_phone' => $request->warhouse_phone,
            'created_at' => Carbon::now(),
        ]);
        $notification = array('messege' => 'Warehouse Successfully Added', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
