<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organizer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginOrganizerController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest:organizer')->except('logout');  // กำหนดเฉพาะ 'organizer' guard
        
    }

    public function loginOrganizer(Request $request)
    {
        // รับข้อมูลจาก form
        $input = $request->all();

        // ตรวจสอบความถูกต้องของข้อมูล
        $this->validate($request, [
            'organizer_email' => 'required|email',
            'organizer_password' => 'required',
        ]);

        // ค้นหาผู้จัดงานจากฐานข้อมูล
        $organizer = Organizer::where('organizer_email', $input['organizer_email'])->first();

        // ตรวจสอบว่าอีเมลและรหัสผ่านตรงกัน
        if ($organizer && Hash::check($input['organizer_password'], $organizer->organizer_password)) {
            // ใช้ guard 'organizer' เพื่อล็อกอิน
            Auth::guard('organizer')->login($organizer);

            // เปลี่ยนเส้นทางไปที่หน้า home ของ organizer
            return redirect()->route('organizer.home');
        } else {
            // หากข้อมูลไม่ถูกต้องให้กลับไปที่หน้า login พร้อมกับ error
            return redirect()->route('organizer.login')
                ->with('error', 'Email Address or Password is incorrect.');
        }
    }

    public function showOrganizerLoginForm()
    {
        return view('organizer.login');  // แสดงหน้า login ของ organizer
    }
}
