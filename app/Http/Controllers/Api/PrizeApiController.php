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
        $prize->enable = false;
        $prize->save();
        $amount = $prize->left_amount;
        $lucky_person = Employee::whereNotNull('register_at')->whereNotNull('arrive_at')->whereNull('got_prize_at')->inRandomOrder()->limit($amount)->get();
        $i = 1;
        // $lucky_person = Employee::whereNull('got_prize_at')->inRandomOrder()->limit($amount)->get();
        foreach ($lucky_person as $person) {
            $person->prize_id = $prize->id;
            $person->got_prize_no = $i;
            $person->got_prize_at = Carbon::now();
            $person->save();
            $i++;
        }
        Artisan::call('mqtt:publish kunewyear2566/draw-prize ' . $id);
        return response('', Response::HTTP_OK);
    }

    public function getLuckyPerson($id) {
        $lucky_person = Employee::where('prize_id', $id)->get();
        return response()->json(EmployeeResource::collection($lucky_person), Response::HTTP_OK);
    }

    public function tookPrize(Request $request) {
        $lucky_person = $request->input('employee_id');
        $employee = Employee::where('id', $lucky_person)->first();
        $employee->took_prize = 1;
        $employee->save();
        return response('', Response::HTTP_OK);
    }
}
