<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;

class RandomRegister extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'register:random {size}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Random register';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employees = Employee::inRandomOrder()->limit(150)->get();
        foreach ($employees as $employee) {
            $employee->register_at = fake()->dateTimeBetween('-2 week', '-1 week');
            $employee->email = fake()->email();
            $employee->save();
        }
        return Command::SUCCESS;
    }
}
