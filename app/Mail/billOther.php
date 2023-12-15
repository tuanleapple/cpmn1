<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class billOther extends Mailable
{
    use Queueable, SerializesModels;
    public $data_email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_email)
    {
        $this->data_email = $data_email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("tuanle0984946840@gmail.com")->view('billOther')->with(['data_mail'=>$this->data_email]);
    }
}
