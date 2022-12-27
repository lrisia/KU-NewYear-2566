<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;

class ClearEntrance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entry:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all entrance';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employees = Employee::whereNotNull('arrive_at')->get();
        $bar = $this->output->createProgressBar($employees->count());
        $bar->start();
        foreach($employees as $employee) {
            $employee->arrive_at = null;
            $employee->save();
            $bar->advance();
        }
        $bar->finish();
        $this->newLine();
        return Command::SUCCESS;
    }
}
