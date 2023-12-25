<?php

namespace App\Console\Commands\Redis;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all data in Redis';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Redis::flushall();
        $this->info('Success, clear all data in redis');
        return Command::SUCCESS;
    }
}
