<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'These credentials do not match our records.'
            ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->role === 'job_seeker') {
            return redirect('/');
        } else {
            if (Auth::user()->employer) {
                return redirect('/');
            }

            return redirect('/company-profile');
        }
    }


    public function destroy(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/') ;
    }
}
