<?php

namespace App\Http\Controllers;

use App\LocalAuth;
use App\User;
use Illuminate\Http\Request;
use League\Flysystem\Adapter\Local;

class AuthController extends Controller
{
    //
    public function register (Request $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('mail'),
        ]);
        $local_auth = LocalAuth::create([
            'username' => $request->get('name'),
            'password' => $request->get('pwd'),
            'email' => $request->get('mail'),
            'phone' => '',
            'user_id' => $user->id,
            //'phone', 'email', 'password', 'username', 'user_id'
        ]);
        return response()->json([
            'code' => 404,
        ]);
    }
}
