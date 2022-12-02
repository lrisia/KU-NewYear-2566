<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UserCreator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->ask("Enter User Email (Use email for credential in backend)");
        $user = User::where('email', $email)->first();
        if ($user) {
            $this->line("Email {$email} has been used");
            return Command::SUCCESS;
        }

        $password = $this->ask("Enter password");
        $name = $this->ask("Enter user's name");
        $role = $this->askWithCompletion("Role?", ['STAFF', 'ADMIN'], 'STAFF');

        $this->line("Create user with this data");
        $this->table([
            'email', 'password', 'name', 'role'
        ], [
            [
                $email, $password, $name, $role
            ]
        ]);

        $confirmed = $this->confirm("Are you sure?", false);

        if ($confirmed) {
            $user = new User();
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->name = $name;
            $user->role = $role;
            $user->save();
            $this->line("User {$email} has been created");
        }
        return Command::SUCCESS;
    }
}
