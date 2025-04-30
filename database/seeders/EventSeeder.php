<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // เพิ่มกิจกรรม Charity Run
        Event::create([
            'event_name' => 'Charity Run',
            'event_date' => '2025-06-01',
            'event_category' => 'Race',
            'registration_open_date' => '2025-01-01',
            'registration_close_date' => '2025-05-01',
            'event_status' => 'upcoming',
        ]);

        // เพิ่มกิจกรรม Virtual Marathon
        Event::create([
            'event_name' => 'Virtual Marathon',
            'event_date' => '2025-07-01',
            'event_category' => 'Virtual Run',
            'registration_open_date' => '2025-02-01',
            'registration_close_date' => '2025-06-01',
            'event_status' => 'open',
        ]);

        // เพิ่มกิจกรรม Run for Health
        Event::create([
            'event_name' => 'Run for Health',
            'event_date' => '2025-08-01',
            'event_category' => 'Race',
            'registration_open_date' => '2025-03-01',
            'registration_close_date' => '2025-07-01',
            'event_status' => 'closed',
        ]);
    }
}
