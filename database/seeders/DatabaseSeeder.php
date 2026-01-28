<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $faker = Faker::create();

        

    	DB::table('admins')->insert([
            'id' => '1',
            'username' => 'admin',
            'password' => Hash::make('123456')
        ]);

        DB::table('general_setting')->insert([
            'site_name' => 'RentACar',
            'site_title' => 'RentACar : Car rental System',
            'site_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris',
            'contact_email' => 'contact@website.com',
            'contact_phone' => '9856231041',
            'contact_address' => 'New York, US',
            'cur_format' => '$',
            'theme_color' => '#ff0000'
        ]);

        DB::table('rental_settings')->insert([
            'deposit_payment' => '10',
            'tax_payment' => '11',
        ]);

        DB::table('social_settings')->insert(
            [
            'id' => '1',
            'name' => 'facebook',
            'value' => 'https://www.facebook.com',
            'status' => '1',
        ]);
        DB::table('social_settings')->insert(
            [
            'id' => '2',
            'name' => 'instagram',
            'value' => 'https://www.instagram.com',
            'status' => '1',
        ]);
        DB::table('social_settings')->insert(
            [
            'id' => '3',
            'name' => 'twitter',
            'value' => 'https://www.twitter.com',
            'status' => '1',
        ]);
        DB::table('banners')->insert(
            [
            'title' => 'Lorem ipsum dolor sit amet',
            'desc' => 'consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco',
            'image' => 'ban1.jpg',
        ]);
        DB::table('banners')->insert(
            [
            'title' => 'Lorem ipsum dolor sit amet',
            'desc' => 'consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco',
            'image' => 'ban2.jpg',
        ]);
        DB::table('pages')->insert(
            [
            'title' => 'About Us',
            'slug' => 'about',
            'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
        ]);
    }
}
