<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class RegisterApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['email']
        ]);
        $error = [];
        if (!$request->has('employee_id') ||
            $request->input('employee_id') == "")
            $error["employee_id"] = "employee id missing";
        if (!$request->has('answer') ||
            $request->input('answer') == "")
            $error["answer"] = "answer missing";
        if (!empty($error))
            return response()->json([
                'success' => false,
                'message' => $error
            ], Response::HTTP_BAD_REQUEST);
        $answer = $request->input('answer');
        if ((!$request->has('email') && $answer === "yes") ||
            ($request->input('email') == ""  && $answer === "yes"))
            return response()->json([
                'success' => false,
                'message' => ["email" => "email missing"]
            ], Response::HTTP_BAD_REQUEST);
        if (Employee::where('email', $request->input('email'))->count() == 1)
            return response()->json([
                'success' => false,
                'message' => ["email" => "email duplicated"]
            ], Response::HTTP_BAD_REQUEST);
        if ($answer === "yes") {
            $employee = Employee::find($request->input('employee_id'));
            $employee->email = $request->input('email');
            $employee->register_at = Carbon::now();
            $qr_code = fake()->regexify('[A-Z0-9]{32}');
            while (Employee::where('qr_code', $qr_code)->first()) {
                $qr_code = fake()->regexify('[A-Z0-9]{32}');
            }
            $employee->qr_code = $qr_code;
            $employee->save();
            Artisan::call('email:send ' . $employee->email);
        }
        return response()->json([
            'success' => true,
        ], Response::HTTP_CREATED);
    }

    public function getEmployee($id) {
        $employee = Employee::find($id);
        if ($employee == null) {
            return response()->json([
                'success' => false,
                'message' => ["id" => "id not found"]
            ], Response::HTTP_BAD_REQUEST);
        }
        if ($employee->qr_code == null) {
            return response()->json([
                'success' => false,
                'message' => "employee not register yet"
            ], Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            "employee" => new EmployeeResource($employee)
        ], Response::HTTP_OK);
    }
}
