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
        $this->middleware('auth')->except(['search']);
    }

    public function indexStaff() {
        $prizes = Prize::orderBy('type')->orderBy('prize_no','asc')->get();
        return view('staff.lucky-draw.index', ['prizes' => $prizes]);
    }

    public function index() {
        if (!Auth::user()->isStaff()) return redirect()->back();

        $prizes = Prize::orderBy('type')->orderBy('prize_no','asc')->get();
        return view('staff.prizes.index', ['prizes' => $prizes]);
    }

    public function selectPrize(Request $request) {
        $id = $request->input('id');
        Artisan::call('mqtt:publish kunewyear2566/enable-prize ' . $id);
//        $prize = Prize::find($id);
//        $prize->enable = false;
//        $prize->save();
        return redirect()->back();
    }

    public function drawButton() {
        return view('staff.prizes.big-button');
    }

    public function draw() {
        $video_number = rand(0, 1);
        $filename = "lucky-draw-chest.mp4";
        if ($video_number == 1) $filename = "lucky-draw-dropbox.mp4";
        return view('lucky-draw.index', ['filename' => $filename]);
    }

    public function show(Request $request, $id)
    {
        $prize = Prize::where('id', $id)->firstOrFail();
        $keyword = $request->query('keyword') ?? null;
        $query = Employee::query();
        if (!is_null($keyword)) {
            $query = $query->searchName($keyword);
            $employees = $query->where('prize_id', $id)->whereNotNull('got_prize_at')->latest('got_prize_at')->get();
            return view('staff.prizes.show', ['prize' => $prize, 'employees' => $employees, 'keyword' => $keyword]);
        } 
        $employees = $prize->employees->sortBy('name');
        return view('staff.prizes.show', ['prize' => $prize, 'employees' => $employees, 'keyword' => $keyword]);
    }

    public function search(Request $request)
    {
        if (!Auth::user()->isStaff()) return redirect()->route('/');

        $keyword = $request->query('keyword') ?? null;
        $query = Employee::query();
        if (!is_null($keyword)) {
            $query = $query->searchName($keyword);
        }
        $employees = $query->whereNotNull('got_prize_at')->latest('got_prize_at')->get();
        return view('staff.prizes.search', ['employees' => $employees, 'keyword' => $keyword]);
    }

}
