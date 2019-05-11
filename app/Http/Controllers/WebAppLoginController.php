<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;

class WebAppLoginController extends Controller
{

    public function signUp(Request $request){
        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
//        Hash::make($request->password);
        $user->password = bcrypt($request->password);
        $user->save();
        return '회원가입 완료';
    }

    public function login(Request $request){
        $forms = [
            'email' =>$request['email'],
            'password' =>$request['password']
        ];
        if(Auth::attempt($forms, true)){
            $token = DB::table('users')->where('email',$forms['email'])->get();
            return $token;
        }
    }
}
