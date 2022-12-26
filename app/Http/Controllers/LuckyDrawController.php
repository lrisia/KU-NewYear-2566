<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Prize;
use Illuminate\Http\Request;

class LuckyDrawController extends Controller
{
    public function index() {
        $prizes = Prize::orderBy('type')->orderBy('prize_no', 'asc')->get();
        return view('lucky-draw.lucky-person-index', ['prizes' => $prizes]);
    }

    public function show(Request $request, $id)
    {
        $prize = Prize::where('id', $id)->firstOrFail();
        $keyword = $request->query('keyword') ?? null;
        $query = Employee::query();
        if (!is_null($keyword)) {
            $query = $query->searchName($keyword);
            $employees = $query->where('prize_id', $id)->whereNotNull('got_prize_at')->latest('got_prize_at')->get();
            return view('lucky-draw.show', ['prize' => $prize, 'employees' => $employees, 'keyword' => $keyword]);
        }
        $employees = $prize->employees->sortBy('name');
        return view('lucky-draw.show', ['prize' => $prize, 'employees' => $employees, 'keyword' => $keyword]);
    }
}
