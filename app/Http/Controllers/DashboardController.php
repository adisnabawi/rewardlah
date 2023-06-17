<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $employees = User::where('company_id', auth()->user()->company_id)
            ->whereNotIn('id', [auth()->user()->id])
            ->orderBy('name')
            ->get();

        $transactions = Transaction::where('company_id', auth()->user()->company_id);
        if (isset($request->send) && $request->send == 1) {
            $transactions->where('sender_id', auth()->user()->id);
        } else {
            $transactions->where('receiver_id', auth()->user()->id);
        }

        $transactions = $transactions->orderBy('created_at', 'desc')
            ->paginate(10);

        $percentage = 0;
        $totalPointsToday = Transaction::where('company_id', auth()->user()->company_id)
            ->whereDate('created_at', date('Y-m-d'))
            ->where('receiver_id', auth()->user()->id)
            ->sum('points');
        if ($totalPointsToday > 0) {
            $percentage = ( $totalPointsToday / (auth()->user()->points - $totalPointsToday)) * 100;
            $percentage = round($percentage, 2);
        }

        return view('welcome', compact('employees', 'transactions', 'percentage'));
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
        return view('announcement.index');
    }

    public function announcementCreate()
    {
        return view('announcement.create');
    }
}
