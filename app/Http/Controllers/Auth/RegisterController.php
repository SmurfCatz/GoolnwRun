<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * กำหนดหน้าที่จะเปลี่ยนเส้นทางหลังจากการลงทะเบียนสำเร็จ
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * สร้างอินสแตนซ์ของตัวควบคุม
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'member_name' => ['required', 'string', 'max:255'],
            'member_email' => ['required', 'string', 'email', 'max:255', 'unique:members'],
            'member_tel' => ['required', 'regex:/^\d{3}-\d{3}-\d{4}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // การใช้ 'confirmed'
        ]);
    }

    /**
     * สร้างผู้ใช้ใหม่หลังจากการลงทะเบียนที่ถูกต้อง
     *
     * @param  array  $data
     * @return \App\Models\Member
     */
    protected function create(array $data)
    {
        return Member::create([
            'member_name' => $data['member_name'],
            'member_email' => $data['member_email'],
            'member_tel' => $data['member_tel'],
            'member_password' => Hash::make($data['password']),  // ใช้ 'member_password' ที่นี่
            'member_role' => 'user',
        ]);
    }
    /**
     * จัดการคำขอลงทะเบียนสำหรับผู้ใช้
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // สร้างผู้ใช้ใหม่
        $Member = $this->create($request->all());

        // เข้าสู่ระบบ
        Auth::login($Member);

        // เปลี่ยนเส้นทางไปที่หน้าจัดการโปรไฟล์
        return redirect()->route('profile.edit');
    }
}
