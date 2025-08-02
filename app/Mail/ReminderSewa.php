<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderSewa extends Mailable
{
    use Queueable, SerializesModels;

    public $notifikasi;

    /**
     * Create a new message instance.
     */
    public function __construct($notifikasi)
    {
        $this->notifikasi = $notifikasi;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Pengingat Pembayaran Kost Putri Alfia Purwokerto')
            ->markdown('emails.reminder')
            ->with([
                'notifikasi' => $this->notifikasi
            ]);
    }
}
