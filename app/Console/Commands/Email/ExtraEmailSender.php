<?php

namespace App\Console\Commands\Email;

use App\Mail\ConfirmRegister;
use App\Models\Employee;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Exception\RfcComplianceException;

class ExtraEmailSender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-extra';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email for extra employee';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $extra = Employee::where('p_id', 'LIKE', "EXTRA%")->whereNotNull('email')->whereNotNull('register_at')->get();
        $this->line("count: {$extra->count()}");

        foreach($extra as $employee) {
            $this->line("sending to {$employee->email}");
            try {
                Mail::to($employee->email)->send(new ConfirmRegister($employee));
            } catch (RfcComplianceException $e) {
                $this->error($e);
            }
            sleep(1);
        }
        return Command::SUCCESS;
    }
}
