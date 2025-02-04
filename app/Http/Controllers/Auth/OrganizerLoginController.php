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
        // กำหนดกฎการตรวจสอบข้อมูล
        $this->validate($request, [
            'organizer_email' => 'required|email',
            'organizer_password' => 'required',
        ]);

        // ตรวจสอบข้อมูลผู้ใช้จาก Organizer
        $organizer = Organizer::where('organizer_email', $request->input('organizer_email'))->first();

        // หากพบผู้ใช้และรหัสผ่านถูกต้อง
        if ($organizer && Hash::check($request->input('organizer_password'), $organizer->organizer_password)) {
            // เข้าสู่ระบบ
            Auth::guard('organizer')->login($organizer);


            // เปลี่ยนเส้นทางไปที่หน้า home ของ organizer
            return redirect()->route('organizer.home');
        }

        // ถ้าผิดพลาดกลับไปที่หน้า login พร้อมข้อความ error
        return redirect()->route('organizer.login')
            ->with('error', 'Email Address or Password is incorrect.');
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
