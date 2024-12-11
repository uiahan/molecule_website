<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QrCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $qrCodePath;

    public function __construct($qrCodePath)
    {
        $this->qrCodePath = $qrCodePath;
    }

    public function build()
    {
        return $this->subject('QR Code Registration')
                    ->view('emails.qrcode')
                    ->attach($this->qrCodePath, [
                        'as' => 'qrcode.png',
                        'mime' => 'image/png',
                    ]);
    }
}
