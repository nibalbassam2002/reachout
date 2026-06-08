<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        return view('dashboard.profile.index', [
            'user' => Auth::user()
        ]);
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        User::where('id', Auth::id())->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success_info', 'Profile information updated successfully ✓');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::find(Auth::id());

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors(['current_password' => 'The current password you entered is incorrect.'])
                ->with('tab', 'password');
        }

        User::where('id', Auth::id())->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success_password', 'Password changed successfully ✓');
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = User::find(Auth::id());

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $path = $request->file('avatar')->store('avatars', 'public');

        User::where('id', Auth::id())->update(['avatar' => $path]);

        return back()->with('success_avatar', 'Profile photo updated successfully ✓');
    }
}