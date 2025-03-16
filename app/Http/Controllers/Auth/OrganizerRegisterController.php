<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerRegisterController extends Controller
{
    /**
     * กำหนดหน้าที่จะเปลี่ยนเส้นทางหลังจากการลงทะเบียนสำเร็จ
     *
     * @var string
     */
    protected $redirectTo = '/organizer/home';

    /**
     * สร้างอินสแตนซ์ของตัวควบคุม
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:organizer')->except('logout');
    }

    /**
     * รับตัวตรวจสอบสำหรับคำขอลงทะเบียน
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'organizer_name' => ['required', 'string', 'max:255'],
            'organizer_email' => ['required', 'string', 'email', 'max:255', 'unique:organizers'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],  // การใช้ 'confirmed'
        ]);
    }

    /**
     * สร้างผู้จัดงานใหม่หลังจากการลงทะเบียนที่ถูกต้อง
     *
     * @param  array  $data
     * @return \App\Models\Organizer
     */
    protected function create(array $data)
    {
        return Organizer::create([
            'organizer_name' => $data['organizer_name'],
            'organizer_email' => $data['organizer_email'],
            'organizer_password' => Hash::make($data['password']),
             'is_approved' => false,  // กำหนดให้รอการอนุมัติ
        ]);
    }

    /**
     * จัดการคำขอลงทะเบียนสำหรับผู้จัดงาน
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Register(Request $request)
    {
        // ตรวจสอบข้อมูลที่ได้รับ
        $this->validator($request->all())->validate();

        // สร้างผู้จัดงานใหม่
        $organizer = $this->create($request->all());

        // เข้าสู่ระบบ
        Auth::guard('organizer')->login($organizer);


        // เปลี่ยนเส้นทางไปที่หน้าหลักหลังจากลงทะเบียนสำเร็จ
        return redirect()->route('organizer.home');
    }

    /**
     * แสดงฟอร์มลงทะเบียนสำหรับผู้จัดงาน
     *
     * @return \Illuminate\View\View
     */
    public function showOrganizerForm()
    {
        return view('auth.organizer_register');
    }
}

