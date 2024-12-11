<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Registration;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function invitation()
    {
        return view('user.invitation');
    }

    public function success()
    {
        return view('user.success');
    }

    public function postAddInvitation(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'required|string|max:20',
            'domisili_perusahaan' => 'required|string|max:255',
            'peserta' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'akan_hadir' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255', // Tambahkan validasi untuk field unik
            'umur' => 'required|integer|min:1',    // Tambahkan validasi untuk field unik
        ]);

        // Simpan data biasa
        $data = $request->only([
            'nama',
            'email',
            'no_hp',
            'domisili_perusahaan',
            'peserta',
            'jabatan',
            'akan_hadir'
        ]);

        $data['telah_scan'] = 'Belum Scan';
        $data['kode'] = strtoupper(Str::random(8));
        $data['kode'] = preg_replace('/[^A-Za-z]/', '', $data['kode']);

        while (strlen($data['kode']) < 8) {
            $data['kode'] .= strtoupper(Str::random(1));
            $data['kode'] = preg_replace('/[^A-Za-z]/', '', $data['kode']);
        }

        // Tambahkan field unik ke kolom JSON
        $data['unique_fields'] = [
            'jurusan' => $request->input('jurusan'),
            'umur' => $request->input('umur'),
        ];

        // Simpan data ke database
        $registration = Registration::create($data);

        // Buat QR code
        $qrData = "Invitation Code: " . $registration->kode;

        // Define the file names
        $fileName = 'qr_' . $registration->kode . '.png';

        // Path to save in the public directory
        $publicFilePath = public_path('qr/' . $fileName);

        // Path to save in the custom directory
        $customFilePath = 'D:/projekflutter/molecule_scan/img/qr/' . $fileName;

        // Path to the logo
        $logoPath = ('\public\img/profile.png'); // Pastikan path logo sesuai

        // Generate QR code with a logo in the middle
        QrCode::format('png')
            ->merge($logoPath, 0.2) // 0.2 adalah rasio ukuran logo relatif terhadap QR code
            ->size(800)
            ->generate($qrData, $publicFilePath); // Save to the public path

        QrCode::format('png')
            ->merge($logoPath, 0.2)
            ->size(800)
            ->generate($qrData, $customFilePath); // Save to the custom path

        // Tambahkan border putih menggunakan GD
        $this->addWhiteBorder($publicFilePath); // Tambahkan border ke file public
        $this->addWhiteBorder($customFilePath); // Tambahkan border ke file custom

        // Update registration dengan filename QR
        $registration->update(['qr' => $fileName]);

        return redirect()->route('success');
    }


    private function addWhiteBorder($filePath)
    {
        // Load the QR image
        $qrImage = imagecreatefrompng($filePath);

        // Get the current width and height of the image
        $width = imagesx($qrImage);
        $height = imagesy($qrImage);

        // Set border size
        $borderSize = 50;

        // Create a new image with extra space for the border
        $newWidth = $width + $borderSize * 2;
        $newHeight = $height + $borderSize * 2;

        // Create a new image with white background
        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        $white = imagecolorallocate($newImage, 255, 255, 255); // White color
        imagefill($newImage, 0, 0, $white); // Fill the background with white

        // Copy the QR image to the center of the new image
        imagecopy($newImage, $qrImage, $borderSize, $borderSize, 0, 0, $width, $height);

        // Save the new image
        imagepng($newImage, $filePath);

        // Free up memory
        imagedestroy($qrImage);
        imagedestroy($newImage);
    }
}
