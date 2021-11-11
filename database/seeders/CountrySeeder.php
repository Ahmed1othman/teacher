<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->delete();
        Country::create(['name_en' => 'Egypt','name_ar'=>'مصر']);

        DB::table('cities')->delete();
        City::create(['name_en' => 'Cairo','name_ar'=>'القاهرة','country_id'=>1]);
        City::create(['name_en' => 'Alexandria','name_ar'=>'الاسكندرية','country_id'=>1]);
    }
}
