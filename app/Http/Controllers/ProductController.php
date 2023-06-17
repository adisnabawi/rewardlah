<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')
            ->paginate(10);
        return view('product', compact('products'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1'
        ]);

        $product = Product::find($request->product_id);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        try {
            DB::beginTransaction();
            $purchase = Purchase::where('product_id', $product->id)
                ->where('user_id', auth()->user()->id)
                ->where('company_id', auth()->user()->company_id)
                ->first();
            if ($purchase) {
                $purchase->quantity += $request->quantity;
                $purchase->save();
            } else {
                $purchase = new Purchase;
                $purchase->product_id = $product->id;
                $purchase->user_id = auth()->user()->id;
                $purchase->company_id = auth()->user()->company_id;
                $purchase->quantity = $request->quantity;
                $purchase->save();
            }
            DB::commit();
            return redirect()->route('dashboard.product')->with('success', 'Product added successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Add product error: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
