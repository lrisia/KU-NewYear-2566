<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return 'index';
    }

    public function store(Request $request) {
        return 'store';
    }

    public function show($id) {
        return 'show' . $id;
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $employees = Employee::searchName($keyword)->get();
        return view('employees.search', ['employees' => $employees, 'keyword' => $keyword]);
    }
}
