<?php

namespace App\Repositories;

use App\Mail\ConfirmRegister;
use App\Models\Employee;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailRepository
{
    public function sendUnsentEmail()
    {
        $employees = Employee::where('send_email_success', false)->get();
        $this->sendEmail($employees);
        $employees = Employee::whereNotNull('register_at')->where('send_email_success', null)->get();
        $this->sendEmail($employees);
    }

    private function sendEmail($employees)
    {
        foreach ($employees as $employee) {
            try {
                Log::info('email: ' . $employee->email);
                Mail::to($employee->email)->send(new ConfirmRegister($employee));
                $employee->send_email_success = true;
            } catch (\Exception $e) {
                Log::error(">>>>>> EMAIL ERROR <<<<<<");
                Log::error($e->getMessage());
                Log::error($e);
                $employee->send_email_success = false;
            }
            $employee->save();
        }
    }
}
