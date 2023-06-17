<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PointsController extends Controller
{

    public function send(Request $request)
    {
        $data = $request->validate([
            'points' => 'required|numeric',
            'employee_id' => 'required|exists:users,id',
            'remarks' => 'nullable|max:150'
        ]);

        try {
            DB::beginTransaction();
            $employee = User::find($data['employee_id']);
            $employee->points += $data['points'];
            $employee->save();

            $user = User::find(auth()->user()->id);
            $user->wallet_points -= $data['points'];
            $user->save();

            $transaction = new Transaction();
            $transaction->sent = $data['points'];
            $transaction->received = 0;
            $transaction->sender_id = $user->id;
            $transaction->receiver_id = $employee->id;
            $transaction->remarks = $data['remarks'];
            $transaction->company_id = auth()->user()->company_id;
            $transaction->save();
            
            DB::commit();

            return redirect()->back()->with('success', 'Points sent successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Send points error: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
        
    }
}
