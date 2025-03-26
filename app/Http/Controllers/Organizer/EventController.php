<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลกิจกรรมที่หมดอายุ
        $expiredActivities = Activity::where('event_date', '<', Carbon::today())->get();

        return view('organizer.activities.index', compact('expiredActivities'));
    }
    public function create()
    {
        $packages = Package::all(); // ดึงข้อมูลแพ็กเกจทั้งหมด
        return view('organizer.activities.create', compact('packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'category' => 'required|string',
            'competition_types' => 'required|array',
            'location' => 'required|string',
            'registration_start' => 'required|date',
            'registration_end' => 'required|date',
            'souvenirs' => 'nullable|array',
            'shirt_image' => 'nullable|image',
        ]);

        $activity = Activity::create($validated);

        // เพิ่ม Competition Types
        foreach ($request->competition_types as $competition) {
            $activity->competitionTypes()->create($competition);
        }

        return redirect()->route('organizer.activities.index')
            ->with('success', 'กิจกรรมถูกสร้างเรียบร้อยแล้ว');
    }
}
