<?php

namespace App\Http\Controllers;

use App\LocalAuth;
use App\User;
use function foo\func;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register (Request $request)
    {
//        $uname = $request->get('uname');
//        $upwd = $request->get('upwd');
//        $uconfirm_pwd = $request->get('uconfirm_pwd');
//        $umail = $request->get('umail');
//
//        //username is exists?
//        $boo_name = LocalAuth::where('username', $uname)->exists();
//
//        if(empty($uname) || empty($upwd) || empty($umail)){
//            return response()->json([
//                'code' => 451,
//            ]);
//        }else if($upwd != $uconfirm_pwd || !\MailValid::isEmail($umail) || strlen($uname) < 6 || strlen($upwd) < 6){
//            return response()->json([
//                'code' => 452,
//            ]);
//        }else if($boo_name){
//            return response()->json([
//                'code' => 453,
//            ]);
//        }else{
//            $userId = DB::table('user')->insertGetId([
//                'name' => $uname,
//                'email' => $umail,
//                'reg_time' =>  Carbon::now()->toDateTimeString(),
//            ]);
//            $local_auth = LocalAuth::create([
//                'username' => $uname,
//                'password' => Hash::make($upwd),
//                'email' => $umail,
//                'phone' => '',
//                'user_id' => $userId,
//                //'phone', 'email', 'password', 'username', 'user_id'
//            ]);
//            return response()->json([
//                'code' => 200,
//                'url' => url('/login')
//            ]);
//        }

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
        $uname = $request->get('uname');
        $upwd = $request->get('upwd');
        $validName = (Auth::attempt(['username' => $uname, 'password' => $upwd]));
        $validMail = (Auth::attempt(['email' => $uname, 'password' => $upwd]));
        var_dump($validName);
        if($validName || $validMail){
            return redirect()->intended('/');
        }else{
            return redirect('/login')->with('status', '用户名或密码错误，请重新输入！');
        }
    }
}
