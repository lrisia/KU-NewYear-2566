<?php

namespace App\Console\Commands\Email;

use App\Mail\TestEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailTester extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test sending email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->ask("Enter email to");
        $subject = $this->ask("Enter email subject");
        $message = $this->ask("Enter email message");

        Mail::to($email)->send(new TestEmail($subject, $message));
        return Command::SUCCESS;
    }
}
