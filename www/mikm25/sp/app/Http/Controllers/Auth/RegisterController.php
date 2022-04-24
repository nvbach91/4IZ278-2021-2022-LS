<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(Request $request): string
    {
        return view('auth.register', [
            'emailPrefill' => $request->get('email')
        ]);
    }
}
