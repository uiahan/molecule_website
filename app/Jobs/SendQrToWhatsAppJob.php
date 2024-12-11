<?php

namespace App\Jobs;

use App\Models\Registration;
use Twilio\Rest\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendQrToWhatsAppJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $participantId;

    public function __construct($participantId)
    {
        $this->participantId = $participantId;
    }

    public function handle()
    {
        $participant = Registration::findOrFail($this->participantId);
        $twilio = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
        $qrCodeImageUrl = 'https://https://a6cc-36-79-171-247.ngrok-free.app/qr/' . $participant->qr; 
        $recipient = 'whatsapp:+' . $participant->no_hp;
       
        $twilio->messages->create(
            $recipient,
            [
                'from' => 'TWILIO_WHATSAPP_NUMBER',
                'body' => "Hello {$participant->peserta},\n\n" .
                    "Selamat Sejahtera! Pendaftaran Anda telah dikonfirmasi.\n\n" .
                    "Sampai jumpa di acara **LIVEABLE AND LOVEABLE NUSANTARA: COLLABORATIVE LEARNING FORUM**:\n" .
                    "- **Tempat**: Hutan Kota Gelora Bung Karno - Senayan, Jakarta\n" .
                    "- **Hari, Tanggal**: Rabu, 20 Maret 2024\n" .
                    "- **Waktu**: 14.00 WIB - Selesai\n\n" .
                    "Mohon tunjukkan QR Code berikut di meja registrasi sebelum memasuki ruangan.\n\n" .
                    "Note: Pesan ini bersifat personal, mohon untuk tidak membagikan pesan ini ke siapapun.\n\n" .
                    "Terima kasih,\n" .
                    "Otorita Ibu Kota Nusantara.",
            ]
        );
    }
}
