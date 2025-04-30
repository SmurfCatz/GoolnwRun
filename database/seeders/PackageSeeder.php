<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::create([
            'package_name' => 'กิจกรรมขนาดเล็ก',
            'package_price' => '2000',
            'package_maxparticipants' => '200',
            'package_extra_fee_per_person' => '20',
        ]);
        Package::create([
            'package_name' => 'กิจกรรมขนาดกลาง',
            'package_price' => '5000',
            'package_maxparticipants' => '500',
            'package_extra_fee_per_person' => '20',
        ]);
        Package::create([
            'package_name' => 'กิจกรรมขนาดใหญ่',
            'package_price' => '10000',
            'package_maxparticipants' => '0',
            'package_extra_fee_per_person' => '0',
        ]);
    }
}
// php artisan db:seed --class=PackageSeeder