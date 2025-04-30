<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Package;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['subEvents', 'package'])->get();
        return view('admin.events.index', compact('events'));
    }

    public function createStep1()
    {
        $packages = Package::all();
        return view('admin.events.create-step1', compact('packages'));
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'package' => 'required|exists:packages,id',
        ]);

        $request->session()->put('package', $request->package);

        return redirect()->route('admin.events.create.step2');
    }

    public function createStep2(Request $request)
    {
        if (!$request->session()->has('package')) {
            return redirect()->route('admin.events.create.step1')->with('error', 'Please select a package first.');
        }

        $packageId = $request->session()->get('package');
        $package = Package::findOrFail($packageId);

        return view('admin.events.create-step2', compact('package'));
    }

    public function storeStep2(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'event_category' => 'required|string|in:Race,Virtual Run',
            'event_location' => 'required|string|max:255',
            'event_province' => 'required|string|max:255',
            'event_date' => 'required|date',
            'registration_start' => 'required|date|before_or_equal:registration_end',
            'registration_end' => 'required|date|after_or_equal:registration_start',
            'sub_events' => 'required|array',
            'sub_events.*.sub_event_name' => 'required|string|max:255',
            'sub_events.*.sub_event_distance' => 'required|numeric|min:0.1',
            'sub_events.*.registration_fee' => 'required|numeric|min:0',
        ]);

        $packageId = $request->session()->get('package');

        $event = Event::create([
            'package_id' => $packageId,
            'event_name' => $request->event_name,
            'event_category' => $request->event_category,
            'event_location' => $request->event_location,
            'event_province' => $request->event_province,
            'event_date' => $request->event_date,
            'registration_open_date' => $request->registration_start,
            'registration_close_date' => $request->registration_end,
            'event_status' => 'upcoming',
        ]);

        foreach ($request->sub_events as $subEvent) {
            $event->subEvents()->create($subEvent);
        }

        $request->session()->forget('package');

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully.');
    }
    public function edit($id)
    {
        $event = Event::with('subEvents')->findOrFail($id);
        $packages = Package::all();
        return view('admin.events.edit', compact('event', 'packages'));
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }
}
