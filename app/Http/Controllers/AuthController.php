<?php

namespace App\Http\Controllers;

use App\LocalAuth;
use App\User;
use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register (Request $request)
    {
        $uname = $request->get('uname');
        $upwd = $request->get('upwd');
        $uconfirm_pwd = $request->get('uconfirm_pwd');
        $umail = $request->get('umail');

        //username is exists?
        $boo_name = LocalAuth::where('username', $uname)->exists();

        if(empty($uname) || empty($upwd) || empty($umail)){
            return response()->json([
                'code' => 451,
            ]);
        }else if($upwd != $uconfirm_pwd || !\MailValid::isEmail($umail) || strlen($uname) < 6 || strlen($upwd) < 6){
            return response()->json([
                'code' => 452,
            ]);
        }else if($boo_name){
            return response()->json([
                'code' => 453,
            ]);
        }else{
            $user = User::create([
                'name' => $uname,
                'email' => $umail,
            ]);
            $local_auth = LocalAuth::create([
                'username' => $uname,
                'password' => Hash::make($upwd),
                'email' => $umail,
                'phone' => '',
                'user_id' => $user->id,
                //'phone', 'email', 'password', 'username', 'user_id'
            ]);
            return response()->json([
                'code' => 200,
            ]);
        }
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
        }
    }
}
