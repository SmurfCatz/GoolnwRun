<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Package;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        // ดึงข้อมูลกิจกรรมทั้งหมด
        $allEvents = Event::all();

        return view('organizer.events.index', compact('allEvents'));
    }

    public function create()
    {
        $packages = Package::all();
        return view('organizer.events.create', compact('packages'));
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

        $event = Event::create($validated);

        // เพิ่มประเภทการแข่งขัน
        foreach ($request->competition_types as $competition) {
            $event->competitionTypes()->create(['name' => $competition]);
        }

        return redirect()->route('organizer.events.index')
            ->with('success', 'กิจกรรมถูกสร้างเรียบร้อยแล้ว');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $packages = Package::all();
        return view('organizer.events.edit', compact('event', 'packages'));
    }

    public function update(Request $request, $id)
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

        $event = Event::findOrFail($id);
        $event->update($validated);

        // อัปเดตประเภทการแข่งขัน
        $event->competitionTypes()->delete();
        foreach ($request->competition_types as $competition) {
            $event->competitionTypes()->create(['name' => $competition]);
        }        

        return redirect()->route('organizer.events.index')
            ->with('success', 'กิจกรรมถูกแก้ไขเรียบร้อยแล้ว');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('organizer.events.show', compact('event'));
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('organizer.events.index')
            ->with('success', 'กิจกรรมถูกลบเรียบร้อยแล้ว');
    }
}
