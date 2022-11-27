<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $error = [];
        if (!$request->has('employee_id') || $request->input('employee_id') == "") $error["employee_id"] = "employee id missing";
        if (!$request->has('answer') || $request->input('answer') == "") $error["answer"] = "answer missing";
        if (!empty($error))
            return response()->json([
                'success' => false,
                'message' => $error
            ], Response::HTTP_BAD_REQUEST);
        $answer = $request->input('answer');
        if (!$request->has('email') && $answer === "yes" || $request->input('email') == "")
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
//            TODO: random 32 number for generate qr-code
            $employee->save();
        }
        return response()->json([
            'success' => true,
        ], Response::HTTP_CREATED);
    }
}
