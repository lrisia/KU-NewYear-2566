<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Organizer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'search']);
    }

    public function index()
    {
        if (Auth::user()) return redirect()->route('/');

        return view('employees.register');
    }

    public function show($qr_code) {
        if (Auth::user()) return redirect()->route('/');

        $employee = Employee::where('qr_code', $qr_code)->first();
        $organizer_name = Organizer::where('id', $employee->organizer_id)->first()->name;
        return view('employees.show', [
            'employee' => $employee,
            'organizer_name' => $organizer_name
        ]);
    }

    public function search(Request $request)
    {
        if (Auth::user()) return redirect()->route('/');

        $keyword = $request->input('keyword');
        $employees = Employee::searchName($keyword)->whereNull('register_at')->orderBy('name', 'asc')->get();
        return view('employees.search', ['employees' => $employees, 'keyword' => $keyword]);
    }

    public function registered()
    {
        if (!Auth::user()->isStaff()) return redirect()->route('/');

        $employees = Employee::whereNotNull('register_at')->orderBy('name', 'asc')->get();
        return view('employees.registered', ['employees' => $employees]);
    }

    public function searchRegistrant(Request $request)
    {
        if (!Auth::user()->isStaff()) return redirect()->route('/');

        $keyword = $request->input('keyword');
        $employees = Employee::searchName($keyword)->whereNotNull('register_at')->orderBy('name', 'asc')->get();
        return view('employees.search-registrant', ['employees' => $employees, 'keyword' => $keyword]);
    }

}
