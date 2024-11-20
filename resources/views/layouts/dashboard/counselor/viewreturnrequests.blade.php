@include('layouts.dashboard.counselor.counselor-dash-nav')

@push('title-cons-dash')
    <title>Empowermental || View Return Requests</title>
@endpush

@section('content')
<body class="body-dashboard">
    <div class="container-dashboard">
        <div class="welcome-section section">
            <h2>My Return Requests</h2>
        </div>

        <!-- Display success message if available -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display list of return requests -->
        <div class="return-requests-section section">
            @if ($returnRequests->isEmpty())
                <p>No return requests found.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Request ID</th>
                            <th>Travel Date</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Screenshots</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($returnRequests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->travel_date }}</td>
                                <td>{{ $request->travel_location }}</td>
                                <td>{{ $request->description }}</td>
                                <td>{{ ucfirst($request->status) }}</td>
                                <td>
                                    @foreach ($request->screenshots as $screenshot)
                                        <a href="{{ asset('storage/' . $screenshot) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $screenshot) }}" alt="Screenshot" width="50">
                                        </a>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
@include('layouts.footer')