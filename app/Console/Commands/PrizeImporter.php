<?php

namespace App\Console\Commands;

use App\Models\Prize;
use Illuminate\Console\Command;

class PrizeImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prize:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import new prize';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $type = $this->ask('Enter prize name');
        $description = $this->ask('Enter prize description');
        $total_amount = $this->ask('Enter total amount of prize');
        try {
            $prize = new Prize();
            $prize->type = $type;
            $prize->description = $description;
            $prize->prize_no = Prize::get()->count();
            $prize->total_amount = $total_amount;
            $prize->left_amount = $total_amount;

            $prize->save();
            $this->line(" Imported Success.");
        } catch (\Exception $e) {
            $this->error(" Something went wrong...");
        }
        return Command::SUCCESS;
    }
}
