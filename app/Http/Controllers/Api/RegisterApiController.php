<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Repositories\EmailRepository;
use App\Repositories\EmployeeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmRegister;

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
        if (!$request->has('islam') ||
            $request->input('islam') == "")
            $error["islam"] = "islam missing";
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
        if ($answer === "yes") {
            $employeeRepository = new EmployeeRepository();
            $employee = Employee::find($request->input('employee_id'));
            $employee->email = $request->input('email');
            $employee->register_at = Carbon::now();
            $employee->islam = $request->input("islam") === "yes";
            $employee->qr_code = $employeeRepository->generateCode($employee->p_id);
            $employee->save();
        }
        $emailRepository = new EmailRepository();
        $emailRepository->sendUnsentEmail();
        return response()->json([
            'success' => true,
        ], Response::HTTP_CREATED);
    }

    public function getEmployee(Request $request) {
        $id = $request->query('id') ?? null;
        $qr_code = $request->query('qr_code') ?? null;
        if ($id) return $this->getEmployeeById($id);
        elseif ($qr_code) return $this->getEmployeeByQrcode($qr_code);
        return response('', Response::HTTP_BAD_REQUEST);
    }

    private function getEmployeeById($id) {
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

    private function getEmployeeByQrcode($qr_code) {
        $employee = Employee::where('qr_code', $qr_code)->first();
        if ($employee == null) {
            return response()->json([
                'success' => false,
                'message' => ["qr_code" => "qr_code not found"]
            ], Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            "employee" => new EmployeeResource($employee)
        ], Response::HTTP_OK);
    }
}
