<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            ['name' => 'Scheduled'],
            ['name' => 'Delayed'],
            ['name' => 'Boarding'],
            ['name' => 'Departed'],
            ['name' => 'Arrived'],
            ['name' => 'Cancelled'],
            ['name' => 'No Info']
        ]);
    }
}
