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
        $bar = $this->output->createProgressBar($employees->count());
        $bar->start();
        foreach($employees as $employee) {
            $employee->prize_id = null;
            $employee->got_prize_at = null;
            $employee->got_prize_no = null;
            $employee->save();
            $bar->advance();
        }
        $bar->finish();
        $this->newLine();

        $prizes = Prize::get();
        $bar = $this->output->createProgressBar($prizes->count());
        $bar->start();
        foreach ($prizes as $prize) {
            if ($prize->type == "รางวัลพิเศษ") {
                $prize->money_amount = 0;
                $prize->total_amount = 0;
            }
            $prize->close = false;
            $prize->enable = true;
            $prize->left_amount = $prize->total_amount;
            $prize->save();
            $bar->advance();
        }
        $bar->finish();
        $this->newLine();

        return Command::SUCCESS;
    }
}
