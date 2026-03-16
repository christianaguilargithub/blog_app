<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user()->load('posts');
        return view('users.profile', compact('user'));
    }

    public function showUser(\App\Models\User $user)
    {
        $user->load('posts');
        return view('users.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'      => 'required|string|max:255',
            'about'     => 'nullable|string|max:1000',
            'twitter'   => 'nullable|string|max:255',
            'linkedin'  => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only('name', 'about', 'twitter', 'linkedin', 'instagram');

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }
}
