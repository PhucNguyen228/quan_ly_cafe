<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailKichHoatOff extends Mailable
{
    use Queueable, SerializesModels;

    public $ho_va_ten;
    public $hash;
    public $tieu_de;

    public function __construct($ho_va_ten, $hash, $tieu_de)
    {
        $this->ho_va_ten       = $ho_va_ten;
        $this->hash         = $hash;
        $this->tieu_de      = $tieu_de;
    }


    public function build()
    {
        return $this->subject($this->tieu_de)->view('mail.kich_hoat_off', [
            'ho_va_ten' => $this->ho_va_ten,
            'hash'   => $this->hash,
        ]);
    }
}
