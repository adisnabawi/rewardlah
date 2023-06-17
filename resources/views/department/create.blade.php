@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>Create New Department</h3>
                @include('layouts.message')
                <div class="row">
                    <div class="col-md-6 mt-4">
                        <form action="{{ route('dashboard.department.store') }}" method="post" class="form">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">color</label>
                                <input type="color" class="form-control form-control-color" id="exampleColorInput" name="color" value="#563d7c" title="Choose your color">
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