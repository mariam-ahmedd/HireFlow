<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function create(){
        return view('auth.register') ;
    }

    public function store(Request $request){
        $attributes = $request->validate([
            'name' => ['required'] ,
            'email' => ['required' , 'email'] ,
            'password' => ['required' , 'confirmed'] ,
            'role'=>['required' , 'in:job_seeker,employer']
        ]);

        $user = User::create($attributes) ;
        Auth::login($user) ;
        if($user->role === 'job_seeker'){
            return redirect('/');
        }
        return redirect('/company-profile');



    }
}
