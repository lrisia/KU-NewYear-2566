<?php

namespace App\Repositories;

use App\Models\Employee;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class EmployeeRepository
{
    public function generateCode(int $p_id)
    {
        $qr_code = $p_id . fake()->regexify('[A-Z0-9]{24}');
        while (Employee::where('qr_code', $qr_code)->first()) {
            $qr_code = fake()->regexify('[A-Z0-9]{32}');
        }
        return $qr_code;
    }
    public function getEmployeesByPrizeId(int $id)
    {
        $prefix = 'prize' . $id . ':';
        $employees = Redis::keys($prefix . "*");
        if (!$employees) {
            $employees = Employee::where('prize_id', $id)->whereNotNull('got_prize_at')->oldest('got_prize_no')->get();
            foreach ($employees as $employee) {
                Redis::set($prefix . $employee->got_prize_no, $employee->title . $employee->name . ',' . $employee->organizer->name);
            }
        }
       return collect(Redis::keys($prefix . "*"))
            ->map(function ($key) use ($prefix) {
                $data = explode(',', Redis::get($key));
                return [
                    'no' => str_replace($prefix, '', $key),
                    'name' => $data[0],
                    'organizer_name' => $data[1]
                ];
            })
            ->sortBy('no')
            ->values();
    }

}
