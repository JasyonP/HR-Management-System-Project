<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        if (Auth::guard('web')->attempt(['username' => $request->username, 'password' => 
        $request->password])) {
        return redirect()->intended(route('employee.dashboard'));
     } else if (Auth::guard('staff')->attempt(['username' => $request->username, 'password' => 
        $request->password])) {
        return redirect()->intended(route('staff.dashboard'));
        }
        return back()->withErrors(['username' => 'Invalid credentials'])->withInput($request->only('username'));
    }

    public function logout()
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            return redirect('/');
        } else if (Auth::guard('staff')->check()) {
            Auth::guard('staff')->logout();
            return redirect('/');
        } 
    }
}
