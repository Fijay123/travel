<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class MailTicketNotify extends Mailable
{
    use Queueable, SerializesModels;

    protected $pdf;
   
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf)
    {
       $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ramadhanfijay@gmail.com')
            ->subject('Pengiriman E-ticket')
            ->view('email.ticket')
            ->attachData($this->pdf, 'eticket.pdf', [
                'mime' => 'application/pdf',
            ]);

          //  return $this->view('email.ticket');

    }
}
