<?php

namespace App\Console\Commands\Prize;

use App\Models\Prize;
use Illuminate\Console\Command;

class CreatePrize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prize:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new prize';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $newPrize = new Prize();
        $newPrize->type = $this->ask('ชื่อรางวัล *');
        $description = $this->ask('คำอธิบายรางวัล');
        if ($description == null) $description = '';
        $newPrize->description = $description;
        $newPrize->prize_no = 0;
        $amount = $this->ask('จำนวนรางวัล *');
        $newPrize->total_amount = $amount;
        $newPrize->left_amount = $amount;
        $money = $this->ask('เงินรางวัล (default=10000)');
        if ($money == '') $money = "10000";
        $newPrize->money_amount = $money;
        $newPrize->save();
        return Command::SUCCESS;
    }
}
