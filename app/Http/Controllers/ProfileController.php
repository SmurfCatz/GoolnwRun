<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // แสดงโปรไฟล์ของผู้ใช้
    public function showProfile($id)
    {
        // ค้นหาผู้ใช้และโหลดข้อมูลที่อยู่ทั้งหมดของผู้ใช้
        $Member = Member::with('addresses')->findOrFail($id);
        return view('profile.show', compact('Member'));
    }

    // แสดงหน้าแก้ไขโปรไฟล์
    public function edit()
    {
        $Member = Auth::user();
        $Addresses = $Member->addresses;
        return view('profile.edit', compact('Member', 'Addresses'));
    }

    // อัปเดตข้อมูลโปรไฟล์
    // อัปเดตข้อมูลโปรไฟล์
    public function update(Request $request)
    {
        /** @var \App\Models\Member $Member */
        $Member = Auth::user();

        // กำหนด validation
        $request->validate([
            'member_name' => 'required|string|max:255',
            'member_email' => 'required|email|max:255|unique:members,member_email,' . $Member->id,
            'member_tel' => 'required|regex:/^[0-9]{9,10}$/|unique:members,member_tel,' . $Member->id,
            'member_gender' => 'nullable|string',
            'member_dob' => 'nullable|date',
            'member_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // อัปโหลดรูปภาพใหม่
        if ($request->hasFile('member_image')) {
            // ลบรูปเก่า (ถ้ามี)
            if ($Member->member_image) {
                Storage::delete('public/' . $Member->member_image); // ลบรูปเก่าที่เก็บไว้
            }

            // อัปโหลดไฟล์ใหม่
            $imagePath = $request->file('member_image')->store('profiles', 'public'); // เก็บใน directory 'profiles'
            $Member->member_image = $imagePath; // เก็บ path ของรูปภาพในฐานข้อมูล
        }

        // อัปเดตข้อมูลโปรไฟล์
        $Member->update([
            'member_name' => $request->member_name,
            'member_email' => $request->member_email,
            'member_tel' => $request->member_tel,
            'member_gender' => $request->member_gender,
            'member_dob' => $request->member_dob,
            
        ]);

        return redirect()->back()->with('success', 'อัปเดตโปรไฟล์สำเร็จ!');
    }

    public function removeImage(Request $request)
    {
        $Member = Member::findOrFail(auth()->id());

        // ลบรูปโปรไฟล์
        if ($Member->member_image && Storage::exists('public/' . $Member->member_image)) {
            Storage::delete('public/' . $Member->member_image); // ลบไฟล์จริงใน storage
        }

        $Member->member_image = null; // ล้างค่าจาก database
        $Member->save();

        return back()->with('success', 'ลบรูปภาพเรียบร้อยแล้ว');
    }
}
