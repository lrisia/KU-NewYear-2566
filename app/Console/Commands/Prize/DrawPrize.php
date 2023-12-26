<?php

namespace App\Console\Commands\Prize;

use App\Models\Employee;
use App\Models\Prize;
use App\Repositories\EmployeeRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|int
     */
    public function handle()
    {
        $employeeRepository = new EmployeeRepository();
        $prize_id = $this->argument('prize_id');
        $lucky_person = $employeeRepository->getEmployeesByPrizeId($prize_id);
        if ($lucky_person->count() !== 0) {
            $this->error('Prize was already draw');
            return Command::FAILURE;
        }
        $prize = Prize::find($prize_id);
        if ($prize->enable === false) {
            $this->error('Prize was already draw');
            return Command::FAILURE;
        }
        Artisan::call('mqtt:publish kunewyear2566/draw-prize ' . Crypt::encrypt($prize_id));
        $prize->enable = false;
        $prize->save();
        $amount = $prize->left_amount;

        $bar = $this->output->createProgressBar($amount);

        $lucky_person = Employee::whereNotNull('register_at')
                                ->whereNotNull('arrive_at')
                                ->whereNull('got_prize_at')
                                ->where(DB::raw('LENGTH(p_id)'), '>=', 8)
                                ->inRandomOrder()
                                ->limit($amount)
                                ->get();
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
