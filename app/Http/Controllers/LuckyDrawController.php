<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Prize;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LuckyDrawController extends Controller
{
    public function index() {
        $prizes = Prize::orderBy('prize_no', 'desc')->get();
        return view('lucky-draw.lucky-person-index', ['prizes' => $prizes]);
    }

    public function show(Request $request, $id)
    {
        $employeeRepository = new EmployeeRepository();
        $prize = Prize::where('id', $id)->firstOrFail();
        $keyword = $request->query('keyword') ?? null;

        $employees = collect($employeeRepository->getEmployeesByPrizeId($id));
        if (!is_null($keyword)) {
            $employees = $employees->where('name', 'LIKE', "%{$keyword}%");
            return view('lucky-draw.show', ['prize' => $prize, 'employees' => $employees, 'keyword' => $keyword]);
        }
        return view('lucky-draw.show', ['prize' => $prize, 'employees' => $employees, 'keyword' => $keyword]);
    }
}
