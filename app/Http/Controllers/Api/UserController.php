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
    // Single or Multi Data Show api function.::::::::::::::
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


    // Add Multi Data API Function :::::::::::::::::::::::::::::::::::::::::
    public function addMultipleUser(Request $request)
    {
        if ($request->ismethod('post')) {

            $rules = [
                'users.*.name' => 'required',
                'users.*.user_name' => 'required',
                'users.*.phone' => 'required',
                'users.*.password' => 'required',
                'users.*.email' => 'required|email|unique:users',
            ];

            $coustomMessage = [
                'users.*.name.required' => 'Name is required',
                'users.*.email.required' => 'Email is required',
                'users.*.email.email' => 'Email must be a valid email',
                'users.*.password.required' => 'Password is required',
                'users.*.user_name.required' => 'user_name is required',
                'users.*.phone.required' => 'phone is required',
            ];

            $validator = Validator::make($request, $rules, $coustomMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422); // 422 means Error;
            }

            // User::insert([
            //     'name' => $request->name,
            //     'user_name' => $request->user_name,
            //     'email' => $request->email,
            //     'phone' => $request->phone,
            //     'password' => $request->password,
            //     'created_at' => Carbon::now(),
            // ]);
            // $message =  'New User Added Successfully !';
            // return  response()->json(['message' => $message], 201); // 201 means createded suuccessfylly, kono data successfully create korla 201 ase

            foreach ($request['users'] as $adduser) {
                $user = new User();
                $user->name = $adduser['name'];
                $user->user_name = $adduser['user_name'];
                $user->email = $adduser['email'];
                $user->phone = $adduser['phone'];
                $user->password = bcrypt($adduser['password']);
                $user->save();
                $message = "Multiple User Added Successfully";
            }
            return  response()->json(['message' => $message], 201); // 201 means createded suuccessfylly, kono data successfully create korla 201 ase
        }
    }
}
