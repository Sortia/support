<?php

use App\User;
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
        $user = new User();

        $user->name = 'admin';
        $user->email = 'admin@admin.admin';
        $user->is_manager = true;
        $user->password = Hash::make('admin');

        $user->save();
    }
}
