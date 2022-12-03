<?php

namespace App\Http\Controllers;

use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!Auth::user()->isStaff()) return redirect()->route('/');

        $organizers = Organizer::orderBy('fac_id')->get();
        return view('staff.index', ['organizers' => $organizers]);
    }

    public function show($id)
    {
        if (!Auth::user()->isStaff()) return redirect()->route('/');

        $organizer = Organizer::where('id', $id)->firstOrFail();
        $employees = $organizer->employees->sortByDesc('register_at');
        return view('staff.show', [
            'organizer' => $organizer,
            'employees' => $employees
        ]);
    }
}
