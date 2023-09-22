<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function showUser($id = null)
    {
        // Don't any id than call this if condation after that show all user.
        if ($id == '') {
            $user = User::get();
            return response()->json(['users' => $user], 200); // 200 means Don't Error this code , Ok.
        } else {
            $user = User::find($id);
            return response()->json(['users' => $user], 200); // 200 means Don't Error this code , Ok.
        }
    }

    // create User api function
    public function store(Request $request)
    {
        if ($request->ismethod('post')) {

            $rules = [
                'name' => 'required',
                'password' => 'required',
                'email' => 'required|email|unique:users',
            ];

            $coustomMessage = [
                'name.required' => 'Name is required',
                'email.required' => 'Email is required',
                'email.email' => 'Email must be a valid email',
                'password.required' => 'Password is required',
            ];

            $validator = Validator::make($rules, $coustomMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422); // 422 means Error;
            }

            User::insert([
                'name' => $request->name,
                'user_name' => $request->user_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'created_at' => Carbon::now(),
            ]);
            $message =  'New User Added Successfully !';
            return  response()->json(['message' => $message], 201); // 201 means createded suuccessfylly, kono data successfully create korla 201 ase
        }
    }
}
