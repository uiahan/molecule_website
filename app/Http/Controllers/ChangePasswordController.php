<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function showChangePassword() {
        return view('admin.changePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!$user) {
            return back()->withErrors(['auth' => 'User not found or not authenticated.']);
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama salah.']);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->route('registration')->with('notif', 'Password berhasil diubah.');
    }
}
