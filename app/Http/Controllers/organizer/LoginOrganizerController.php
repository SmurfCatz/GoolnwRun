<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organizer;
use Illuminate\Support\Facades\Hash; // นำเข้า Hash
use Illuminate\Support\Facades\Auth; // นำเข้า Auth
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class loginOrganizerController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function loginOrganizer(Request $request)
    {
        $input = $request->all();

        // Validate input
        $this->validate($request, [
            'organizer_email' => 'required|email',
            'organizer_password' => 'required',
        ]);

        // Check organizer data
        $Organizer = Organizer::where('organizer_email', $input['organizer_email'])->first();

        if ($Organizer && Hash::check($input['organizer_password'], $Organizer->organizer_password)) {
            auth()->login($Organizer); // แก้เป็น auth() -> login()

            return redirect()->route('organizer.home'); // เปลี่ยนไปใช้ 'organizer.home'
        } else {
            return redirect()->route('organizer.login') // เปลี่ยนไปใช้ 'organizer.login'
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
    }

    public function showOrganizerLoginForm()
    {
        return view('organizer.login'); // แก้ไขให้ตรงกับชื่อ view ที่ใช้
    }
}
