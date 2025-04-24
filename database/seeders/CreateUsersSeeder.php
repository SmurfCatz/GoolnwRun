<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Member;
use Illuminate\Support\Facades\Hash;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'member_name' => 'Admin',
                'member_email' => 'Admin@admin.com',
                'member_role' => 'admin',
                'member_password' => Hash::make('12345678')
            ],
            [
                'member_name' => 'User',
                'member_email' => 'User@user.com',
                'member_role' => 'user',
                'member_password' => Hash::make('12345678')
            ]
        ];

        foreach ($members as $key => $value) {
            // ตรวจสอบก่อนว่าผู้ใช้มีอยู่แล้วหรือไม่
            if (!Member::where('member_email', $value['member_email'])->exists()) {
                Member::create($value);
            }
        }
    }
}
