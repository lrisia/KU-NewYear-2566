<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Prize;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class PrizeApiController extends Controller
{
    public function get($id)
    {
        $prize = Prize::find($id);
        return response()->json($prize, Response::HTTP_OK);
    }

    public function draw($id) {
        $prize = Prize::find($id);
        $amount = $prize->total_amount;
//        $lucky_person = Employee::whereNotNull('arrive_at')->whereNull('got_prize_at')->inRandomOrder()->limit($amount)->get();
        $lucky_person = Employee::whereNull('got_prize_at')->inRandomOrder()->limit($amount)->get();
        foreach ($lucky_person as $person) {
            $person->prize_id = $prize->id;
            $person->got_prize_at = Carbon::now();
            $person->save();
        }
        Artisan::call('mqtt:publish kunewyear2566/draw-prize ' . $id);
        return response('', Response::HTTP_OK);
    }
}
