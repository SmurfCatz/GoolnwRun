<?php

namespace App\Http\Controllers\Organizer;

use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrganizerAuthController extends Controller
{
    // ลงทะเบียน
    public function Organizerregister(Request $request)
    {
        // กำหนด validation rules
        $validator = Validator::make($request->all(), [
            'organizer_name' => 'required|string|max:255',
            'organizer_email' => 'required|email|unique:organizers',
            'password' => 'required|min:6|confirmed',
            
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422); 
        }

        // บันทึกข้อมูลลงฐานข้อมูล
        $organizer = new Organizer();
        $organizer->organizer_name = $request->organizer_name;
        $organizer->organizer_email = $request->organizer_email;
        $organizer->organizer_password = Hash::make($request->password); // เก็บรหัสผ่านที่เข้ารหัสแล้ว
        $organizer->organizer_tel = $request->organizer_tel;
        $organizer->organizer_details = $request->organizer_details;
        $organizer->organizer_idcard = $request->organizer_idcard;
        $organizer->organizer_experience = $request->organizer_experience;
        // เพิ่มฟิลด์ที่เหลือตามต้องการ
        $organizer->save();

        return response()->json([
            'message' => 'Organizer registered successfully',
            'data' => $organizer
        ], 201); // คืนค่าข้อมูลผู้ใช้ที่ลงทะเบียนใหม่
    }

    // เข้าสู่ระบบ
    public function Organizerlogin(Request $request)
    {
        $request->validate([
            'organizer_email' => 'required|email',
            'organizer_password' => 'required|string',
        ]);

        if (Auth::guard('organizer')->attempt([
            'organizer_email' => $request->organizer_email,
            'organizer_password' => $request->organizer_password,
        ])) {
            return response()->json(['message' => 'Organizer logged in successfully']);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // ออกจากระบบ
    public function Organizerlogout()
    {
        Auth::guard('organizer')->logout();
        return response()->json(['message' => 'Organizer logged out successfully']);
    }

    public function LoginOrganizer(){
        return view('organizer.login');
    }

    public function RegisterOrganizer(){
        return view('organizer.register');
    }
}
