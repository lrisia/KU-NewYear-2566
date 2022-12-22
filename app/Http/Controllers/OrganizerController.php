<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganizerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!Auth::user()->isStaff()) return redirect()->back();

        $organizers = Organizer::orderBy('fac_id')->get();
        return view('staff.organizers.index', ['organizers' => $organizers]);
    }

    public function show($id)
    {
        if (!Auth::user()->isStaff()) return redirect()->route('/');

        $organizer = Organizer::where('fac_id', $id)->firstOrFail();
        $employees = $organizer->employees->sortByDesc('register_at');
        return view('staff.organizers.show', [
            'organizer' => $organizer,
            'employees' => $employees
        ]);
    }

    public function dashboard()
    {
        if (!Auth::user()->isStaff()) return redirect()->back();

        $top_register = Employee::select(DB::raw('count(*) as employee_count, organizer_id'))
            ->whereNotNull('register_at')
            ->groupBy('organizer_id')
            ->get()
            ->sortByDesc('employee_count')
            ->skip(0)->take(10);

        $top_attend = Employee::select(DB::raw('count(*) as employee_count, organizer_id'))
            ->whereNotNull('arrive_at')
            ->groupBy('organizer_id')
            ->get()
            ->sortByDesc('employee_count')
            ->skip(0)->take(10);

        $top_prize = Employee::select(DB::raw('count(*) as employee_count, organizer_id'))
            ->whereNotNull('got_prize_at')
            ->groupBy('organizer_id')
            ->get()
            ->sortByDesc('employee_count')
            ->skip(0)->take(10);

        $organizers = Organizer::get();
        return view('staff.dashboard', [
            'top_register' => $top_register,
            'organizers' => $organizers,
            'top_attend' => $top_attend,
            'top_prize' => $top_prize
        ]);
    }
}
