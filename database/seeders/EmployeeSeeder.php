<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Organizer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organizers = Organizer::inRandomOrder()->get();
        foreach ($organizers as $organizer) {
            $member_amount = $organizer->member_amount;
            for ($i = 0; $i < $member_amount; $i++) {
                $employee = new Employee();
                $employee->p_id = fake()->numberBetween(100000, 999999);
                $employee->title = fake()->title();
                $employee->name = fake()->name();
                $employee->organizer_id = $organizer->id;
                $employee->save();
            }
        }
    }
}
