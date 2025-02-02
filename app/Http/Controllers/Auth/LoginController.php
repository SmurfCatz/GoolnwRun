<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request){
        $input = $request->all();
    
        $this->validate($request, [
            'member_email' => 'required|email',
            'member_password' => 'required',
        ]);
    
        // ตรวจสอบข้อมูลผู้ใช้
        $Member = Member::where('member_email', $input['member_email'])->first();
    
        if ($Member && Hash::check($input['member_password'], $Member->member_password)) {
            auth()->login($Member);
    
            if ($Member->role == 'admin') {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
    }
}

