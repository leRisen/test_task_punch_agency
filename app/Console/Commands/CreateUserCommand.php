<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $login = $this->ask('What is your login?', fake()->username());
        $password = $this->secret('What is the password? (default: password)');

        User::factory()->create([
            'login' => $login,
            'password' => $password ? Hash::make($password) : Hash::make('password'),
        ]);

        $this->info('User created!');
    }
}
