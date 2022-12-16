<?php

namespace App\Http\Controllers;

use App\Models\Prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class PrizeController extends Controller
{
    public function indexStaff() {
        $prizes = Prize::get();
        return view('staff.lucky-draw.index', ['prizes' => $prizes]);
    }

    public function index()
    {
        return view('lucky-draw.index');
    }

    public function selectPrize($id) {
        Artisan::call('mqtt:publish kunewyear2566/enable-prize ' . $id);
    }

    public function drawButton() {
        return view('staff.lucky-draw.big-button');
    }

    public function draw() {
        $video_number = rand(0, 1);
        $filename = "lucky-draw-chest.mp4";
        if ($video_number == 1) $filename = "lucky-draw-dropbox.mp4";
        return view('lucky-draw.draw', ['filename' => $filename]);
    }
}
