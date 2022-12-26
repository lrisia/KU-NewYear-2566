<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\Prize;
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

        $prizes = Prize::get();
        foreach ($prizes as $prize) {
            if ($prize->type == "รางวัลพิเศษ") {
                $prize->money_amount = 6000;
                $prize->total_amount = 1;
            }
            $prize->close = false;
            $prize->enable = true;
            $prize->left_amount = $prize->total_amount;
            $prize->save();
        }

        return Command::SUCCESS;
    }
}
