<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->delete();


        $users = new User();
        $users->name = "Mustafa";
        $users->phone = "0123456789";
        $users->email = "admin@admin.com";
        $users->active = 1;
        $users->type = "admin";
        $users->password = Hash::make('12345678');
        $users->save();
        $users = new User();
        $users->name = "teacher";
        $users->phone = "0123456789";
        $users->email = "teacher@gmail.com";
        $users->active = 1;
        $users->type = "teacher";
        $users->password = Hash::make('12345678');
        $users->save();
        $users = new User();
        $users->name = "student";
        $users->phone = "01234789";
        $users->email = "student@gmail.com";
        $users->active = 1;
        $users->type = "student";
        $users->password = Hash::make('12345678');
        $users->save();

    }
}
