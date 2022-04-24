<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request): string
    {
        return view('auth.login', [
            'emailHint' => $request->get('email')
        ]);
    }

    public function login(LoginRequest $request)
    {
        dd($request->all());
    }
}
