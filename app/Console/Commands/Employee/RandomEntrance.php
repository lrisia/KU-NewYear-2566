<?php

namespace App\Console\Commands\Employee;

use App\Models\Employee;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        $bar = $this->output->createProgressBar($employees->count());
        $bar->start();
        DB::beginTransaction();
        foreach ($employees as $employee) {
            $employee->arrive_at = now();
            $employee->save();
            $bar->advance();
        }
        DB::commit();
        $bar->finish();
        $this->newLine();
        return Command::SUCCESS;
    }
}
