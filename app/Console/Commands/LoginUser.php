<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginUser extends Command
{
    protected $signature = 'user:login {email} {password}';
    protected $description = 'Log in a user via CLI';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error('No user found with this email.');
            return 1;
        }

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            $this->error('Invalid credentials.');
            return 1;
        }

        $this->info('User logged in successfully.');
        return 0;
    }
}
