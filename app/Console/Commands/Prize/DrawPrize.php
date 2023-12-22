<?php

namespace App\Console\Commands\Prize;

use App\Models\Employee;
use App\Models\Prize;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DrawPrize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prize:draw {prize_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Draw prize by prize id';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $prize_id = $this->argument('prize_id');
        $prize = Prize::find($prize_id);
        if ($prize->enable === false) return response('Prize was already draw', Response::HTTP_BAD_REQUEST);
        $prize->enable = false;
        $prize->save();
        $amount = $prize->left_amount;

        $bar = $this->output->createProgressBar($amount);

        $lucky_person = Employee::whereNotNull('register_at')->whereNotNull('arrive_at')->whereNull('got_prize_at')->inRandomOrder()->limit($amount)->get();
        // $lucky_person = Employee::whereNull('got_prize_at')->inRandomOrder()->limit($amount)->get();
        DB::beginTransaction();
        $i = 1;
        foreach ($lucky_person as $person) {
            $person->prize_id = $prize->id;
            $person->got_prize_no = $i;
            $person->got_prize_at = Carbon::now();
            $person->save();
            $i++;

            $bar->advance();
        }
        $bar->finish();
        DB::commit();
        return Command::SUCCESS;
    }
}
