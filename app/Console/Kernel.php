<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\User;
use App\Client;
use App\Order;
use App\Pharmacy;
use App\Notifications\OrderNotify;
use Illuminate\Http\Request;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
      Commands\NotifyUserMissing::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      $schedule->call(function () {

          $unassigned_orders = Order::where('status','New')->get();
          foreach($unassigned_orders as $order){
            $pharmacies = Pharmacy::where('area_id',$order->address->area_id)->get();
            if( empty($pharmacies->first()) ){continue;}
            $pharmacy = $pharmacies->sortBy('priority')->first();

            $order->update([
              'pharmacy_id' => $pharmacy->id,
              'status' => 'Processing',
            ]);
          }
      })->everyminute();
    }

/**
    //   $schedule->call(function () {
    //       $waiting_orders = Order::where('status','WaitingForUserConfirmation')->get();
    //       foreach($waiting_orders as $order){
    //         $client = Client::findOrFail($order->user_id)->first();
    //         $usr = User::where('profile_type', 'App\Client')->where('profile_id', $order->user_id)->first();
    //         $usr->notify(new OrderNotify("A new user has visited on your application."));
    //       }
    //   })->hourly();

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
