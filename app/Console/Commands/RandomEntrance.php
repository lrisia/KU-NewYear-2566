<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;

class RandomEntrance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entry:random {size}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Random Entry';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $size = $this->argument('size');
        $employees = Employee::whereNotNull('register_at')->whereNull('arrive_at')->whereNull('got_prize_at')->inRandomOrder()->limit($size)->get();
        foreach ($employees as $employee) {
            $employee->arrive_at = now();
            $employee->save();
        }
        return Command::SUCCESS;
    }
}
