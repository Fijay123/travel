<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
Use App\User;
use App\Models\{Booking, Schedule};

class MailBookingNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $booking;
    public $schedule;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,Booking $booking)
    {
        $this->user = $user;
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->schedule = Schedule::where('id', $this->booking['schedule_id'])->first();
        return $this->from('ramadhanfijay@gmail.com')
                    ->subject('Informasi Booking Barokah Banyuwangi')
                    ->view('email.booking',['user'=> $this->user,'booking'=>$this->booking,'schedule'=>$this->schedule]);
    }
}
