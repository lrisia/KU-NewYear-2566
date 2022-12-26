<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;

class ClearEmployeePrize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prize:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all employee prizes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employees = Employee::whereNotNull('got_prize_at')->get();
        foreach($employees as $employee) {
            $employee->prize_id = null;
            $employee->got_prize_at = null;
            $employee->save();
        }
        return Command::SUCCESS;
    }
}
