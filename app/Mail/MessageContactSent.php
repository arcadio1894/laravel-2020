<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageContactSent extends Mailable
{
    use Queueable, SerializesModels;

    public $fullname;
    public $email;
    public $tel;
    public $mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $fullname, $email, $tel, $message )
    {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->tel = $tel;
        $this->mensaje = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.contact');
    }
}
