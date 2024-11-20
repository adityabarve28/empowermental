@push('title-admin-dash')
    <title>Empowermental || Assign Counselor</title>
@endpush

@include('layouts.dashboard.admin.admin-dash-nav')

<body class="body-dashboard">
    <main class="container-dashboard">
        <h2>Assign Counselor</h2>
        
        <div class="row">
            @foreach($counselors as $counselor)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $counselor->full_name }}</h5>
                            <p class="card-text">Experience: {{ $counselor->experience }}</p>
                            <p class="card-text">Location: {{ $counselor->location }}</p>
                            <p class="card-text">Phone: {{ $counselor->phone }}</p>
                            <p class="card-text">Email: {{ $counselor->email }}</p>
                            <form action="{{ route('counselors.storeAssigned', $subscriptionId) }}" method="POST">
                                @csrf
                                <input type="hidden" name="therapist_id" value="{{ $counselor->id }}">
                                <button type="submit" class="btn btn-success">Assign Counselor</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</body>

@include('layouts.footer')
