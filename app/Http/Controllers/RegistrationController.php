<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use App\Jobs\SendQrCodeEmailJob;
use App\Jobs\SendQrToWhatsAppJob;
use App\Mail\QrCodeEmail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Mail\QrCodeMail;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class RegistrationController extends Controller
{
    public function registration()
    {
        $user = FacadesAuth::user();
        $registration = Registration::all();
        $registrationcount = Registration::count();
        return view('admin.registration.resgistration', compact('registration', 'registrationcount', 'user'));
    }

    public function editRegistration($id)
    {
        $user = FacadesAuth::user();
        $registration = Registration::findOrFail($id);
        return view('admin.registration.edit', compact('registration', 'user'));
    }

    public function downloadQrCode($id)
    {
        $registration = Registration::findOrFail($id);
        $fileName = 'qr_' . $registration->kode . '.png';
        $filePath = public_path('qr/' . $fileName);

        if (File::exists($filePath)) {
            return Response::download($filePath, $fileName);
        } else {
            return redirect()->back()->with('notif', 'QR code tidak ditemukan.');
        }
    }

    public function setHadir($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->telah_scan = 'Sudah Scan';
        $registration->save();

        return redirect()->back()->with('notif', 'Status berhasil diubah menjadi Hadir.');
    }

    public function setTidakHadir($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->telah_scan = 'Belum Scan';
        $registration->save();

        return redirect()->back()->with('notif', 'Status berhasil diubah menjadi Tidak Hadir.');
    }

    public function delete($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();
        return redirect()->back()->with('notif', 'Data peserta berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->input('ids'));
        Registration::whereIn('id', $ids)->delete();
        return redirect()->back()->with('notif', 'Data peserta berhasil dihapus.');
    }

    public function postEditRegistration(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'domisili_perusahaan' => 'required|string|max:255',
            'peserta' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'akan_hadir' => 'required|in:Iya,Tidak'
        ]);

        $registration = Registration::findOrFail($id);

        $registration->nama = $request->nama;
        $registration->email = $request->email;
        $registration->no_hp = $request->no_hp;
        $registration->domisili_perusahaan = $request->domisili_perusahaan;
        $registration->peserta = $request->peserta;
        $registration->jabatan = $request->jabatan;
        $registration->akan_hadir = $request->akan_hadir;
        $registration->save();

        return redirect()->route('registration')->with('notif', 'Data registrasi berhasil diperbarui.');
    }

    public function bulkSendQrEmails(Request $request)
    {
        $ids = $request->input('ids');

        if (is_string($ids)) {
            $ids = explode(',', $ids);
        }

        if (empty($ids)) {
            return redirect()->back()->withErrors('Please select participants to send QR code emails.');
        }

        $participants = Registration::whereIn('id', $ids)->get();

        foreach ($participants as $participant) {
            SendQrCodeEmailJob::dispatch($participant);
        }

        return redirect()->back()->with('notif', 'Bulk QR code emails are being sent in the background.');
    }

    public function getByQR($qr)
    {
        // Cari data registrasi berdasarkan QR
        $registration = Registration::where('qr', $qr)->first();

        if (!$registration) {
            return response()->json([
                'message' => 'Data registrasi tidak ditemukan.',
            ], 404);
        }

        return response()->json($registration, 200);
    }

    public function bulkSendQrToWhatsApp(Request $request)
    {
        $ids = explode(',', $request->input('ids'));

        foreach ($ids as $id) {
            SendQrToWhatsAppJob::dispatch($id);
        }

        return back()->with('notif', 'QR codes are being sent to WhatsApp.');
    }

      public function showByCode($kode)
    {
        // Cari data berdasarkan kode
        $registration = Registration::where('kode', $kode)->first();

        if ($registration) {
            return response()->json($registration, 200);
        }

        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }
}
