<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
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
          foreach($usnassigned_orders as $order){
            $pharmacies = Pharmacy::where('area_id',$order->address->area_id)->get();
            if(!isset($pharmacies) || empty($pharmacies)){continue;}
            $pharmacy = $pharmacies->orderBy('priority', 'desc')->first();
            $order->update([
              'pharmacy_id' => $pharmacy->id,
            ]);
          }
      })->everyminute();
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
