<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubEvent;

class SubEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubEvent::create([
            'event_id' => 1,
            'sub_event_name' => 'Fun Run',
            'sub_event_distance' => 5,
            'registration_fee' => 300.00,
        ]);

        SubEvent::create([
            'event_id' => 1,
            'sub_event_name' => 'Mini Marathon',
            'sub_event_distance' => 10,
            'registration_fee' => 500.00,
        ]);

        SubEvent::create([
            'event_id' => 2,
            'sub_event_name' => 'Virtual Half Marathon',
            'sub_event_distance' => 21,
            'registration_fee' => 700.00,
        ]);
    }
}
