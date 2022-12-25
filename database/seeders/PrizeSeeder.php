<?php

namespace Database\Seeders;

use App\Models\Prize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amount = [5, 10, 10, 10, 20, 30, 60];
        $money = [10000, 7000, 5000, 3000, 2000, 1000, 500];
        for ($i = 0; $i < count($amount); $i++) {
            $prize = new Prize();
            $prize->type = "รางวัลที่ " . $i + 1;
            $prize->description = "เงินรางวัลมูลค่า " . number_format($money[$i]) . " บาท";
            $prize->prize_no = $i + 1;
            $prize->total_amount = $amount[$i];
            $prize->left_amount = $amount[$i];
            $prize->money_amount = $money[$i];
            $prize->save();
        }

        $prize = new Prize();
        $prize->type = "รางวัลพิเศษ";
        $prize->description = "รางวัลพิเศษ เพิ่มขึ้นตามรางวัลที่ไม่มีผู้รับ";
        $prize->prize_no = 0;
        $prize->total_amount = 1;
        $prize->left_amount = 1;
        $prize->money_amount = 6000;
        $prize->save();
    }
}
