<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
   public function create(Request $request)
{
    $employer = $request->user()->employer;

    return view('employer.Company-profile', [
        'employer' => $employer,
    ]);
}

    public function store(Request $request)
    {
        if ($request->user()->employer) {
            return redirect('/');
        }


        $attributes = $request->validate([
            'name' => ['required'],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp'],
            'description' => ['nullable'],
            'website' => ['nullable', 'url'],
        ]);

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $attributes['logo'] = $logoPath;
        $attributes['user_id'] = Auth::id();

        Employer::create($attributes);

        return redirect('/');
    }
}
