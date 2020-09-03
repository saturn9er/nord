<?php

use Illuminate\Database\Seeder;

class DocumentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->insert([
            ['name' => 'Паспорт гражданина РФ'],
            ['name' => 'Паспорт моряка'],
            ['name' => 'Общегражданский заграничный паспорт гражданина РФ'],
            ['name' => 'Паспорт иностранного гражданина'],
            ['name' => 'Свидетельство о рождении'],
            ['name' => 'Удостоверение личности военнослужащего'],
            ['name' => 'Удостоверение личности лица без гражданства'],
            ['name' => 'Временное удостоверение личности, выдаваемое органами внутренних дел'],
            ['name' => 'Военный билет военнослужащего срочной службы'],
            ['name' => 'Вид на жительство иностранного гражданина или лица без гражданства'],
            ['name' => 'Справка об освобождении из мест лишения свободы'],
            ['name' => 'Паспорт гражданина СССР'],
            ['name' => 'Паспорт дипломатический'],
            ['name' => 'Паспорт служебный (кроме паспорта моряка и дипломатического)'],
            ['name' => 'Свидетельство о возвращении из стран СНГ'],
            ['name' => 'Справка об утере паспорта'],
        ]);
    }
}