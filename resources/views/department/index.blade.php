@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('layouts.message')
                <h3>Department</h3>
                <div class="row">
                    <div class="col-md-12 text-end mt-2">
                        <a href="{{ route('dashboard.department.create') }}" class="btn btn-info">
                            <i data-feather="inbox"></i> Create New Department</a>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Total Points</th>
                                        <th scope="col">Total Employee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departments as $department)
                                    <tr>
                                        <td style="color: {{ $department->color }}">
                                           {{ $department->name }}
                                        </td>
                                        <td><i data-feather="award"></i> {{ $department->totalPoints }}</td>
                                        <td>{{ $department->totalEmployees }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $departments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection