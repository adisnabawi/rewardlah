@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Create New Employee</h3>
                @include('layouts.message')
                <div class="row">
                    <div class="col-md-6 mt-4">
                        <form action="{{ route('dashboard.employee.store') }}" method="post" class="form">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="department">Department</label>
                                <select name="department_id" class="form-select">
                                    @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection