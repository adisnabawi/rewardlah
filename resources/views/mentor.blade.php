@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Mentoring by Top Performer</h3>
                <div class="row mt-4">
                <div class="col-md-12 text-end mb-4">
                    <a href="{{ route('dashboard.mentor.book.list') }}" class="btn btn-info"> <i data-feather="user-check"></i> My Booking</a>
                </div>
                    @include('layouts.message')
                    @foreach ($mentors as $mentor)
                    <div class="col-md-3">
                        <div class="card" style="box-shadow: 2px 2px 4px 2px #c7c7c7bd;">
                            <div class="card-header text-center">
                                <img src="{{ 'https://ui-avatars.com/api/?background=random&rounded=true&name=' . $mentor->name }}" alt="">
                            </div>
                            <div class="card-body text-center">
                                <h5>{{ $mentor->name }}</h5>
                                <p>Department {{ $mentor->department->name }}</p>
                                <button class="btn btn-primary mt-2" onclick="book({{ $mentor->id }}, '{{ $mentor->name }}')" data-bs-toggle="modal" data-bs-target="#bookModal">Book a Session</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookModalLabel">Book a Session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('dashboard.mentor.book') }}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="mentor_id" id="mentor_id">
                        <div class="form-group mt-4">
                            <label for="">Name</label>
                            <input type="text" name="mentor_name" id="mentor_name" class="form-control" disabled>
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Start Date</label>
                            <input type="datetime-local" name="start_date" class="form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label for="">End Date</label>
                            <input type="datetime-local" name="end_date" class="form-control">
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Points</label>
                            <small>Points will be deducted from your wallet points once session accepted and finish</small>
                            <input type="number" name="points" class="form-control" placeholder="Enter points" value="10">
                        </div>
                        <div class="form-group mt-4">
                            <label for="">Remarks</label>
                            <textarea name="remarks" class="form-control" placeholder="Enter remarks"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function book(id, name) {
        $('#mentor_id').val(id);
        $('#mentor_name').val(name);
        $('#bookModal').modal('show');
    }
</script>
@endpush