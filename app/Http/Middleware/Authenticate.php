<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // ตรวจสอบว่าเป็น Request ของ Organizer หรือไม่
        if ($request->is('organizer/*')) {
        return route('auth.organizer_login'); // Redirect ไปยังหน้า Organizer Login
    }

    return $request->expectsJson() ? null : route('login'); // ค่าเริ่มต้นสำหรับผู้ใช้ทั่วไป
    }

    protected function authenticate($request, array $guards)
{
    \Log::info('Guards being checked: ' . implode(', ', $guards));

    if (in_array('organizer', $guards) && Auth::guard('organizer')->check()) {
        \Log::info('Authenticated as organizer');
        return Auth::shouldUse('organizer');
    }

    \Log::info('Using default authentication');
    parent::authenticate($request, $guards);
}
}
