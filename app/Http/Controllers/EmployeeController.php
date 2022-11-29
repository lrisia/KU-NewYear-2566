<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Organizer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.register');
    }

    public function show($qr_code) {
        $employee = Employee::where('qr_code', $qr_code)->first();
        $organizer_name = Organizer::where('id', $employee->organizer_id)->first()->name;
        return view('employees.show', [
            'employee' => $employee,
            'organizer_name' => $organizer_name
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $employees = Employee::searchName($keyword)->whereNull('register_at')->orderBy('name', 'asc')->get();
        return view('employees.search', ['employees' => $employees, 'keyword' => $keyword]);
    }
}
