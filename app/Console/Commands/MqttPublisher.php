<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class MqttPublisher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:publish {topic} {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $topic = $this->argument('topic');
        $message = $this->argument('message');
        $this->line("publishing [{$message}] to topic [{$topic}]");

        $mqtt = MQTT::connection();
        $mqtt->publish($topic, $message);
        $mqtt->loop(true);
        return Command::SUCCESS;
    }
}
