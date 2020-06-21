<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageContactSent extends Mailable
{
    use Queueable, SerializesModels;

    private $fullname;
    private $email;
    private $tel;
    private $mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $fullname, $email, $tel, $mensaje )
    {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->tel = $tel;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.contact')
            ->subject('Correo de contacto')
            ->attach(public_path().'/pdfs/diplomado-laravel FINAL.pdf', [
                'as' => 'brochure.pdf',
                'mime' => 'application/pdf',
            ])
            ->with([
                'fullname' => $this->fullname,
                'email' => $this->email,
                'tel' => $this->tel,
                'mensaje' => $this->mensaje,
            ]);
    }
}
