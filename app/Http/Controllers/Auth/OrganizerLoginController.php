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
    $request->validate([
        'organizer_email' => 'required|email',
        'organizer_password' => 'required',
    ]);

    // ค้นหาผู้จัดงาน
    $organizer = Organizer::where('organizer_email', $request->organizer_email)->first();

    if ($organizer && Hash::check($request->organizer_password, $organizer->organizer_password)) {

        // **เช็กว่าได้รับอนุมัติหรือยัง**
        if (!$organizer->is_approved) {
            return redirect()->route('organizer.login')->with('error', 'บัญชีของคุณยังไม่ได้รับการอนุมัติจากแอดมิน');
        }

        Auth::guard('organizer')->login($organizer);
        return redirect()->route('organizer.home')->with('success', 'เข้าสู่ระบบสำเร็จ!');
    }

    return redirect()->route('organizer.login')->with('error', 'อีเมลหรือรหัสผ่านไม่ถูกต้อง');
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
