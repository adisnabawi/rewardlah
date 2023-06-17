@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <h3>Reward & Redeem</h3>
        <small>Purchase your reward products</small>
        @include('layouts.message')
    </div>
    <div class="col-md-12 text-end mb-4">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#redeemModal">Redeemed History</button>
    </div>
    <div class="modal fade" id="redeemModal" tabindex="-1" aria-labelledby="redeemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="redeemModalLabel">Redeem History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Points</th>
                                <th>Date</th>
                            </tr>
                            @if (count($redeems) == 0)
                            <tr>
                                <td colspan="3" class="text-center">No Redeem History</td>
                            </tr>
                            @endif
                            @foreach ($redeems as $redeem)
                            <tr>
                                <td>
                                    <img src="{{ $redeem->product->image }}" style="height:30px; width:30px; border-radius: 50%; object-fit:cover;">
                                    {{ Str::limit($redeem->product->name, 10) }}
                                </td>
                                <td>{{ $redeem->points }}</td>
                                <td>{{ \Carbon\carbon::parse($redeem->created_at)->format('d, M Y h:i:s A') }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @foreach ($productPurchases as $purchase)
    <div class="col-md-4">
        <div class="card">
            <img src="{{ $purchase->product->image }}" style="height: 200px; object-fit:contain" class="card-img-top" alt="...">
            <div class="card-body">
                <p style="height:40px">{{ Str::limit($purchase->product->name, 60) }}</p>
                <h5 class="mt-2 mb-4 text-info"><i data-feather="award"></i> {{ number_format($purchase->product->redeem_points) }} Points</h5>
                <div class="d-grid">
                    <form action="{{ route('dashboard.redeem.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="purchase_id" value="{{ $purchase->id }}">
                        <button class="w-100 btn btn-primary" type="submit" onclick="return confirm('Are you sure?')" {{ auth()->user()->points < $purchase->product->redeem_points ? 'disabled': '' }}>Redeem Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection