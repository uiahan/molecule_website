<?php

// app/Jobs/SendQrCodeEmailJob.php

namespace App\Jobs;

use App\Mail\QrCodeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Registration;

class SendQrCodeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $participant;

    /**
     * Create a new job instance.
     *
     * @param Registration $participant
     * @return void
     */
    public function __construct(Registration $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $qrCodePath = public_path('qr/' . $this->participant->qr);

        if (file_exists($qrCodePath)) {
            Mail::to($this->participant->email)->send(new QrCodeMail($qrCodePath));
        }
    }
}
