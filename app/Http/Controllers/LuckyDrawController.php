<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Prize;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redis;

class LuckyDrawController extends Controller
{
    public function index() {
        $key = 'page:index';
        $value = Redis::get($key);
        if ($value === "show") {
            $prizes = Prize::orderBy('prize_no', 'desc')->get();
            return view('lucky-draw.lucky-person-index', ['prizes' => $prizes]);
        }
        return view('lucky-draw.lucky-person-index-wait');
    }

    public function show(Request $request, $id)
    {
        $id = Crypt::decrypt($id);
        $employeeRepository = new EmployeeRepository();
        $prize = Prize::where('id', $id)->firstOrFail();
        $keyword = $request->query('keyword') ?? null;

        $employees = collect($employeeRepository->getEmployeesByPrizeId($id));
        if (!is_null($keyword)) {
            $employees = $employees->filter(function ($item, $key) use ($keyword) {
                return str_contains($item['name'], $keyword);
            });
            return view('lucky-draw.show', ['prize' => $prize, 'employees' => $employees, 'keyword' => $keyword]);
        }
        return view('lucky-draw.show', ['prize' => $prize, 'employees' => $employees, 'keyword' => $keyword]);
    }
}
