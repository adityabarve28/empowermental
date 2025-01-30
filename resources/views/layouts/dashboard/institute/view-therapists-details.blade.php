@push('title-ins-dash')
<title>Empowermental || Therapist Details</title>
@endpush
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title-ins-dash')
     <link rel="icon" href="https://empowermental.onrender.com/images/logo.png" type="image/x-icon">
    <link rel="icon" href="https://aa52-2409-40c2-505e-581e-f03f-e85b-c0f1-1ad3.ngrok-free.app{{ asset('/images/logo.png') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href= "https://f560-2409-40c2-5006-c118-6811-4482-32b0-2261.ngrok-free.app/css/dashboard-style.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://empowermental.onrender.com/css/dashboard-style.css""> <!-- Link to your CSS file -->
    <!-- <link rel="stylesheet" href="assets/css//loginstyle.css">
    <link rel="stylesheet" href="assets/css/signupstyle.css"> -->
    <style>
        .btn-logo-upload {
            background-image: url('../assets/images/logo.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 150px;
            /* Set a width */
            height: 150px;
            /* Set a height */
            border: none;
            outline: none;
            cursor: pointer;
            position: relative;
        }

        /* Hide the actual file input */
        .btn-logo-upload input[type="file"] {
            opacity: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            cursor: pointer;
        }
    </style>
</head>
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
</html>
