@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Dashboard</h3>
                @include('layouts.message')
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="box-shadow: 2px 2px 4px 2px #c7c7c7bd;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 text-center" style="margin: 0 auto;">
                                                <img src="{{ 'https://ui-avatars.com/api/?background=random&rounded=true&name=' . auth()->user()->name }}" alt="">
                                            </div>
                                            <div class="col-7">
                                                <h4>{{ number_format(auth()->user()->points) }}
                                                    <small style="color:#6dca6d">+5%</small>
                                                </h4>
                                                <p><small>Points Accumulated</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card" style="box-shadow: 2px 2px 4px 2px #c7c7c7bd;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5 text-center" style="margin: 0 auto;">
                                                <i data-feather="repeat" style="font-size: 70px; margin-top: 15px"></i>
                                            </div>
                                            <div class="col-7">
                                                <h4>{{ number_format(auth()->user()->wallet_points) }}</h4>
                                                <p><small>Points you can sent</small></p>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#sendPointModal">Send Point</button>
                                                <div class="modal fade" id="sendPointModal" tabindex="-1" aria-labelledby="sendPointLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Reward MyBuddy</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('dashboard.points.send') }}" method="post" id="sendPointBuddy">
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    <div class="form-group mt-4">
                                                                        <label for="">Select Employee</label>
                                                                        <select name="employee_id" class="form-select selectpicker">
                                                                            @foreach($employees as $employee)
                                                                            <option value="{{ $employee->id }}" data-thumbnail="{{ 'https://ui-avatars.com/api/?background=random&rounded=true&name=' . auth()->user()->name }}">{{ $employee->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group mt-4">
                                                                        <label for="">Points Transfer</label>
                                                                        <input type="number" name="points" class="form-control" max="100" min="1" step="1" placeholder="Enter points" required>
                                                                    </div>
                                                                    <div class="form-group mt-4">
                                                                        <label for="">Remarks</label>
                                                                        <input type="text" name="remarks" class="form-control" placeholder="Enter remarks">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Send Points</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h4>Latest Points Transactions</h4>
                        <div class="row mb-4">
                            <div class="col-md-8"></div>
                            <div class="col-md-4">
                                <form action="" method="get" id="transactionType">
                                    <select name="send" id="" class="form-select">
                                        <option value="">Received</option>
                                        <option value="1" {{ request()->get('send') == 1 ? 'selected' : '' }}>Sent</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                        <table class="table table-hover">
                            <tr>
                                <th>Date</th>
                                <th>Points {{ request()->get('send') == 1 ? 'Send' : 'Received' }}</th>
                                <th>{{ request()->get('send') == 1 ? 'Send To' : 'Given By' }}</th>
                                <th>Remarks</th>
                            </tr>
                            @if($transactions->count() == 0)
                                <tr>
                                    <td colspan="4" class="text-center"> No Data</td>
                                </tr>
                            @endif
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('d M Y') }}</td>
                                <td>{{ request()->get('send') == 1 ? $transaction->sent : $transaction->received }}</td>
                                <td>{{ request()->get('send') == 1 ? $transaction->sender->name : $transaction->receiver->name }}</td>
                                <td>{{ $transaction->remarks ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </table>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const dropdown = document.getElementById("transactionType");
    dropdown.addEventListener("change", function() {
        document.getElementById("transactionType").submit();
    });
</script>

@endpush