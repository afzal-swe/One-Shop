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

            $validator = Validator::make($request['users'], $rules, $coustomMessage);

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

    // Update User Info API Function
    public function UpdateUserInfo(Request $request, $id)
    {
        if ($request->ismethod('put')) {

            $rules = [
                'name' => 'required',
            ];

            $coustomMessage = [
                'name.required' => 'Name is required',
            ];

            $validator = Validator::make($rules, $coustomMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422); // 422 means Error;
            }

            User::findOrFail($id)->update([
                'name' => $request->name,
                'user_name' => $request->user_name,
                'phone' => $request->phone,
                'updated_at' => Carbon::now(),
            ]);
            $message =  'User Update Successfully !';
            return  response()->json(['message' => $message], 202); // 201 means createded suuccessfylly, kono data successfully update korla 202 ase
        }
    }
    // Patch Api for Update User Info API Function
    public function UpdateSingleRecord(Request $request, $id)
    {
        if ($request->ismethod('patch')) {

            $rules = [
                'name' => 'required',
            ];

            $coustomMessage = [
                'name.required' => 'Name is required',
            ];

            $validator = Validator::make($rules, $coustomMessage);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422); // 422 means Error;
            }

            User::findOrFail($id)->update([
                'name' => $request->name,
                'user_name' => $request->user_name,
                'phone' => $request->phone,
                'updated_at' => Carbon::now(),
            ]);
            $message =  'User Update Single Record Successfully !';
            return  response()->json(['message' => $message], 202); // 201 means createded suuccessfylly, kono data successfully update korla 202 ase
        }
    }
    // Delete API for Delete Single user Function
    public function DeleteSingleRecord($id = null)
    {
        User::findOrFail($id)->delete();

        $message =  'Single User Delete Successfully !';
        return  response()->json(['message' => $message], 200); // 201 means createded suuccessfylly, kono data successfully ok korla 200 ase
    }

    // Delete Api for Delete Multiple user
    public function DeleteMultipleRecord($ids)
    {
        $ids = explode(',', $ids);
        User::whereIn('id', $ids)->delete();

        $message =  'Multiple User Delete Successfully !';
        return  response()->json(['message' => $message], 200); // 201 means createded suuccessfylly, kono data successfully ok korla 200 ase
    }

    // Delete API for Delete Single user with Json formet Function
    public function DeleteSingleRecordJson(Request $request)
    {
        if ($request->ismethod('delete')) {
            $data = $request->all();
            User::where('id', "=", $data['id'])->delete();

            $message =  'Single User Delete With Json Formet Successfully !';
            return  response()->json(['message' => $message], 200); // 201 means createded suuccessfylly, kono data successfully ok korla 200 ase
        }
    }

    // Delete API for delete multiple user with json formate.
    public function DeleteMultipleRecordJson(Request $request)
    {
        if ($request->ismethod('delete')) {
            $data = $request->all();
            User::whereIn('id', $data['ids'])->delete();

            $message =  'Multiple User Delete With Json Formate Successfully !';
            return  response()->json(['message' => $message], 200); // 201 means createded suuccessfylly, kono data successfully ok korla 200 ase
        }
    }
}
