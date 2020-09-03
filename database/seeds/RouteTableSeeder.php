<?php

use Illuminate\Database\Seeder;

class RouteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date("Y-m-d H:i:s");

        DB::table('routes')->insert([
            // Krasnodar - Rostov-on-Don
            ['name' => 'N1', 'departure' => 1, 'destination' => 2, 'departure_time' => '6:15:00', 'arrival_time' => '10:15:00', 'created_at' => $timestamp],
            ['name' => 'N2', 'departure' => 2, 'destination' => 1, 'departure_time' => '10:45:00', 'arrival_time' => '14:45:00', 'created_at' => $timestamp],
            ['name' => 'N3', 'departure' => 1, 'destination' => 2, 'departure_time' => '15:15:00', 'arrival_time' => '19:25:00', 'created_at' => $timestamp],
            ['name' => 'N4', 'departure' => 2, 'destination' => 1, 'departure_time' => '20:00:00', 'arrival_time' => '23:55:00', 'created_at' => $timestamp],
            ['name' => 'N5', 'departure' => 2, 'destination' => 1, 'departure_time' => '6:00:00', 'arrival_time' => '10:00:00', 'created_at' => $timestamp],
            ['name' => 'N6', 'departure' => 1, 'destination' => 2, 'departure_time' => '10:30:00', 'arrival_time' => '14:35:00', 'created_at' => $timestamp],
            ['name' => 'N7', 'departure' => 2, 'destination' => 1, 'departure_time' => '15:10:00', 'arrival_time' => '19:15:00', 'created_at' => $timestamp],
            ['name' => 'N8', 'departure' => 1, 'destination' => 2, 'departure_time' => '19:45:00', 'arrival_time' => '23:40:00', 'created_at' => $timestamp],

            // Krasnodar - Stavropol
            ['name' => 'N11', 'departure' => 1, 'destination' => 5, 'departure_time' => '6:30:00', 'arrival_time' => '10:45:00', 'created_at' => $timestamp],
            ['name' => 'N12', 'departure' => 5, 'destination' => 1, 'departure_time' => '11:15:00', 'arrival_time' => '15:30:00', 'created_at' => $timestamp],
            ['name' => 'N13', 'departure' => 1, 'destination' => 5, 'departure_time' => '16:00:00', 'arrival_time' => '20:20:00', 'created_at' => $timestamp],
            ['name' => 'N14', 'departure' => 5, 'destination' => 1, 'departure_time' => '20:50:00', 'arrival_time' => '00:05:00', 'created_at' => $timestamp],

            // Krasnodar - Maykop
            ['name' => 'N21', 'departure' => 1, 'destination' => 3, 'departure_time' => '6:00:00', 'arrival_time' => '8:00:00', 'created_at' => $timestamp],
            ['name' => 'N22', 'departure' => 3, 'destination' => 1, 'departure_time' => '8:20:00', 'arrival_time' => '10:20:00', 'created_at' => $timestamp],
            ['name' => 'N23', 'departure' => 1, 'destination' => 3, 'departure_time' => '10:40:00', 'arrival_time' => '12:40:00', 'created_at' => $timestamp],
            ['name' => 'N24', 'departure' => 3, 'destination' => 1, 'departure_time' => '13:10:00', 'arrival_time' => '15:15:00', 'created_at' => $timestamp],
            ['name' => 'N25', 'departure' => 1, 'destination' => 3, 'departure_time' => '15:40:00', 'arrival_time' => '17:50:00', 'created_at' => $timestamp],
            ['name' => 'N26', 'departure' => 3, 'destination' => 1, 'departure_time' => '18:20:00', 'arrival_time' => '20:20:00', 'created_at' => $timestamp],
            ['name' => 'N27', 'departure' => 1, 'destination' => 3, 'departure_time' => '20:30:00', 'arrival_time' => '22:30:00', 'created_at' => $timestamp],
            ['name' => 'N28', 'departure' => 3, 'destination' => 1, 'departure_time' => '22:55:00', 'arrival_time' => '00:50:00', 'created_at' => $timestamp],

            // Krasnodar - Gelendzhik
            ['name' => 'N31', 'departure' => 1, 'destination' => 7, 'departure_time' => '6:20:00', 'arrival_time' => '9:30:00', 'created_at' => $timestamp],
            ['name' => 'N32', 'departure' => 7, 'destination' => 1, 'departure_time' => '10:00:00', 'arrival_time' => '13:25:00', 'created_at' => $timestamp],
            ['name' => 'N33', 'departure' => 1, 'destination' => 7, 'departure_time' => '14:10:00', 'arrival_time' => '17:20:00', 'created_at' => $timestamp],
            ['name' => 'N34', 'departure' => 7, 'destination' => 1, 'departure_time' => '18:00:00', 'arrival_time' => '21:20:00', 'created_at' => $timestamp],

            // Krasnodar - Anapa
            ['name' => 'N41', 'departure' => 1, 'destination' => 6, 'departure_time' => '6:10:00', 'arrival_time' => '9:45:00', 'created_at' => $timestamp],
            ['name' => 'N42', 'departure' => 6, 'destination' => 1, 'departure_time' => '10:15:00', 'arrival_time' => '13:45:00', 'created_at' => $timestamp],
            ['name' => 'N43', 'departure' => 1, 'destination' => 6, 'departure_time' => '14:30:00', 'arrival_time' => '18:00:00', 'created_at' => $timestamp],
            ['name' => 'N44', 'departure' => 6, 'destination' => 1, 'departure_time' => '18:30:00', 'arrival_time' => '21:40:00', 'created_at' => $timestamp],

            // Rostov-on-Don - Volgodonsk
            ['name' => 'N51', 'departure' => 2, 'destination' => 11, 'departure_time' => '6:30:00', 'arrival_time' => '10:30:00', 'created_at' => $timestamp],
            ['name' => 'N52', 'departure' => 11, 'destination' => 2, 'departure_time' => '11:00:00', 'arrival_time' => '14:05:00', 'created_at' => $timestamp],
            ['name' => 'N53', 'departure' => 2, 'destination' => 11, 'departure_time' => '15:00:00', 'arrival_time' => '19:05:00', 'created_at' => $timestamp],
            ['name' => 'N54', 'departure' => 11, 'destination' => 2, 'departure_time' => '19:35:00', 'arrival_time' => '23:35:00', 'created_at' => $timestamp],

            // Rostov-on-Don - Elista
            ['name' => 'N61', 'departure' => 2, 'destination' => 9, 'departure_time' => '6:15:00', 'arrival_time' => '12:25:00', 'created_at' => $timestamp],
            ['name' => 'N62', 'departure' => 9, 'destination' => 2, 'departure_time' => '13:30:00', 'arrival_time' => '19:35:00', 'created_at' => $timestamp],
            ['name' => 'N63', 'departure' => 2, 'destination' => 9, 'departure_time' => '9:00:00', 'arrival_time' => '15:10:00', 'created_at' => $timestamp],
            ['name' => 'N64', 'departure' => 9, 'destination' => 2, 'departure_time' => '15:45:00', 'arrival_time' => '22:05:00', 'created_at' => $timestamp],

            // Rostov-on-Don - Yeysk
            ['name' => 'N71', 'departure' => 2, 'destination' => 8, 'departure_time' => '6:40:00', 'arrival_time' => '9:50:00', 'created_at' => $timestamp],
            ['name' => 'N72', 'departure' => 8, 'destination' => 2, 'departure_time' => '10:15:00', 'arrival_time' => '13:30:00', 'created_at' => $timestamp],
            ['name' => 'N73', 'departure' => 2, 'destination' => 8, 'departure_time' => '14:00:00', 'arrival_time' => '17:15:00', 'created_at' => $timestamp],
            ['name' => 'N74', 'departure' => 8, 'destination' => 2, 'departure_time' => '17:45:00', 'arrival_time' => '20:55:00', 'created_at' => $timestamp],

            // Mineralnye Vody - Elista
            ['name' => 'N81', 'departure' => 4, 'destination' => 9, 'departure_time' => '6:40:00', 'arrival_time' => '11:50:00', 'created_at' => $timestamp],
            ['name' => 'N82', 'departure' => 9, 'destination' => 4, 'departure_time' => '12:50:00', 'arrival_time' => '18:00:00', 'created_at' => $timestamp],
            ['name' => 'N83', 'departure' => 4, 'destination' => 9, 'departure_time' => '9:40:00', 'arrival_time' => '14:50:00', 'created_at' => $timestamp],
            ['name' => 'N84', 'departure' => 9, 'destination' => 4, 'departure_time' => '15:40:00', 'arrival_time' => '20:55:00', 'created_at' => $timestamp],

            // Mineralnye Vody - Vladikavkaz
            ['name' => 'N91', 'departure' => 4, 'destination' => 10, 'departure_time' => '6:30:00', 'arrival_time' => '9:50:00', 'created_at' => $timestamp],
            ['name' => 'N92', 'departure' => 10, 'destination' => 4, 'departure_time' => '10:20:00', 'arrival_time' => '13:45:00', 'created_at' => $timestamp],
            ['name' => 'N93', 'departure' => 4, 'destination' => 10, 'departure_time' => '14:15:00', 'arrival_time' => '17:40:00', 'created_at' => $timestamp],
            ['name' => 'N94', 'departure' => 10, 'destination' => 4, 'departure_time' => '18:10:00', 'arrival_time' => '21:30:00', 'created_at' => $timestamp],
            ['name' => 'N95', 'departure' => 4, 'destination' => 10, 'departure_time' => '21:50:00', 'arrival_time' => '01:00:00', 'created_at' => $timestamp],
            ['name' => 'N96', 'departure' => 10, 'destination' => 4, 'departure_time' => '3:05:00', 'arrival_time' => '06:20:00', 'created_at' => $timestamp],

            // Mineralnye Vody - Maykop
            ['name' => 'N101', 'departure' => 4, 'destination' => 3, 'departure_time' => '4:05:00', 'arrival_time' => '8:05:00', 'created_at' => $timestamp],
            ['name' => 'N102', 'departure' => 3, 'destination' => 4, 'departure_time' => '8:30:00', 'arrival_time' => '12:35:00', 'created_at' => $timestamp],
            ['name' => 'N103', 'departure' => 4, 'destination' => 3, 'departure_time' => '13:15:00', 'arrival_time' => '17:30:00', 'created_at' => $timestamp],
            ['name' => 'N104', 'departure' => 3, 'destination' => 4, 'departure_time' => '18:40:00', 'arrival_time' => '22:40:00', 'created_at' => $timestamp],

            // Mineralnye Vody - Stavropol
            ['name' => 'N111', 'departure' => 4, 'destination' => 5, 'departure_time' => '6:00:00', 'arrival_time' => '8:40:00', 'created_at' => $timestamp],
            ['name' => 'N112', 'departure' => 5, 'destination' => 4, 'departure_time' => '9:00:00', 'arrival_time' => '11:20:00', 'created_at' => $timestamp],
            ['name' => 'N113', 'departure' => 4, 'destination' => 5, 'departure_time' => '12:00:00', 'arrival_time' => '14:40:00', 'created_at' => $timestamp],
            ['name' => 'N114', 'departure' => 5, 'destination' => 4, 'departure_time' => '15:00:00', 'arrival_time' => '17:40:00', 'created_at' => $timestamp],
            ['name' => 'N115', 'departure' => 4, 'destination' => 5, 'departure_time' => '18:00:00', 'arrival_time' => '20:40:00', 'created_at' => $timestamp],
            ['name' => 'N116', 'departure' => 5, 'destination' => 4, 'departure_time' => '21:00:00', 'arrival_time' => '22:40:00', 'created_at' => $timestamp],


        ]);
    }
}
