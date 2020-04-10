<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Order;
use App\Pharmacy;
use App\Notifications\OrderNotify;


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

      $schedule->call(function () {
          $waiting_orders = Order::where('status','WaitingForUserConfirmation')->get();
          foreach($waiting_orders as $order){
            $user = $order->user();
            $notify = new OrderNotify();
            $user->notify(($notify->toMail()));
          }
      })->everyminute();
      $schedule->command('users:notify')->daily();

    }

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
