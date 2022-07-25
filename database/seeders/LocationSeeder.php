<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use URL;
class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'location_name' => 'Downtown Los Angles',
            'location_image' => URL::asset('uploads/location/los-angles.png'),
        ]);

         DB::table('locations')->insert([
            'location_name' => 'Inland Empire',
            'location_image' => URL::asset('uploads/location/inland.png'),
        ]);

        DB::table('locations')->insert([
            'location_name' => 'San Fernando valley',
            'location_image' => URL::asset('uploads/location/san-fernando.png'),
            
        ]);

        DB::table('locations')->insert([
            'location_name' => 'Orange Country',
            'location_image' => URL::asset('uploads/location/orange-country.png'),
            
        ]);

        DB::table('locations')->insert([
            'location_name' => 'Santa Barbara',
            'location_image' => URL::asset('uploads/location/santa-barbara.png'),
            
        ]);

        DB::table('locations')->insert([
            'location_name' => 'Bay Area',
            'location_image' =>URL::asset('uploads/location/bay-area.png'),
            
        ]);

        

    }
}
