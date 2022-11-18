<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $employees = Employee::searchName($keyword)->get();
        return view('search', ['employees' => $employees, 'keyword' => $keyword]);
    }
}
