<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function loginPage(Request $request)
    {
        return view('dashboard.pages.login');
    }
    public function login(LoginRequest $request)
    {

        if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->has('remember'))) {
            return redirect()->route('dashboard.index');
        }
        return redirect()->back();
    }
}
