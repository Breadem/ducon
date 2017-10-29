<?php

namespace App\Http\Controllers;

use App\LocalAuth;
use App\User;
use function foo\func;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    public function register (Request $request)
    {
        $this->validate($request, [
            'username' => 'required|between:4,16|unique:user,name|alpha_dash',
            'password' => 'required|between:6,12|confirmed',
            'email' => 'required|email|unique:user,email'
        ]);

        $userId = DB::table('user')->insertGetId([
            'name' => $request->get('username'),
            'email' => $request->get('email'),
            'reg_time' =>  Carbon::now()->toDateTimeString(),
        ]);
        $local_auth = LocalAuth::create([
            'username' => $request->get('username'),
            'password' => Hash::make($request->get('password')),
            'email' => $request->get('email'),
            'phone' => '',
            'user_id' => $userId,
            //'phone', 'email', 'password', 'username', 'user_id'
        ]);
        return response()->json([
            'code' => 200,
            'url' => url('/login')
        ]);
    }

    public function login(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $validName = (Auth::attempt(['username' => $username, 'password' => $password]));
        $validMail = (Auth::attempt(['email' => $username, 'password' => $password]));
        if($validName || $validMail){
            return redirect()->intended('/');
        }else{
            return redirect('/login')->with('status', '用户名或密码错误，请重新输入！');
        }
    }

}
