<?php

namespace App\Http\Controllers;

use App\LocalAuth;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            $local_auth = Auth::user();
            $user = LocalAuth::where('user_id', $local_auth->user_id)->first()->user;
            echo($user->name);
        }
        echo('已退出登录');
        return view('index');
    }


    public function exits()
    {
        Auth::logout();
        return redirect('/');
    }
}
