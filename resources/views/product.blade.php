@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <h3>Products</h3>
        <small>Purchase your product here for reedem products</small>
        @include('layouts.message')
    </div>

    @foreach ($products as $product)
    <div class="col-md-4">
        <div class="card">
            <img src="{{ $product->image }}" style="height: 200px; object-fit:contain" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="text-end">
                    <span class="badge bg-info"><i data-feather="award"></i> {{ number_format($product->redeem_points) }}</span>
                </p>
                <h5 class="mt-4">RM {{ number_format($product->price, 2) }}</h5>
                <p class="card-text">
                    {{ Str::limit($product->description, 50) }}
                </p>
                <div class="d-grid gap-2">
                    <form action="{{ route('dashboard.product.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button class="w-100 btn btn-primary" type="submit">Buy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{ $products->links() }}
</div>
@endsection