

@push('title-cons-dash')
    <title>Empowermental || View Return Requests</title>
@endpush
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title-cons-dash')
    <link rel="icon" href="{{ asset('/images/logo.png') }}" type="image/x-icon">
    <link rel="icon" href="https://aa52-2409-40c2-505e-581e-f03f-e85b-c0f1-1ad3.ngrok-free.app{{ asset('/images/logo.png') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href= "https://f560-2409-40c2-5006-c118-6811-4482-32b0-2261.ngrok-free.app/css/dashboard-style.css">

    <link rel="stylesheet" href="{{ asset('/css/dashboard-style.css') }}"> <!-- Link to your CSS file -->
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

        /* Ensure modals appear above other elements */
        .modal-backdrop {
            z-index: 1050;
            /* Default is 1040, increase if needed */
        }

        .modal {
            z-index: 1060;
            /* Default is 1050, increase if needed */
        }

        .word-count {
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
@include('layouts.dashboard.counselor.counselor-dash-nav')
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

@include('layouts.footer')
</body>
</html>