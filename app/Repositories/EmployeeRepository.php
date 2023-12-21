<?php

namespace App\Repositories;

use App\Models\Employee;

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
}
