<?php

namespace App\Http\Controllers\Organizer;

use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class OrganizerProfileController extends Controller
{
    // แสดงโปรไฟล์ของ Organizer
    public function showProfile($id)
    {
        // ค้นหา Organizer และแสดงข้อมูล
        $Organizer = Organizer::findOrFail($id);
        return view('organizer.profile.show', compact('Organizer'));
    }

    // แสดงหน้าแก้ไขโปรไฟล์
    public function edit()
    {
        $Organizer = Auth::user(); // ดึงข้อมูล Organizer ปัจจุบัน
        return view('organizer.profile.edit', compact('Organizer'));
    }

    // อัปเดตข้อมูลโปรไฟล์
    public function update(Request $request)
    {
        $Organizer = Auth::user(); // ดึงข้อมูล Organizer ปัจจุบัน

    if (!$Organizer) {
        return redirect()->route('auth.organizer_login')->with('error', 'กรุณาล็อกอินเพื่อดำเนินการต่อ');
    }

    $request->validate([
        'organizer_name' => 'required|string|max:255',
        'organizer_email' => 'required|email|max:255|unique:organizers,organizer_email,' . $Organizer->id,
        'organizer_tel' => 'nullable|string|max:15',
        'organizer_details' => 'nullable|string|max:500',
        'organizer_idcard' => 'nullable|string|max:20',
        'organizer_experience' => 'nullable|string|max:500',
        'organizer_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

        // อัปโหลดรูปภาพใหม่
        if ($request->hasFile('organizer_image')) {
            if ($Organizer->organizer_image) {
                Storage::delete('public/' . $Organizer->organizer_image); // ลบรูปเก่า
            }

            $imagePath = $request->file('organizer_image')->store('organizers', 'public');
            $Organizer->organizer_image = $imagePath;
        }

        // อัปเดตข้อมูลโปรไฟล์
        $Organizer->update([
            'organizer_name' => $request->organizer_name,
            'organizer_email' => $request->organizer_email,
            'organizer_tel' => $request->organizer_tel,
            'organizer_details' => $request->organizer_details,
            'organizer_idcard' => $request->organizer_idcard,
            'organizer_experience' => $request->organizer_experience,
        ]);

        return redirect()->back()->with('success', 'อัปเดตโปรไฟล์สำเร็จ!');
    }
}
