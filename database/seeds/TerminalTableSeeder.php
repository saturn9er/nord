<?php

use Illuminate\Database\Seeder;

class TerminalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = date("Y-m-d H:i:s");

        DB::table('terminals')->insert([
            ['name' => 'Краснодар (аэропорт Пашковский)', 'short_name' => 'Краснодар', 'location' => '45.034541, 39.137960', 'created_at' => $timestamp],
            ['name' => 'Ростов-на-Дону (аэропорт Платов)', 'short_name' => 'Ростов-на-Дону', 'location' => '47.488030, 39.929938', 'created_at' => $timestamp],
            ['name' => 'Майкоп (ж/д вокзал Майкоп)', 'short_name' => 'Майкоп', 'location' => '44.622058, 40.108215', 'created_at' => $timestamp],
            ['name' => 'Минеральные воды (аэропорт Минеральные воды)', 'short_name' => 'Минеральные воды', 'location' => '44.217281, 43.087394', 'created_at' => $timestamp],
            ['name' => 'Ставрополь (аэропорт Ставрополь)', 'short_name' => 'Ставрополь', 'location' => '45.113482, 42.105453', 'created_at' => $timestamp],
            ['name' => 'Анапа (аэропорт Витязево)', 'short_name' => 'Анапа', 'location' => '45.003484, 37.340227', 'created_at' => $timestamp],
            ['name' => 'Геленджик (аэропорт Геленджик)', 'short_name' => 'Геленджик', 'location' => '44.594314, 38.025507', 'created_at' => $timestamp],
            ['name' => 'Ейск (ж/д вокзал Ейск)', 'short_name' => 'Ейск', 'location' => '46.716087, 38.281986', 'created_at' => $timestamp],
            ['name' => 'Элиста (ж/д вокзал Элиста)', 'short_name' => 'Элиста', 'location' => '46.327013, 44.282177', 'created_at' => $timestamp],
            ['name' => 'Владикавказ (ж/д вокзал Владикавказ)', 'short_name' => 'Владикавказ', 'location' => '43.037759, 44.687875', 'created_at' => $timestamp],
            ['name' => 'Волгодонск (ж/д вокзал Волгодонск)', 'short_name' => 'Волгодонск', 'location' => '47.517536, 42.159536', 'created_at' => $timestamp]
        ]);
    }
}
