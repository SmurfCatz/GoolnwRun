<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\SubEvent; // Import SubEvent Model
use Illuminate\Http\Request;
use App\Models\Package; // Import Package Model

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('subEvents')->get(); // Include Sub Events
        return view('admin.events.index', compact('events'));
    }

    public function createStep1()
    {
        $packages = Package::all(); // ดึงข้อมูลแพ็กเกจทั้งหมด
        return view('admin.events.create-step1', compact('packages'));
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'package' => 'required|exists:packages,id',
        ]);

        // เก็บข้อมูลแพ็กเกจใน Session
        $request->session()->put('package', $request->package);

        return redirect()->route('admin.events.create.step2');
    }

    public function createStep2(Request $request)
    {
        // ตรวจสอบว่ามีการเลือกแพ็กเกจในขั้นตอนที่ 1
        if (!$request->session()->has('package')) {
            return redirect()->route('admin.events.create.step1');
        }

        $package = Package::find($request->session()->get('package'));
        return view('admin.events.create-step2', compact('package'));
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
            'registration_start' => 'required|date|before_or_equal:registration_end',
            'registration_end' => 'required|date|after_or_equal:registration_start',
            'sub_events' => 'required|array',
            'sub_events.*.sub_event_name' => 'required|string|max:255',
            'sub_events.*.sub_event_distance' => 'required|numeric|min:0.1',
            'sub_events.*.registration_fee' => 'required|numeric|min:0',
        ]);

        // ดึงข้อมูลแพ็กเกจจาก Session
        $packageId = $request->session()->get('package');

        // สร้าง Event
        $event = Event::create([
            'package_id' => $packageId,
            'event_name' => $request->event_name,
            'event_date' => $request->event_date,
            'registration_open_date' => $request->registration_start,
            'registration_close_date' => $request->registration_end,
        ]);

        // สร้าง Sub Events
        foreach ($request->sub_events as $subEvent) {
            $event->subEvents()->create($subEvent);
        }

        // ล้างข้อมูล Session
        $request->session()->forget('package');

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function create()
    {
        $packages = Package::all(); // ดึงข้อมูลแพ็กเกจทั้งหมด
        return view('admin.events.create', compact('packages'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'event_name' => 'required',
            'event_date' => 'required|date',
            'event_category' => 'required',
            'registration_open_date' => 'required|date',
            'registration_close_date' => 'required|date',
            // Removed 'event_status' from validation
        ]);

        // Calculate event_status
        $event_status = now()->between($request->registration_open_date, $request->registration_close_date) ? 'active' : 'inactive';

        // Store the new event
        $event = Event::create(array_merge($request->except('sub_events'), ['event_status' => $event_status]));

        // Add Sub Events
        foreach ($request->input('sub_events', []) as $subEventData) {
            $event->subEvents()->create($subEventData);
        }

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }

    public function edit($id)
    {
        $event = Event::with('subEvents')->findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'event_name' => 'required',
            'event_date' => 'required|date',
            'event_category' => 'required',
            'registration_open_date' => 'required|date',
            'registration_close_date' => 'required|date',
            // Removed 'event_status' from validation
        ]);

        $event = Event::findOrFail($id);

        // Calculate event_status
        $event_status = now()->between($request->registration_open_date, $request->registration_close_date) ? 'active' : 'inactive';

        // Update the event
        $event->update(array_merge($request->except('sub_events'), ['event_status' => $event_status]));

        // Update Sub Events
        $event->subEvents()->delete(); // Clear existing sub-events
        foreach ($request->input('sub_events', []) as $subEventData) {
            $event->subEvents()->create($subEventData);
        }

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->subEvents()->delete(); // Delete related sub-events
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
