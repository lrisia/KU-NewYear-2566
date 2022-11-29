<?php

namespace App\Console\Commands;

use App\Mail\ConfirmRegister;
use App\Models\Employee;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailSender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument("email");
        $employee = Employee::where('email', $email)->first();
        Mail::to($email)->send(new ConfirmRegister($employee));
        return Command::SUCCESS;
    }
}
