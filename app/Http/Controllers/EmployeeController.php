<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.register');
    }

    public function store(Request $request) {
//        TODO: validate email
//        $request->validate([
//           'email' => 'required|unique:employees'
//        ]);
        $employee = Employee::find($request->get('id'));
        $employee->email = $request->get('email');
//        TODO: generate qr-code
//        $employee->qr-code =
        $employee->register_at = Carbon::now();
        $employee->save();
    }

    public function show($id) {
        return 'show' . $id;
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $employees = Employee::searchName($keyword)->whereNull('register_at')->orderBy('name', 'asc')->get();
        return view('employees.search', ['employees' => $employees, 'keyword' => $keyword]);
    }
}
