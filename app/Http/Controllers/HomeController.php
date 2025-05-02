<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Organizer;
use App\Models\Event;
use App\Models\Package;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function adminHome()
    {
        return view('admin.adminhome', [
            'totalMembers' => Member::count(),
            'totalOrganizers' => Organizer::count(),
            'totalEvents' => Event::count(),
            'totalPackages' => Package::count(),
            'recentMembers' => Member::latest()->take(5)->get(),
            'recentEvents' => Event::latest()->take(5)->get(),
        ]);
    }

    public function organizerHome()
    {
        return view('organizer.Organizerhome');
    }
}
