<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class crearUsuario extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Username
     */
    public $username;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $username)
    {
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Cuenta Creada')->markdown('emails.crear.Usuario');
    }
}
