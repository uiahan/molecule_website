<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function user()
    {
        $user = FacadesAuth::user();
        $userr = User::where('role', '!=', 'superadmin')->get();
        return view('admin.user.user', compact('userr', 'user'));
    }

    public function tambahUser()
    {
        $user = FacadesAuth::user();
        return view('admin.user.tambah', compact('user'));
    }

    public function editUser($id)
    {
        $user = FacadesAuth::user();
        $userr = User::findOrFail($id);
        return view('admin.user.edit', compact('user', 'userr'));
    }

    public function resetpw($id)
    {
        $user = FacadesAuth::user();
        $userr = User::findOrFail($id);
        return view('admin.user.resetpw ', compact('user', 'userr'));
    }

    public function postTambahUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required',
            'password' => 'required|string|confirmed|min:8',
            'photo' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $fotoPath = null;
        if ($request->hasFile('photo')) {
            $foto = $request->file('photo');
            $fotoName = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('img'), $fotoName);
            $fotoPath = 'img/' . $fotoName;
        }

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'admin',
            'photo' => $fotoPath,
        ]);

        return redirect()->route('user')->with('notif', 'User baru berhasil ditambahkan!');
    }

    public function postHapusUser($id)
    {
        $userr = User::findOrFail($id);
        $userr->delete();

        return redirect()->back()->with('notif', 'User berhasil dihapus.');
    }

    public function postEditUser(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required',
            'photo' => 'nullable',
        ]);

        $userr = User::findOrFail($id);

        $fotoPath = $userr->foto ?? ''; // Gunakan string kosong jika null
if ($request->hasFile('photo')) {
    if (!empty($fotoPath) && Storage::exists($fotoPath)) {
        Storage::delete($fotoPath);
    }

    $foto = $request->file('photo');
    $fotoName = time() . '-' . $foto->getClientOriginalName();
    $fotoPath = 'img/' . $fotoName;

    $foto->move(public_path('img'), $fotoName);
}


        $userr->update([
            'name' => $request->name,
            'photo' => $fotoPath,
            'email' => $request->email,
        ]);

        return redirect()->route('user')->with('notif', 'User berhasil di ubah.');
    }

    public function postResetPassword(Request $request, $id)
    {

        $user = FacadesAuth::user();
        $userr = User::findOrFail($id);

        if ($user->role !== 'admin') {
            $request->validate([
                'old_password' => 'required|string',
            ]);

            if (!Hash::check($request->old_password, $userr->password)) {
                return redirect()->back()->withErrors(['old_password' => 'Password lama yang Anda masukkan salah.']);
            }
        }

        $validated = $request->validate([
            'new_password' => 'required|string|min:8',
        ]);

        $userr->password = bcrypt($request->new_password);
        $userr->save();

        return redirect()->route('user')->with('notif', 'Password berhasil di reset.');
    }
}
