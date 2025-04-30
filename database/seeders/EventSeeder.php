<?php

namespace Database\Seeders;

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
            'package_id' => 2, // ตรวจสอบว่ามี package_id นี้ในตาราง packages
            'event_name' => 'Charity Run',
            'event_category' => 'Race',
            'event_date' => '2025-06-01',
            'event_location' => 'Bangkok Thailand',
            'event_province' => 'Bangkok',
            'registration_open_date' => '2025-01-01',
            'registration_close_date' => '2025-05-01',
            'event_status' => 'upcoming',
        ]);

        // เพิ่มกิจกรรม Virtual Marathon
        Event::create([
            'package_id' => 1, // ตรวจสอบว่ามี package_id นี้ในตาราง packages
            'event_name' => 'Virtual Marathon',
            'event_category' => 'Virtual Run',
            'event_date' => '2025-07-01',
            'event_location' => 'Online',
            'event_province' => 'Online',
            'registration_open_date' => '2025-02-01',
            'registration_close_date' => '2025-06-01',
            'event_status' => 'open',
        ]);

        // เพิ่มกิจกรรม Run for Health
        Event::create([
            'package_id' => 3, // ตรวจสอบว่ามี package_id นี้ในตาราง packages
            'event_name' => 'Run for Health',
            'event_category' => 'Race',
            'event_date' => '2025-08-01',
            'event_location' => 'Chiang Mai, Thailand',
            'event_province' => 'Chiang Mai',
            'registration_open_date' => '2025-03-01',
            'registration_close_date' => '2025-07-01',
            'event_status' => 'closed',
        ]);
    }
}
