<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('user.login');
    }

    public function login()
    {
        //验证
        $this->validate(\request(),[
            'email' => 'required|email',
            'password' => 'required',
            'is_remember' => 'integer'
        ]);
        //逻辑
        $user = \request(['email','password']);
        $is_remember = boolval(\request('is_remember'));
        if (\Auth::attempt($user, $is_remember)) {
            return redirect('/posts');
        }
        //渲染
        return \Redirect::back()->withErrors('邮箱或者密码不正确！');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
