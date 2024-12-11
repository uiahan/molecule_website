<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LogoController extends Controller
{
    public function logo() {
        $user = FacadesAuth::user();
        $logo = Logo::first()->get();

        return view('admin.logo.logo', compact('logo', 'user'));
    }

    public function logoEdit(Request $request, $id) {
        // Validate the input
        $request->validate([
            'img' => 'nullable',
        ]);
    
        // Find the existing news item
        $news = Logo::findOrFail($id);
    
        // If a new image is uploaded, handle it
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            $coverPath = $file->move(public_path('img'), $fileName);
    
            // Copy the file to the Flutter project directory
            $flutterImagePath = 'D:\projekflutter\molecule_scan\img\\' . $fileName;
            copy(public_path('img') . '\\' . $fileName, $flutterImagePath);
    
            // Update the image path in the database
            $news->img = $fileName;
        }
    
        $news->save(); // Save the changes to the database
        return redirect()->back()->with('notif', 'Logo berhasil diubah.');
    }    
}
