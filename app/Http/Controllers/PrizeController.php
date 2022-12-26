<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class PrizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['draw']);
    }

    public function index()
    {
        if (!Auth::user()->isStaff()) return redirect()->back();

        $prizes = Prize::orderBy('prize_no', 'desc')->get();
        $is_special_prize_available = true;
        foreach ($prizes as $prize) {
            if ($prize->type === 'รางวัลพิเศษ') continue;
            if (!$prize->close) $is_special_prize_available = false;
        }
        return view('staff.prizes.index', [
            'prizes' => $prizes,
            'is_special_prize_available' => $is_special_prize_available
        ]);
    }

    public function search(Request $request)
    {
        if (!Auth::user()->isStaff()) return redirect()->back();

        $keyword = $request->query('keyword') ?? null;
        $query = Employee::query();
        if (!is_null($keyword)) {
            $query = $query->searchName($keyword);
        }
        $employees = $query->whereNotNull('got_prize_at')->latest('got_prize_at')->get();
        return view('staff.prizes.search', ['employees' => $employees, 'keyword' => $keyword]);
    }

    public function selectPrize(Request $request)
    {
        $id = $request->input('id');
        Artisan::call('mqtt:publish kunewyear2566/enable-prize ' . $id);
        return redirect()->route('staff.prizes.show', ['id' => $id]);
    }

    public function show(Request $request, $id)
    {
        if (!Auth::user()->isStaff()) return redirect()->back();

        $prize = Prize::where('id', $id)->firstOrFail();
        $keyword = $request->query('keyword') ?? null;
        $query = Employee::query();
        if (!is_null($keyword)) {
            $query = $query->searchName($keyword);
            $employees = $query->where('prize_id', $id)->whereNotNull('got_prize_at')->latest('got_prize_no')->get();
            return view('staff.prizes.show', ['prize' => $prize, 'employees' => $employees, 'keyword' => $keyword]);
        }
        $employees = $prize->employees->sortBy('got_prize_no');
        return view('staff.prizes.show', ['prize' => $prize, 'employees' => $employees, 'keyword' => $keyword]);
    }

    public function close(Request $request)
    {
        if (!Auth::user()->isStaff()) return redirect()->back();

        $id = $request->query('id');
        $amount = $request->query('amount');

        $prize = Prize::find($id);
        $prize->close = true;
        $prize->left_amount = $amount;
        $prize->save();

        $special_prize = Prize::where('type', 'รางวัลพิเศษ')->firstOrFail();
        $special_prize->money_amount += $amount * $prize->money_amount;
        $special_prize->total_amount = (int)($special_prize->money_amount / 10000);
        $special_prize->left_amount = $special_prize->total_amount;
        $special_prize->save();

        Artisan::call('mqtt:publish kunewyear2566/close-prize ' . $id);
        return redirect()->route('staff.prizes');
    }

    public function drawButton()
    {
        return view('staff.prizes.big-button');
    }

    public function draw()
    {
        $video_number = rand(0, 1);
        $filename = "lucky-draw-chestload.mp4";
        if ($video_number == 1) $filename = "lucky-draw-boxload.mp4";
        return view('lucky-draw.index', ['filename' => $filename]);
    }

}
