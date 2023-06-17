@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Booking List</h3>
                <div class="row mt-4">
                    <div class="col-md-12 text-end">
                        <a href="{{ route('dashboard.mentor') }}" class="btn btn-primary">Go Back</a>
                    </div>
                    @include('layouts.message')

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Mentor Name</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Points</th>
                            </tr>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>
                                <img src="{{ 'https://ui-avatars.com/api/?background=random&rounded=true&name=' . $booking->mentor->name }}" alt="" style="height:40px">
                                    {{ $booking->mentor->name }}
                                </td>
                                <td>
                                    {{
                                        Carbon\carbon::parse($booking->start_date)->format('d M, Y h:i A') .
                                        ' - ' .  Carbon\carbon::parse($booking->end_date)->format('d M, Y h:i A')
                                    }}
                                </td>
                                <td> {{ Str::title($booking->status)  }}</td>
                                <td> {{ $booking->points }}</td>
                            </tr>
                            @endforeach
                        </table>
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection