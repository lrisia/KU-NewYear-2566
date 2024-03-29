<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Models\Prize;
use App\Repositories\EmployeeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PrizeApiController extends Controller
{
    private $buffer;

    public function get($id)
    {
        $prize = Prize::find(Crypt::decrypt($id));
        return response()->json($prize, Response::HTTP_OK);
    }

    public function draw($id) {
        Artisan::call('mqtt:publish kunewyear2566/draw-prize ' . $id);
        $prize = Prize::find($id);
        if ($prize->enable === false) return response('Prize was already draw', Response::HTTP_BAD_REQUEST);
        $prize->enable = false;
        $prize->save();
        $amount = $prize->left_amount;
        $lucky_person = Employee::whereNotNull('register_at')->whereNotNull('arrive_at')->whereNull('got_prize_at')->inRandomOrder()->limit($amount)->get();
        // $lucky_person = Employee::whereNull('got_prize_at')->inRandomOrder()->limit($amount)->get();
        $this->buffer = $lucky_person;
        Log::info($lucky_person);
        DB::beginTransaction();
        $i = 1;
        foreach ($lucky_person as $person) {
            $person->prize_id = $prize->id;
            $person->got_prize_no = $i;
            $person->got_prize_at = Carbon::now();
            $person->save();
            $i++;
        }
        DB::commit();
        $this->buffer = null;
        return response('', Response::HTTP_OK);
    }

    public function getLuckyPerson($id) {
//        if ($this->buffer) return response()->json(EmployeeResource::collection($this->buffer), Response::HTTP_OK);
        $employeeRepository = new EmployeeRepository();
        $id = Crypt::decrypt($id);
        $lucky_person = collect($employeeRepository->getEmployeesByPrizeId($id));
        return response()->json($lucky_person, Response::HTTP_OK);
    }

    public function tookPrize(Request $request) {
        $lucky_person = $request->input('employee_id');
        $employee = Employee::where('id', $lucky_person)->first();
        $employee->took_prize = 1;
        $employee->save();
        return response('', Response::HTTP_OK);
    }
}
