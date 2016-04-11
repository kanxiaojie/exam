<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('auth.changePassword');
    }

    public function change(Request $request)
    {
        $messages = [
            'min' => '密码至少需要6个字符.'
        ];

        $this->validate($request, [
            'password' => 'required|confirmed|min:6'
        ], $messages);

        $user = Auth::user();
        $inputs = Input::all();
        $user->password = bcrypt($inputs['password']);
        $user->save();

        return back();
    }
}
