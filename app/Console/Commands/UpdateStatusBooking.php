<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class UpdateStatusBooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateStatus:Booking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Status Booking When More than time limit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        //$update =  DB::table('bookings')->where('status',0)->whereRaw('now() > available_until ')->get();
        //$update->update(['status' => 4]);
        $update = DB::table('bookings')->where('status',0)->whereRaw('now() > available_until ')->update(['status' => 4]);
        
            DB::table('seats')->whereRaw('booking_id', $update)->update(['status' => 0, 'booking_id' => null]);
    }
}
