<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeApiController extends Controller
{
    public function arrived(Request $request) {
        $qr_code = $request->input('qr_code');
        $employee = Employee::where('qr_code', $qr_code)->first();
        $employee->arrive_at = Carbon::now();
        $employee->save();
        return response('', Response::HTTP_OK);
    }

    public function attended(Request $request) {
        $employee_id = $request->input('employee_id');
        $employee = Employee::where('id', $employee_id)->first();
        $employee->arrive_at = Carbon::now();
        $employee->save();
        return response('', Response::HTTP_OK);
    }
}
