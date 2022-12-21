<?php

namespace App\Jobs;

use App\Mail\SendOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $items;
    protected $voucher;
    protected $dataUser;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->dataUser['email'])->send(new SendOrder($this->items, $this->voucher, $this->dataUser));
    }
}
