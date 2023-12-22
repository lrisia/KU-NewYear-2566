<?php

namespace App\Console\Commands\Employee;

use App\Models\Employee;
use Illuminate\Console\Command;

class ClearRegister extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unregister employee with email';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->ask("Which email you want to unregister?");
        $employee = Employee::where('email', $email)->first();
        if (is_null($employee)) {
            $this->line("No {$email} found in registered employee");
            return Command::SUCCESS;
        }
        $this->table([
            'p_id', 'name', 'organization', 'register_at', 'qr_code'
        ], [
            [
                $employee->p_id,
                $employee->name,
                $employee->organizer->name,
                $employee->register_at->format('d M H:i:s'),
                $employee->qr_code
            ]
        ]);

        $confirmed = $this->confirm("Are you sure to unregister this employee?", false);
        if ($confirmed) {
            $employee->register_at = null;
            $employee->qr_code = null;
            $employee->email = null;
            $employee->save();
            $this->line("This employee has been unregistered");
        }
        return Command::SUCCESS;
    }
}
