<?php

namespace App\Http\Controllers;

use App\LocalAuth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {
            $local_auth = Auth::user();
            $user = LocalAuth::where('user_id', $local_auth->user_id)->first()->user;
            $user->log_time = Carbon::now()->toDateTimeString();
            $user->save();
            echo($user->name);
        }else{
            echo('已退出登录');
        }
        return view('index');
    }


    public function exits()
    {
        Auth::logout();
        return redirect('/');
    }
}
