<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $profile = $request->user()->profile;

        return view('profile.show', ['profile' => $profile]);
    }

    public function edit(Request $request)
    {
        $profile = $request->user()->profile;

        return view('profile.edit', ['profile' => $profile]);
    }

    public function update(Request $request)
    {
        $attributes = $request->validate([
            'headline' => ['nullable'],
            'bio' => ['nullable'],
            'location' => ['nullable'],
            'phone' => ['nullable'],
            'github' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'portfolio' => ['nullable', 'url'],
            'skills' => ['nullable'],
            'education' => ['nullable'],
            'experience' => ['nullable'],
            'languages' => ['nullable'],
            'profile_photo' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('profile_photo')) {
            $attributes['profile_photo'] = $request->file('profile_photo')->store('profile-photos', 'public');
        }

        $profile = $request->user()->profile;

        if ($profile) {
            $profile->update($attributes);
        } else {
            $request->user()->profile()->create($attributes);
        }

        return redirect('/profile');
    }
}
