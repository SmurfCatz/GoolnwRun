<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organizer;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // ใช้ middleware เพื่อให้เฉพาะ admin เข้าถึง
    }

    // ฟังก์ชันแสดงรายชื่อ organizer ทั้งหมด
    public function index()
    {
        $organizers = Organizer::all(); // ดึงรายการทั้งหมดของ organizers
        return view('admin.organizers.index', compact('organizers')); // ส่งข้อมูลไปยัง view
    }
    public function pendingOrganizers()
    {
        $organizers = Organizer::where('is_approved', false)->get();
        return view('admin.organizers.pending', compact('organizers'));
    }


    // อนุมัติ Organizer
    public function approve($id)
    {
        $organizer = Organizer::find($id);
        if ($organizer) {
            $organizer->is_approved = true;
            $organizer->save();

            // รีเซ็ต session หลังการอนุมัติ
            session(['waiting_for_approval' => false]);

            return redirect()->route('admin.organizers.index')->with('success', 'บัญชีผู้ใช้ได้รับการอนุมัติแล้ว');
        }

        return redirect()->route('admin.organizers.index')->with('error', 'ไม่พบผู้ใช้นี้');
    }

    public function cancelApproval($id)
    {
        $organizer = Organizer::find($id);
        if ($organizer) {
            $organizer->is_approved = false;
            $organizer->save();

            return redirect()->route('admin.organizers.pending')->with('success', 'การอนุมัติถูกยกเลิกแล้ว');
        }

        return redirect()->route('admin.organizers.pending')->with('error', 'ไม่พบผู้ใช้นี้');
    }



    // ใน Controller ที่รับคำขอ check-approval
    public function checkApproval(Request $request)
    {


        $organizerEmail = session('organizer_email');

        if (!$organizerEmail) {
            return response()->json([
                'approved' => false,
                'message' => 'Session is missing or expired.',
            ], 401); // Unauthorized
        }

        $organizer = Organizer::where('organizer_email', $organizerEmail)->first();

        if (!$organizer) {
            return response()->json([
                'approved' => false,
                'message' => 'Organizer not found.',
            ], 404); // Not Found
        }


        return response()->json([
            'approved' => $organizer->is_approved,
            'message' => $organizer->is_approved ? 'Approved' : 'Pending approval',
        ]);
    }
    // ฟังก์ชันแสดงฟอร์มเพิ่ม organizer ใหม่
    public function create()
    {
        return view('admin.organizers.create'); // แสดงฟอร์มเพิ่ม organizer
    }

    // ฟังก์ชันบันทึก organizer ใหม่
    public function store(Request $request)
    {
        $request->validate([
            'organizer_name' => 'required|string|max:255',
            'organizer_email' => 'required|email|unique:organizers,organizer_email',
            'organizer_tel' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Organizer::create([
            'organizer_name' => $request->organizer_name,
            'organizer_email' => $request->organizer_email,
            'organizer_tel' => $request->organizer_tel,
            'is_approved' => $request->is_approved ?? false,
            'organizer_password' => bcrypt($request->password),
        ]);

        // ส่งข้อความ success หลังการสร้าง organizer
        return redirect()->route('admin.organizers.index')->with('success', 'Organizer created successfully');
    }

    // ฟังก์ชันแสดงข้อมูลของ organizer
    public function show($id)
    {
        $organizer = Organizer::findOrFail($id); // ดึงข้อมูล organizer ตาม ID
        return view('admin.organizers.show', compact('organizer')); // แสดงข้อมูล organizer
    }

    // ฟังก์ชันแสดงฟอร์มแก้ไขข้อมูล organizer
    public function edit($id)
    {
        $organizer = Organizer::findOrFail($id); // ดึงข้อมูล organizer ตาม ID
        return view('admin.organizers.edit', compact('organizer')); // แสดงฟอร์มแก้ไขข้อมูล
    }

    // ฟังก์ชันอัพเดตข้อมูล organizer
    public function update(Request $request, $id)
    {
        $request->validate([
            'organizer_name' => 'required|string|max:255',
            'organizer_email' => 'required|email|unique:organizers,organizer_email,' . $id,
            'organizer_tel' => 'required|string|max:255',
            'is_approved' => 'required|boolean',
            'organizer_password' => 'nullable|string|min:8|confirmed',
        ]);

        $organizer = Organizer::findOrFail($id);
        $organizer->organizer_name = $request->organizer_name;
        $organizer->organizer_email = $request->organizer_email;
        $organizer->organizer_tel = $request->organizer_tel;
        $organizer->is_approved = $request->is_approved;
        if ($request->organizer_password) {
            $organizer->organizer_password = bcrypt($request->organizer_password);
        }
        $organizer->save();

        return redirect()->route('admin.organizers.index')->with('success', 'Organizer updated successfully');
    }

    // ฟังก์ชันลบข้อมูล organizer
    public function destroy($id)
    {
        $organizer = Organizer::findOrFail($id);
        $organizer->delete();

        return redirect()->route('admin.organizers.index')->with('success', 'Organizer deleted successfully');
    }
}
