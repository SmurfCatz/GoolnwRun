<?php

namespace App\Http\Controllers\Organizer;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Event;
use App\Models\RaceCategory;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    // ขั้นตอนที่ 1: เลือกแพ็กเกจ
    public function index()
    {
        // ดึงข้อมูลกิจกรรมทั้งหมดจากฐานข้อมูล
        $allEvents = Event::all();

        // ส่งข้อมูลไปที่ view
        return view('organizer.events.index', compact('allEvents'));
    }

    // ขั้นตอนที่ 2: สร้างกิจกรรมใหม่ (เลือกแพ็กเกจ)
    public function create()
    {
        // ดึงข้อมูลแพ็กเกจทั้งหมดจากฐานข้อมูล
        $packages = Package::all(); // หรือใช้ Package::where(...)->get() ถ้าต้องการกรองข้อมูล

        return view('organizer.events.create', compact('packages')); // ส่งข้อมูลแพ็กเกจไปที่ View
    }

    // ขั้นตอนที่ 3: กรอกข้อมูลกิจกรรมหลัก (ขั้นตอนที่ 2)
    public function stepTwo(Request $request)
    {
        // ตรวจสอบว่าได้เลือกแพ็กเกจหรือไม่
        if (!$request->has('package_id')) {
            return redirect()->route('organizer.events.create')->withErrors(['package_id' => 'กรุณาเลือกแพ็กเกจก่อน']);
        }

        // เก็บข้อมูลใน session เพื่อใช้งานในขั้นตอนถัดไป
        $request->session()->put('package_id', $request->package_id);

        // ตรวจสอบค่า package_id ใน session
        dd($request->session()->get('package_id'));  // ดูค่าของ package_id ใน session

        // แสดงฟอร์มกรอกข้อมูลกิจกรรม
        return view('organizer.events.step-two');
    }

    // ขั้นตอนที่ 4: กรอกประเภทการแข่งขันและรายละเอียด (ขั้นตอนที่ 3)
    public function store(Request $request)
{
    // ตรวจสอบค่าใน session และแสดงผลการ debug
    $packageId = $request->session()->get('package_id');
    $eventName = $request->session()->get('event_name');
    $eventDate = $request->session()->get('event_date');
    $category = $request->session()->get('category');
    $location = $request->session()->get('location');
    $registrationStart = $request->session()->get('registration_start');
    $registrationEnd = $request->session()->get('registration_end');
    $details = $request->session()->get('details');

    // Debug: แสดงค่าที่ได้จาก session
    \Log::info('Package ID: ' . $packageId);
    \Log::info('Event Name: ' . $eventName);
    \Log::info('Event Date: ' . $eventDate);
    \Log::info('Category: ' . $category);
    \Log::info('Location: ' . $location);
    \Log::info('Registration Start: ' . $registrationStart);
    \Log::info('Registration End: ' . $registrationEnd);
    \Log::info('Details: ' . $details);

    // ตรวจสอบค่าที่จำเป็น
    if (!$eventName || !$packageId || !$eventDate || !$category || !$location || !$registrationStart || !$registrationEnd) {
        return redirect()->back()->withErrors(['error' => 'ข้อมูลบางอย่างขาดหายไป กรุณาตรวจสอบอีกครั้ง']);
    }

    // ตรวจสอบข้อมูลที่กรอกมา
    $validated = $request->validate([
        'competition_types' => 'required|array',
        'competition_types.*.name' => 'required|string',
        'competition_types.*.distance' => 'required|string',
        'competition_types.*.fee' => 'required|numeric',
        'event_date' => 'required|date',
        'category' => 'required|string',
        'location' => 'required|string',
        'registration_start' => 'required|date',
        'registration_end' => 'required|date',
        'shirt_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'medal_images' => 'nullable|array',
        'medal_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'details' => 'nullable|string',
    ]);

    // สร้างกิจกรรมใหม่
    $event = Event::create([
        'package_id' => $packageId,
        'name' => $eventName,
        'event_date' => $eventDate,
        'category' => $category,
        'location' => $location,
        'registration_start' => $registrationStart,
        'registration_end' => $registrationEnd,
        'medal_images' => $request->file('medal_images'),
        'shirt_image' => $request->file('shirt_image'),
        'details' => $details,
        'organizer_id' => auth()->user()->id
    ]);

    // บันทึกประเภทการแข่งขัน
    foreach ($request->competition_types as $type) {
        RaceCategory::create([
            'event_id' => $event->id,
            'name' => $type['name'],
            'distance' => $type['distance'],
            'price' => $type['fee'],
        ]);
    }

    // ล้างข้อมูล session หลังจากบันทึกเสร็จ
    $request->session()->flush();

    // แสดงผลการบันทึก
    return redirect()->route('organizer.events.index')
        ->with('success', 'กิจกรรมถูกสร้างเรียบร้อยแล้ว');
}

public function setPackage(Request $request)
{
    // ตรวจสอบค่าที่ส่งมา
    $request->validate([
        'package_id' => 'required|integer|exists:packages,id', // ตรวจสอบว่า package_id ถูกต้อง
    ]);

    // ตั้งค่า package_id ใน session
    $request->session()->put('package_id', $request->package_id);

    // ส่งข้อความตอบกลับ
    return response()->json(['message' => 'Package ID has been set in session']);
}

}
