<?php

use Illuminate\Database\Seeder;

class BusTableSeeder extends Seeder
{
    /**
     * Run the bus seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date("Y-m-d H:i:s");

        DB::table('buses')->insert([
            ['plate_number' => 'А401ВХ123', 'seats' => 82, 'created_at' => $timestamp],
            ['plate_number' => 'А402ВХ123', 'seats' => 82, 'created_at' => $timestamp],
            ['plate_number' => 'А403ВХ123', 'seats' => 82, 'created_at' => $timestamp],
            ['plate_number' => 'А404ВХ123', 'seats' => 82, 'created_at' => $timestamp],
            ['plate_number' => 'А405ВХ123', 'seats' => 82, 'created_at' => $timestamp],
            ['plate_number' => 'А406ВХ123', 'seats' => 82, 'created_at' => $timestamp],
            ['plate_number' => 'А501ВХ123', 'seats' => 82, 'created_at' => $timestamp],
            ['plate_number' => 'А502ВХ123', 'seats' => 82, 'created_at' => $timestamp],
            ['plate_number' => 'А503ВХ123', 'seats' => 82, 'created_at' => $timestamp],
            ['plate_number' => 'А504ВХ123', 'seats' => 82, 'created_at' => $timestamp],
            ['plate_number' => 'А505ВХ123', 'seats' => 82, 'created_at' => $timestamp]
        ]);
    }
}
