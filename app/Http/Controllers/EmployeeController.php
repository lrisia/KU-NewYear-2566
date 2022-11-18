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

    public function search(Request $request) {
        return 'search';
    }

    public function store(Request $request) {
        return 'store';
    }

    public function show($id) {
        return 'show'.$id;
    }
}
