<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // ใช้ middleware เพื่อให้เฉพาะ admin เข้าถึง
    }

    // ฟังก์ชันแสดงรายชื่อผู้ใช้ทั้งหมด
    public function index()
    {
        $Member = Member::all();
        return view('admin.users.index', compact('Member'));
    }

    // ฟังก์ชันแสดงฟอร์มเพิ่มผู้ใช้ใหม่
    public function create()
    {
        return view('admin.users.create'); // แสดงฟอร์มเพิ่มผู้ใช้
    }

    // ฟังก์ชันบันทึกผู้ใช้ใหม่
    public function store(Request $request)
    {
        $request->validate([
            'member_name' => 'required|string|max:255',
            'member_email' => 'required|email|unique:members,member_email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Member::create([
            'member_name' => $request->member_name,
            'member_email' => $request->member_email,
            'member_password' => bcrypt($request->password),
        ]);

        // ส่งข้อความ success หลังการสร้างสมาชิก
        return redirect()->route('admin.users.index')->with('success', 'Member created successfully');
    }


    // ฟังก์ชันแสดงข้อมูลของผู้ใช้
    public function show($id)
    {
        $Member = Member::findOrFail($id); // ดึงข้อมูลผู้ใช้ตาม ID
        return view('admin.users.show', compact('Member')); // แสดงข้อมูลผู้ใช้
    }

    // ฟังก์ชันแสดงฟอร์มแก้ไขข้อมูลผู้ใช้
    public function edit($id)
    {
        $Member = Member::findOrFail($id); // ดึงข้อมูลผู้ใช้ตาม ID
        return view('admin.users.edit', compact('Member')); // แสดงฟอร์มแก้ไขข้อมูล
    }

    // ฟังก์ชันอัพเดตข้อมูลผู้ใช้
    public function update(Request $request, $id)
    {
        $request->validate([
            'member_name' => 'required|string|max:255',
            'member_email' => 'required|email|unique:Members,member_email,' . $id,
            'member_password' => 'nullable|string|min:8|confirmed',
        ]);

        $Member = Member::findOrFail($id);
        $Member->member_name = $request->member_name;
        $Member->member_email = $request->member_email;
        if ($request->member_password) {
            $Member->member_password = bcrypt($request->member_password);
        }
        $Member->save();

        return redirect()->route('admin.users.index')->with('success', 'Member updated successfully');
    }

    // ฟังก์ชันลบข้อมูลผู้ใช้
    public function destroy($id)
    {
        $Member = Member::findOrFail($id);
        $Member->delete();

        return redirect()->route('admin.users.index')->with('success', 'Member deleted successfully');
    }
}
