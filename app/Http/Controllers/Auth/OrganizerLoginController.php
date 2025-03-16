<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organizer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class OrganizerLoginController extends Controller
{
    /**
     * กำหนดเส้นทางหลังจากเข้าสู่ระบบสำเร็จ
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * สร้างอินสแตนซ์ของตัวควบคุม
     */
    public function __construct()
    {
        $this->middleware('guest:organizer')->except('logout');
        $this->middleware('auth:organizer')->only('logout');
    }

    /**
     * ฟังก์ชันการเข้าสู่ระบบสำหรับ Organizer
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
{
    // กำหนดกฎการตรวจสอบข้อมูลที่รับมาจากฟอร์ม
    $this->validate($request, [
        'organizer_email' => 'required|email',  // ตรวจสอบว่ามีอีเมลและเป็นฟอร์แมตที่ถูกต้อง
        'organizer_password' => 'required',     // ตรวจสอบว่ามีรหัสผ่าน
    ]);

    // รับข้อมูลที่ส่งมาจากฟอร์ม
    $email = $request->input('organizer_email');
    $password = $request->input('organizer_password');

    // ตรวจสอบข้อมูลผู้ใช้จาก Organizer โดยใช้ email
    $organizer = Organizer::where('organizer_email', $email)->first();

    // ถ้าพบผู้ใช้และรหัสผ่านตรงกัน
    if ($organizer && Hash::check($password, $organizer->organizer_password)) {
        // ตรวจสอบสถานะการอนุมัติของ Organizer
        if ($organizer->is_approved == 0) { // ถ้า is_approved เป็น 0 (ไม่ได้รับการอนุมัติ)
            return back()->withErrors([
                'organizer_email' => 'บัญชีของคุณยังไม่ได้รับการอนุมัติจากผู้ดูแลระบบ',
            ]);
        }

        // เข้าสู่ระบบ
        Auth::guard('organizer')->login($organizer);

        // เปลี่ยนเส้นทางไปที่หน้า home ของ organizer
        return redirect()->route('organizer.home');
    }

    // ถ้าข้อมูลไม่ถูกต้อง, กลับไปที่หน้า login และแสดงข้อความ error
    return back()->withErrors([
        'organizer_email' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง',
    ]);
}



    /**
     * ฟังก์ชันการออกจากระบบ
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('organizer')->logout();
        return redirect()->route('organizer.login');
    }

    /**
     * ฟังก์ชันแสดงฟอร์มเข้าสู่ระบบสำหรับ Organizer
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.organizer_login');
    }
}
