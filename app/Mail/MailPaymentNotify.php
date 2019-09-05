<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
Use App\User;
use App\Models\{Booking, Schedule, Payment};

class MailPaymentNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $booking;
    public $schedule;
    public $payment;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,Booking $booking, Payment $payment)
    {
        $this->user = $user;
        $this->booking = $booking;
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->schedule = Schedule::where('id', $this->booking['schedule_id'])->first();
        $this->payment = Payment::where('booking_id', $this->booking['id'])->first();

        return $this->from('ramadhanfijay@gmail.com')
                    ->subject('Informasi Pembayaran Barokah Banyuwangi')
                    ->view('email.payment',['user'=> $this->user,'booking'=>$this->booking,'schedule'=>$this->schedule,'payment'=>$this->payment]);
    }
}
