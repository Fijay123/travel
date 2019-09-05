<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\MailTicketNotify;
use Mail;



class sendTicketEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $email;
    protected $pdf;

    public function __construct($email, $pdf)
    {
        $this->email = $email;
       
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = new MailTicketNotify();
        Mail::to($this->email['email'])->send($message);
    }
}
