<?php

namespace App\Console\Commands\Prize;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;

class PlayVideo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prize:play {prize_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Play video and prize result of {prize_id}';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $prize_id = $this->argument('prize_id');
        $this->line("Preparing Artisan mqtt:publish ...");
        $this->line("Crypt::encrypt({$prize_id})\n");
        $crypt_id = Crypt::encrypt($prize_id);
        $this->info($crypt_id);
        $this->line("\n");
        $this->info("artisan mqtt:publish kunewyear2566/draw-prize {$crypt_id}\n");
        $this->line("Publishing...");
        Artisan::call("mqtt:publish kunewyear2566/draw-prize {$crypt_id}");
        return Command::SUCCESS;
    }
}
