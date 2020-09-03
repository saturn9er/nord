<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Services\TicketBuyService as Service;
use App\Trip;
use App\DocumentType;

class TicketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date               = '2018-05-02';
        $minNumberOfTickets = 40;
        $faker = Faker::create('ru_RU');
        $documentTypes = DocumentType::select('id')->get()->toArray();

        $trips = Trip::select('id', 'seats_left', 'price')->where('date', '=', $date)->get();

        foreach ($trips as $trip)
        {
            $passengers         = random_int($minNumberOfTickets, $trip->seats_left);
            $passengerID        = 1;
            $ticketPrice        = $trip->price;

            for($i = 0; $i < $passengers; $i++)
            {
                $name           = $faker->name;

                $documentType = $faker->randomElement($documentTypes);
                $documentType = $documentType['id'];

                $documentNumber = $faker->numerify('#### ######');
                $personalityID  = Service::addNewPersonality($name, $documentType, $documentNumber, $passengerID);
                $qrCode         = str_random(32);

                $seatID = Service::bookASeat($trip->id);

                Service::createTicket($ticketPrice, $trip->id, $personalityID, $passengerID, $seatID, $qrCode);
            }
        }
    }
}
