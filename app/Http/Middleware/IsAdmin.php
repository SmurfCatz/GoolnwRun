<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
        $user = auth()->user();
        
        // ตรวจสอบว่าผู้ใช้เป็น admin หรือไม่
        if ($user && $user->member_role === 'admin') {
            return $next($request);
        }

        // ตรวจสอบกรณีที่ $user หรือ $user->member_role เป็น null
        if (!$user || !$user->member_role) {
            // จัดการกรณีที่ไม่มีผู้ใช้หรือลักษณะของสมาชิกไม่ถูกต้อง
            return redirect()->route('login')->with('error', 'You must be logged in');
        }

        // ถ้าไม่ได้เป็น admin
        return redirect()->route('home')->with('error', "You don't have admin access");
    }
}

