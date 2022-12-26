<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(OrganizerSeeder::class);
        $this->call(UserSeeder::class);
//        $this->call(EmployeeSeeder::class);
        $this->call(PrizeSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
//        Artisan::call('employee:import people.csv');

        // seeder register
//        $employees = Employee::inRandomOrder()->limit(150)->get();
//        foreach ($employees as $employee) {
//            $employee->register_at = fake()->dateTimeBetween('-2 week', '-1 week');
//            $employee->email = fake()->email();
//            $employee->save();
//        }
//
//        $employees = Employee::inRandomOrder()->limit(150)->get();
//        foreach ($employees as $employee) {
//            $employee->arrive_at = Carbon::now();
//            $employee->save();
//        }
    }
}
