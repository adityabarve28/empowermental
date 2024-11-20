@push('title-ins-dash')
<title>Empowermental || Therapist Details</title>
@endpush

@include('layouts.dashboard.institute.institute-dashboard-nav')

<body class="body-dashboard">
    <div class="container-dashboard">
        <!-- Therapist Details Section -->
        <div class="therapist-details-section section">
            @php
                // Get the therapist parameter from the URL
                $therapistId = request()->query('therapist');

                // Fetch the therapist details from the database
                $therapist = \App\Models\Counselors::find($therapistId);
            @endphp

            @if($therapist) <!-- Check if therapist exists -->
                <h2 class="h2">Therapist Details: {{ $therapist->full_name }}</h2>
                <div class="therapist-details">
                    <p><strong>Specialization:</strong> {{ $therapist->specialization }}</p>
                    <p><strong>Years of Experience:</strong> {{ $therapist->experience }} years</p>
                    <p><strong>Qualification:</strong> {{ $therapist->qualification }}</p>
                    <p><strong>Email:</strong> {{ $therapist->email }}</p>
                    <p><strong>Phone:</strong> {{ $therapist->phone }}</p>
                    <p><strong>Bio:</strong> {{ $therapist->about_me }}</p>
                </div>
            @else
                <!-- If therapist not found, show an error message -->
                <h2 class='h2'>Therapist not found</h2>
            @endif

            <div class="btn-container">
                <a href="{{ route('institute-dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
