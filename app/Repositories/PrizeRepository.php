<?php

namespace App\Repositories;


use Illuminate\Support\Facades\Redis;

class PrizeRepository
{
    public function drawPrize(int $id) {
        $key = "drawPrize:" . $id;
        $drewPrize = Redis::keys($key);
        if ($drewPrize) return false;
        Redis::set($key, $id);
        return true;
    }
}
