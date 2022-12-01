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

        $organizers = Organizer::get();
        return view('organizers.index', ['organizers' => $organizers]);
    }

    public function show($id)
    {
        if (!Auth::user()->isStaff()) return redirect()->route('/');

        $organizer = Organizer::where('name', $id)->firstOrFail();
        return view('organizers.show', ['organizer' => $organizer]);
    }
}
