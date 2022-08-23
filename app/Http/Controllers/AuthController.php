<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;


class AuthController extends Controller
{
    public function getUserLogin(){
        return view('auth.loginform');
    }

    public function postUserLogin(LoginRequest $request){

        $username = $request->input('username');
        $password = $request->input('password');

        if (Auth::attempt(['username' => $username, 'password' => $password]))
        {
            return redirect()->route('home');
        }
        else return redirect()->route('auth.getLogin')->withErrors(['msg' => 'Lỗi đăng nhập, vui lòng thử lại!']);
    }

    public function getUserRegister(){
        return view('auth.registerform');
    }

    public function postUserRegister(RegisterRequest $request){

        $username = $request->input('username');
        $password = bcrypt($request->input('password')) ;
        $email = $request->input('email');
        $name = $request->input('name');

        $user = new User();
        $user->username = $username;
        $user->password = $password;
        $user->email = $email;
        $user->name = $name;

        $user->save();

        return redirect()->route('auth.getLogin')->with('msg', 'Bạn đã đăng kí thành công. Vui lòng đăng nhập!');

    }

    public function getUserLogout (Request $request){
        Auth::logout();
        return redirect()-> route('page.index');
    }

}
