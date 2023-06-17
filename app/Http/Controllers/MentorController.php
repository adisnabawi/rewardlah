<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PgSql\Lob;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = User::where('level', 2)
            ->where('company_id', auth()->user()->company_id)
            ->orderBy('points', 'desc')
            ->limit(8)
            ->get();

        return view('mentor', compact('mentors'));
    }

    public function book(Request $request)
    {
        $request->validate([
            'mentor_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'points' => 'required|numeric'
        ]);

        $mentor = User::find($request->mentor_id);
        if (auth()->user()->points < $request->points) {
            return redirect()->back()->with('error', 'You don\'t not have enough points');
        }

        if ($mentor->company_id != auth()->user()->company_id) {
            return redirect()->back()->with('error', 'You can\'t book a mentor from another company');
        }

        $existBooking = Booking::where('mentor_id', $mentor->id)
            ->where('company_id', auth()->user()->company_id)
            ->where('start_date', '<=', Carbon::parse($request->start_date))
            ->where('end_date', '>=', Carbon::parse($request->start_date))
            ->where('start_date', '<=', Carbon::parse($request->end_date))
            ->where('end_date', '<=', Carbon::parse($request->end_date))
            ->first();
        if ($existBooking) {
            return redirect()->back()->with('error', 'Mentor is not available for the selected date');
        }

        try {
            $book = new Booking();
            $book->company_id = auth()->user()->company_id;
            $book->mentor_id = $mentor->id;
            $book->user_id = auth()->user()->id;
            $book->start_date = $request->start_date;
            $book->end_date = $request->end_date;
            $book->points = $request->points;
            $book->remarks = $request->remarks;
            $book->save();

            return redirect()->back()->with('success', 'Booking successful');
        } catch (\Throwable $th) {
            Log::error('Booking error: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function list()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('booking', compact('bookings'));
    }
}
