<?php

namespace App\Console\Commands\Employee;

use App\Models\Employee;
use Illuminate\Console\Command;
use App\Mail\ConfirmRegister;
use Illuminate\Support\Facades\Mail;
use App\Repositories\EmployeeRepository;

class RegisterManual extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:manual';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manual Register via CLI: find name and send email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employeeRepository = new EmployeeRepository();

        $name = $this->ask('Enter employee name: ');
        $employee = Employee::where('name', $name)->first();
        if ($employee) {
            if ($employee->register_at !== NULL){
                $this->line("[{$name}] has been registered.");
                return Command::FAILURE;
            }
            $email = $this->ask('Enter employee email: ');
            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $this->line("[{$email}] Invalid email format");
                return Command::FAILURE;
            }
            $employee->register_at = now();
            $employee->email = $email;
            $employee->qr_code = $employeeRepository->generateCode($employee->p_id);
            $employee->send_email_success = false;
            $employee->save();
            try {
                Mail::to($email)->send(new ConfirmRegister($employee));
                $employee->send_email_success = true;
                $employee->save();
            } catch (\Exception $e) {
                $this->error('Cannot send mail');
                $employee->register_at = null;
                $employee->send_email_success = false;
                $employee->qr_code = null;
                $employee->save();
            }
            return Command::SUCCESS;
        }
        $this->line("[{$name}] not found.");

        return Command::FAILURE;
    }
}
