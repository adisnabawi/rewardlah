@if (session('error'))
    <div class="alert alert-danger mt-4">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger mt-4">
        <ul class="mb-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif