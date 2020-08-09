<?php

namespace App\Console\Commands;

use App\Mail\SendEmailUsersRegistered;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class RegisteredUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registered:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email when user had been registered.';

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
        $count = User::where('created_at', '2020-05-24 12:13:14')->count();
        Mail::to('joryes1894@gmail.com')
            ->send( new SendEmailUsersRegistered($count) );
    }
}
