<?php

namespace App\Console\Commands\Redis;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:get {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get data in redis with key';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $key = $this->argument('key');
        $data = Redis::get($key);
        if ($data)
            $this->info($data);
        else $this->info('Data is empty');
        return Command::SUCCESS;
    }
}
