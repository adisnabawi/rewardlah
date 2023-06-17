<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $announcements = [];
        return view('welcome', compact('announcements'));
    }

    public function leaderboard()
    {
        $tops = User::with('department')->where('company_id', auth()->user()->company_id)
            ->where('level', 2)
            ->orderBy('points', 'desc')
            ->limit(3)
            ->get();
        $employees = User::where('level', 2)->where('company_id', auth()->user()->company_id)
            ->whereNotIn('id', $tops->pluck('id'))
            ->orderBy('points', 'desc')
            ->limit(7)
            ->get();
        $tops = $tops->toArray();
        return view('leaderboard', compact('tops', 'employees'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function announcement()
    {
        return view('announcement');
    }

    public function announcementCreate()
    {
        return view('announcement.create');
    }
}
