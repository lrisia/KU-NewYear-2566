<?php

namespace App\Console\Commands\Prize;

use App\Models\Employee;
use App\Models\Prize;
use App\Repositories\EmployeeRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class ClearPrize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prize:clear {prize_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear prize by id to ready for draw again eiei';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employeeRepository = new EmployeeRepository();
        $prize_id = $this->argument('prize_id');
        $employees = Employee::where('prize_id', $prize_id)->get();
        // Clear from DB
        foreach ($employees as $employee) {
            $employee->prize_id = null;
            $employee->got_prize_at = null;
            $employee->got_prize_no = null;
            $employee->register_at = null;
            $employee->save();
        }
        // Clear from Redis
        Redis::del('prize' . $prize_id . ':1');
        Redis::del('prize' . $prize_id . ':2');

        //Reset prize
        $prize = Prize::find($prize_id);
        $prize->enable = true;
        $prize->close = false;
        $prize->save();
        return Command::SUCCESS;
    }
}
