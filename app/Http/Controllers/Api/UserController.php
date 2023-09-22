<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
}
