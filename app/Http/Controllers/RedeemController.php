<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Redeem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RedeemController extends Controller
{
    public function index()
    {
        $redeems = Redeem::with('product')
            ->where('company_id', auth()->user()->company_id)
            ->where('user_id', auth()->user()->id)
            ->get();
        $productPurchases = Purchase::with('product')
            ->where('company_id', auth()->user()->company_id)
            ->where('quantity', '>', 0)
            ->get();
        return view('redeem', compact('productPurchases', 'redeems'));
    }

    public function redeem(Request $request)
    {
        $request->validate([
            'purchase_id' => 'required',
        ]);

        try {
            DB::beginTransaction();
            $purchase = Purchase::where('id', $request->purchase_id)
                ->where('company_id', auth()->user()->company_id)
                ->first();
            if (!$purchase) {
                return redirect()->back()->with('error', 'Invalid purchase');
            }

            if ($purchase->quantity <= 0) {
                return redirect()->back()->with('error', 'Product is out of stock');
            }

            if (auth()->user()->points < $purchase->product->redeem_points) {
                return redirect()->back()->with('error', 'Insufficient points');
            }

            $purchase->quantity = $purchase->quantity - 1;
            $purchase->save();

            $user = User::where('id', auth()->user()->id)
                ->where('company_id', auth()->user()->company_id)
                ->first();
            $user->points = $user->points - ($purchase->product->redeem_points);
            $user->save();

            $redeem = new Redeem();
            $redeem->product_id = $purchase->product_id;
            $redeem->user_id = auth()->user()->id;
            $redeem->company_id = auth()->user()->company_id;
            $redeem->points = $purchase->product->redeem_points;
            $redeem->save();

            DB::commit();
            return redirect()->back()->with('success', 'Product redeemed');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Redeem error: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
