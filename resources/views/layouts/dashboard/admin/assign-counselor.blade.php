@push('title-admin-dash')
    <title>Empowermental || Assign Counselor</title>
@endpush
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title-admin-dash')
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
    @include('layouts.footer')

</body>

</html>