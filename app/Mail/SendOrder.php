<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOrder extends Mailable
{
    use Queueable, SerializesModels;
    protected $items;
    protected $voucher;
    protected $dataUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($items, $voucher, $dataUser)
    {
        $this->items = $items;
        $this->voucher = $voucher;
        $this->dataUser = $dataUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from(env('MAIL_FROM_ADDRESS'))
        ->view('mail.order')
        ->withItems($this->items)
        ->withVoucher($this->voucher)
        ->withDataUser($this->dataUser);
    }
}
