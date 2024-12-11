<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class ToastController extends Controller
{
    public function update(Request $request, $id)
    {
        $attendance = Registration::findOrFail($id);

        $request->validate([
            'telah_scan' => 'required|in:Belum Scan,Sudah Scan',
        ]);

        $attendance->telah_scan = $request->input('telah_scan');
        $attendance->save();

        session()->flash('notif', 'Status telah diubah menjadi: ' . $attendance->telah_scan);
        return redirect()->back();
    }
}
