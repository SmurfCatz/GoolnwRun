<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\SubEvent;

class SubEventController extends Controller
{
    public function index()
    {
        $subEvents = SubEvent::with('event')->get(); // ดึงข้อมูล Sub Events พร้อม Event ที่เกี่ยวข้อง
        return view('subEvents.index', compact('subEvents'));
    }

    public function create($eventId)
    {
        // ตรวจสอบว่า eventId ถูกส่งมา
        $event = Event::findOrFail($eventId);

        // ส่ง eventId ไปยัง view
        return view('admin.events.subEvents.create', compact('eventId'));
    }



    public function store(Request $request, $eventId)
    {
        // ตรวจสอบว่า eventId ถูกส่งเข้ามาหรือไม่
        $event = Event::findOrFail($eventId); // ค้นหากิจกรรมหลักโดยใช้ eventId

        // ตรวจสอบข้อมูลจากฟอร์ม
        $request->validate([
            'sub_event_name' => 'required|string|max:255',
            'sub_event_distance' => 'required|numeric',
            'registration_fee' => 'required|numeric',
        ]);

        // สร้างกิจกรรมย่อยภายใต้กิจกรรมหลัก
        $subEvent = new SubEvent();
        $subEvent->event_id = $eventId;
        $subEvent->sub_event_name = $request->sub_event_name;
        $subEvent->sub_event_distance = $request->sub_event_distance;
        $subEvent->registration_fee = $request->registration_fee;
        $subEvent->save();

        // Redirect ไปยังหน้ากิจกรรมย่อย
        return redirect()->route('admin.events.subEvents.index', ['eventId' => $eventId])->with('success', 'Sub Event created successfully');
    }



    public function edit($eventId, $subEventId)
    {
        $event = Event::findOrFail($eventId); // หาข้อมูลกิจกรรมหลัก
        $subEvent = SubEvent::findOrFail($subEventId); // หาข้อมูลกิจกรรมย่อย

        // ส่ง $eventId และ $subEvent ไปที่ view
        return view('admin.events.subEvents.edit', compact('event', 'subEvent', 'eventId'));
    }


    public function update(Request $request, SubEvent $subEvent)
    {
        $request->validate([
            'sub_event_name' => 'required|string|max:255',
            'sub_event_distance' => 'required|numeric',
            'registration_fee' => 'required|numeric',
        ]);

        $subEvent->update($request->all());

        return redirect()->route('admin.events.subEvents.index')->with('success', 'Sub Event updated successfully.');
    }

    public function destroy($eventId, $subEventId)
    {
        // หาข้อมูลกิจกรรมหลัก
        $event = Event::findOrFail($eventId);

        // หาข้อมูลกิจกรรมย่อย
        $subEvent = SubEvent::findOrFail($subEventId);

        // ลบกิจกรรมย่อย
        $subEvent->delete();

        return redirect()->route('admin.events.subEvents.index', ['eventId' => $eventId])->with('success', 'Sub Event deleted successfully');
    }
}
