@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>LeaderBoard</h3>
                <div class="row">
                    @if (count($tops) > 0)
                    <div class="col-md-3">
                        <div class="card mt-4" style="box-shadow: 2px 2px 4px 2px #c7c7c7bd;">
                            <div class="card-body">
                                <h4 class="card-title text-center">
                                    <img src="{{ url('img/silver.png') }}" alt="">
                                    {{ $tops[1]['points'] }} Points
                                </h4>
                                <p class="text-center">
                                    <img src="{{ 'https://ui-avatars.com/api/?background=random&rounded=true&name=' . $tops[1]['name'] }}" class="card-img-top" alt="{{ $tops[1]['name'] }}" style="height:100px">
                                </p>

                                <p class="card-text text-center">{{ $tops[1]['name'] }}</p>
                                <p class="text-center"><small>{{ $tops[1]['department']['name'] }} </small> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mt-4" style="box-shadow: 2px 2px 4px 2px #c7c7c7bd;">
                            <div class="card-body">
                                <h4 class="card-title text-center">
                                    <img src="{{ url('img/gold.png') }}" alt="">
                                    {{ $tops[0]['points'] }} Points
                                </h4>
                                <p class="text-center">
                                    <img src="{{ 'https://ui-avatars.com/api/?background=random&rounded=true&name=' . $tops[0]['name'] }}" class="card-img-top" alt="{{ $tops[0]['name'] }}" style="height:100px">
                                </p>

                                <p class="card-text text-center">{{ $tops[0]['name'] }}</p>
                                <p class="text-center"><small>{{ $tops[0]['department']['name'] }} </small> </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card mt-4" style="box-shadow: 2px 2px 4px 2px #c7c7c7bd;">
                            <div class="card-body">
                                <h4 class="card-title text-center">
                                    <img src="{{ url('img/bronze.png') }}" alt="">
                                    {{ $tops[2]['points'] }} Points
                                </h4>
                                <p class="text-center">
                                    <img src="{{ 'https://ui-avatars.com/api/?background=random&rounded=true&name=' . $tops[2]['name'] }}" class="card-img-top" alt="{{ $tops[2]['name'] }}" style="height:100px">
                                </p>

                                <p class="card-text text-center">{{ $tops[2]['name'] }}</p>
                                <p class="text-center"><small>{{ $tops[2]['department']['name'] }} </small> </p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-12">
                        <div class="alert alert-info mt-4" role="alert">
                            No data found!
                        </div>
                    </div>
                    @endif
                    <div class="col-md-12 mt-4">
                        <h4>Top 10 Employees</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Rank</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Points</th>
                                        <th scope="col">Department</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)
                                    <tr>
                                        <th scope="row">#{{ $loop->iteration + 3 }}</th>
                                        <td>
                                            <img src="{{ 'https://ui-avatars.com/api/?background=random&rounded=true&name=' . $employee->name }}" alt="{{ $employee->name }}" style="height:40px">
                                            {{ $employee->name }}
                                        </td>
                                        <td>{{ $employee->points }}</td>
                                        <td style="color: {{ $employee->department->color }}">{{ $employee->department->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection