@push('title-acc-man-dash')
<title>Empowermental || Account Manager Dashboard</title>
@endpush

@include('layouts.dashboard.acc-manager.acc-man-dash-nav')

<body class="body-dashboard">
    @auth
    @if (Auth::user()->is_account_manager === 1)
    <div class="container-dashboard">
        <!-- Welcome Section -->
        <div class="welcome-section section">
            <h1 class="h1">Welcome, {{ Auth::user()->name }}</h1>
            <p>Your responsibilities include:</p>
            <ul>
                <li>Coordinate with institutes and counselors</li>
                <li>Be present during all sessions</li>
            </ul>
        </div>

        <!-- Institute, Counselor, and Appointment Details Section -->
        <div class="container-dashboard">
            <div class="details-section section">
                <h2 class="h2">Details Overview</h2>

                <div class="container">
                    <div class="row">
                        <!-- Institute Details Card -->
                        <div class="col-md-6">
                            <div class="details-card card mb-4">
                                <div class="card-body">
                                    <h3 class="card-title">Institute Details</h3>
                                    <p><strong>Name:</strong> {{ $institute ? $institute->institute_name : 'N/A' }}</p>
                                    <p><strong>Email:</strong> {{ $institute ? $institute->ins_email : 'N/A' }}</p>
                                    <p><strong>Phone:</strong> {{ $institute ? $institute->ins_phone : 'N/A' }}</p>
                                    <p><strong>Plan:</strong> {{ $currentPlan ? $currentPlan->name : 'No active plan' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Counselor Details Card -->
                        <div class="col-md-6">
                            <div class="details-card card mb-4">
                                <div class="card-body">
                                    <h3 class="card-title">Counselor Details</h3>
                                    @if($counselor)
                                    <p><strong>Name:</strong> {{ $counselor->full_name }}</p>
                                    <p><strong>Specialization:</strong> {{ $counselor->specialization }}</p>
                                    <p><strong>Phone:</strong> {{ $counselor->phone }}</p>
                                    <p><strong>Email:</strong> {{ $counselor->email }}</p>
                                    <p><strong>Experience:</strong> {{ $counselor->experience }} years</p>
                                    @else
                                    <p>No counselor assigned.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Appointment Details Card -->
                <div class="details-card">
                    <h3>Appointment Details</h3>
                    @if($appointments && $appointments->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Institute</th>
                                <th>Counselor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td>
                                <td>{{ $appointment->institute->institute_name ?? 'N/A' }}</td>
                                <td>{{ $appointment->counselor->full_name ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No appointments scheduled.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>

    @include('layouts.footer')
    @else
    <!-- Redirect to login if the user is not an account manager -->
    <script>
        alert('Unauthorized access. Please log in as an account manager.');
        window.location.href = "{{ route('login') }}";
    </script>
    @endif
    @endauth

    @guest
    <!-- If the user is not authenticated, redirect to the login page -->
    <script>
        alert('Please log in to access the dashboard.');
        window.location.href = "{{ route('login') }}";
    </script>
    @endguest
</body>