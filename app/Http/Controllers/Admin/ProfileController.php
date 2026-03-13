<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller {
    public function edit() {
        $profile = Profile::firstOrNew([]);
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request) {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'title'             => 'required|string|max:255',
            'tagline'           => 'nullable|string',
            'bio'               => 'required|string',
            'email'             => 'required|email',
            'phone'             => 'nullable|string|max:20',
            'location'          => 'nullable|string|max:255',
            'github'            => 'nullable|url',
            'linkedin'          => 'nullable|url',
            'twitter'           => 'nullable|url',
            'facebook'          => 'nullable|url',
            'projects_count'    => 'nullable|integer',
            'years_experience'  => 'nullable|integer',
            'clients_count'     => 'nullable|integer',
            'github_stars'      => 'nullable|integer',
            'available_for_work'=> 'boolean',
            'profile_photo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'cv_file'           => 'nullable|mimes:pdf|max:5120',
        ]);

        $profile = Profile::firstOrNew([]);

        if ($request->hasFile('profile_photo')) {
            if ($profile->profile_photo) Storage::disk('public')->delete($profile->profile_photo);
            $data['profile_photo'] = $request->file('profile_photo')->store('profile', 'public');
        }
        if ($request->hasFile('cv_file')) {
            if ($profile->cv_file) Storage::disk('public')->delete($profile->cv_file);
            $data['cv_file'] = $request->file('cv_file')->store('cv', 'public');
        }

        $profile->fill($data)->save();
        return back()->with('success', 'Profile updated successfully!');
    }
}