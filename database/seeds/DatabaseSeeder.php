<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StatusTableSeeder::class,
            DocumentTypeTableSeeder::class,
            BusTableSeeder::class,
            TerminalTableSeeder::class,
            RouteTableSeeder::class,
            TripTableSeeder::class,
            SeatTableSeeder::class,
        ]);
    }
}
