<?php

namespace App\Http\Controllers;

use App\LocalAuth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\Adapter\Local;

class AuthController extends Controller
{
    //
    public function register (Request $request)
    {
        $user = User::create([
            'name' => $request->get('uname'),
            'email' => $request->get('umail'),
        ]);
        $local_auth = LocalAuth::create([
            'username' => $request->get('uname'),
            'password' => Hash::make($request->get('upwd')),
            'email' => $request->get('umail'),
            'phone' => '',
            'user_id' => $user->id,
            //'phone', 'email', 'password', 'username', 'user_id'
        ]);
        return response()->json([
            'code' => 404,
        ]);
    }
}
