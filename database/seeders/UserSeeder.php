<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Administrator S.';
            $user->email = 'admin@example.com';
            $user->password = Hash::make('adminpass');
            $user->role = 'STAFF';
            $user->save();
        }

        $user = User::where('email', 'register@example.com')->first();
        if (!$user) {
            $user = new User;
            $user->name = 'Register S.';
            $user->email = 'register@example.com';
            $user->password = Hash::make('registerpass');
            $user->role = 'REGISTER';
            $user->save();
        }
    }
}
