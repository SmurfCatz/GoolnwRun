<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'address_house_number' => 'required|string|max:255',
            'address_village' => 'nullable|string|max:255',
            'address_alley' => 'nullable|string|max:255',
            'address_road' => 'nullable|string|max:255',
            'address_subdistrict' => 'required|string|max:255',
            'address_district' => 'required|string|max:255',
            'address_province' => 'required|string|max:255',
            'address_postal_code' => 'required|string|max:10',
        ]);

        $address = new Address();
        $address->member_id = Auth::id(); // ถ้ามีระบบ Auth
        $address->address_house_number = $request->address_house_number;
        $address->address_village = $request->address_village;
        $address->address_alley = $request->address_alley;
        $address->address_road = $request->address_road;
        $address->address_subdistrict = $request->address_subdistrict;
        $address->address_district = $request->address_district;
        $address->address_province = $request->address_province;
        $address->address_postal_code = $request->address_postal_code;
        $address->save();

        return redirect()->back()->with('success', 'เพิ่มที่อยู่สำเร็จ!');
    }

    // อัปเดตที่อยู่
    public function updateAddress(Request $request, $id)
    {
        $Member = Auth::user();

        // ตรวจสอบข้อมูลที่กรอก
        $request->validate([
            'address_house_number' => 'required|string|max:255',
            'address_village' => 'nullable|string|max:255',
            'address_alley' => 'nullable|string|max:255',
            'address_road' => 'nullable|string|max:255',
            'address_subdistrict' => 'required|string|max:255',
            'address_district' => 'required|string|max:255',
            'address_province' => 'required|string|max:255',
            'address_postal_code' => 'required|string|max:10',
        ]);

        // ค้นหาที่อยู่ที่ต้องการอัปเดต
        $address = Address::findOrFail($id);

        // ตรวจสอบว่าเป็นที่อยู่ของผู้ใช้ที่เข้าสู่ระบบหรือไม่
        if ($address->member_id !== $Member->id) {
            return redirect()->route('profile.edit')->with('error', 'คุณไม่มีสิทธิ์ในการอัปเดตที่อยู่');
        }

        // อัปเดตที่อยู่
        $address->address_house_number = $request->address_house_number;
        $address->address_village = $request->address_village;
        $address->address_alley = $request->address_alley;
        $address->address_road = $request->address_road;
        $address->address_subdistrict = $request->address_subdistrict;
        $address->address_district = $request->address_district;
        $address->address_province = $request->address_province;
        $address->address_postal_code = $request->address_postal_code;

        // บันทึกการอัปเดต
        try {
            $address->save();
            return redirect()->route('profile.edit')->with('success', 'ที่อยู่ของคุณได้รับการอัปเดตสำเร็จ');
        } catch (\Exception $e) {
            return redirect()->route('profile.edit')->with('error', 'เกิดข้อผิดพลาดในการอัปเดตที่อยู่');
        }
    }

    // ลบที่อยู่
    public function deleteAddress($id)
{
    $address = Address::findOrFail($id); // ค้นหาที่อยู่ตาม ID
    $address->delete(); // ลบที่อยู่

    return redirect()->back()->with('success', 'ที่อยู่ถูกลบเรียบร้อยแล้ว');
}

}
