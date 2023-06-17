@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('layouts.message')
                <h3>Employees</h3>
                <div class="row">
                    <div class="col-md-12 text-end mt-2">
                        <a href="{{ route('dashboard.employee.create') }}" class="btn btn-info">
                            <i data-feather="user-plus"></i> Create New Employee</a>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th>Email</th>
                                        <th scope="col">Points</th>
                                        <th scope="col">Department</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)
                                    <tr>
                                        <td>
                                            <img src="{{ 'https://ui-avatars.com/api/?background=random&rounded=true&name=' . $employee->name }}" alt="{{ $employee->name }}" style="height:40px">
                                            {{ $employee->name }}
                                        </td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->points }}</td>
                                        <td style="color: {{ $employee->department->color }}">{{ $employee->department->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $employees->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection