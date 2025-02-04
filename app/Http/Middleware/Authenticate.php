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
        return $request->expectsJson() ? null : route('login');
    }

    protected function authenticate($request, array $guards)
    {
        // ตรวจสอบว่าเป็น Guard 'organizer' หรือไม่
        if (in_array('organizer', $guards) && Auth::guard('organizer')->check()) {
            // ตั้ง Guard ที่ใช้งานในระบบเป็น 'organizer'
            return Auth::shouldUse('organizer');
        }

        // ใช้ Guard อื่น ๆ ที่กำหนดไว้
        parent::authenticate($request, $guards);
    }
}
