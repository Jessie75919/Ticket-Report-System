<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    protected $signature = 'user:create';
    protected $description = 'create user';


    public function handle()
    {
        $userRole = $this->choice('User Role', ['RD', 'QA']);
        $userName  = $this->ask('What is your username ?');
        $userEmail = $this->ask('What is your Email ?');
        $userPw = $this->ask('What is your Password ?');

        DB::transaction(function () use ($userRole, $userName, $userEmail, $userPw){
            $user = User::create([
                'name' => $userName,
                'email' => $userEmail,
                'password' => Hash::make($userPw)
            ]);

            $role = Role::where(['name' => $userRole])->first();
            $user->roles()->attach($role->id);
        });

        $this->info('user_created_successfully');

        return 0;
    }
}
