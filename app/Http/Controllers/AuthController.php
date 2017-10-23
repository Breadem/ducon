<?php

namespace App\Http\Controllers;

use App\LocalAuth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use League\Flysystem\Adapter\Local;

class AuthController extends Controller
{

    //判断是否是正确的邮箱格式;
    public function isEmail($email){
        $mode = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/';
        if(preg_match($mode,$email)){
            return true;
        }
        else{
            return false;
        }
    }
    //
    public function register (Request $request)
    {
        $uname = $request->get('uname');
        $upwd = $request->get('upwd');
        $uconfirm_pwd = $request->get('uconfirm_pwd');
        $umail = $request->get('umail');

        if(empty($uname) || empty($upwd) || empty($umail)){
            return response()->json([
                'code' => 451,
            ]);
        }else if($upwd != $uconfirm_pwd || !$this->isEmail($umail) || strlen($uname) < 6 || strlen($upwd) < 6){
            return response()->json([
                'code' => 452,
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
            dd('---');
        }
    }
}
