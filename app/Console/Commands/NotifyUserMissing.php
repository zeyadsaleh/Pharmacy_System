<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;
use App\Notifications\UserNotify;


class NotifyUserMissing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send an email notification to users ​ who hasn’t login from the past month​';

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
        $data = Carbon::now()->subMinute(1);
        // dd($data);
        $users = User::where('logged_in_at' , '<' , $data)->get();

        foreach ($users as $user)
        {
            $user->notify(new UserNotify());
        }
    }
}
