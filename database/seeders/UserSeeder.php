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
        $users->first_name = "Mustafa";
        $users->last_name = "Ali";
        $users->phone = "0123456789";
        $users->email = "admin@admin.com";
        $users->country_id = 1;
        $users->active = 1;
        $users->city_id = 1;
        $users->type = "admin";
        $users->password = Hash::make('12345678');
        $users->save();

    }
}
