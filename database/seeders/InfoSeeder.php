<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Info;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        Category::create(['name' => 'رياض']);
        Category::create(['name' => 'تمهيدى']);
        DB::table('infos')->delete();
        Info::create(['option' => 'website_name_en','value' => 'Orjoha','type' => 'string']);
        Info::create(['option' => 'website_name_ar','value' => 'أرجوحة','type' => 'string']);
        Info::create(['option' => 'main_color','value' => 'blue','type' => 'color']);
        Info::create(['option' => 'secodary_color','value' => 'blue','type' => 'color']);
        Info::create(['option' => 'logo_en','value' => 'logo.png','type' => 'image']);
        Info::create(['option' => 'logo_ar','value' => 'logo.png','type' => 'image']);
        Info::create(['option' => 'email','value' => 'info@arjoha.com','type' => 'email']);
        Info::create(['option' => 'phone','value' => '12345678','type' => 'number']);
        Info::create(['option' => 'address','value' => 'cairo-giza','type' => 'string']);
        Info::create(['option' => 'fb_link','value' => 'www.facebook.com','type' => 'string']);
        Info::create(['option' => 'twitter_link','value' => 'www.twitter.com','type' => 'string']);
        Info::create(['option' => 'linked_link','value' => 'www.linkedin.com','type' => 'string']);
        Info::create(['option' => 'instagram_link','value' => 'www.instagram.com','type' => 'string']);
        Info::create(['option' => 'bio_en','value' => '','type' => 'text']);
        Info::create(['option' => 'bio_ar','value' => '','type' => 'text']);
        Info::create(['option' => 'about_us_en','value' => '','type' => 'text']);
        Info::create(['option' => 'about_us_ar','value' => '','type' => 'text']);
        Info::create(['option' => 'policy_en','value' => '','type' => 'text']);
        Info::create(['option' => 'policy_ar','value' => '','type' => 'text']);
        Info::create(['option' => 'privacy_en','value' => '','type' => 'text']);
        Info::create(['option' => 'privacy_ar','value' => '','type' => 'text']);
    }
}
