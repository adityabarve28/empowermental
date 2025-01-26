@push('title-ins-dash')
<title>Empowermental || {{$student->name}}</title>
@endpush
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title-ins-dash')
    <link rel="icon" href="{{ asset('/images/logo.png') }}" type="image/x-icon">
    <link rel="icon" href="https://aa52-2409-40c2-505e-581e-f03f-e85b-c0f1-1ad3.ngrok-free.app{{ asset('/images/logo.png') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href= "https://f560-2409-40c2-5006-c118-6811-4482-32b0-2261.ngrok-free.app/css/dashboard-style.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    </style>
</head>
@include('layouts.dashboard.institute.institute-dashboard-nav')

<body class="body-dashboard">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Bootstrap Card -->
                <div class="card container-dashboard">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Student Details: {{ $student->name }}</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Email:</strong> {{ $student->email }}
                            </li>
                            <li class="list-group-item">
                                <strong>Phone:</strong> {{ $student->phone }}
                            </li>
                            <li class="list-group-item">
                                <strong>Date of Birth:</strong> {{ $student->dob }}
                            </li>
                            <li class="list-group-item">
                                <strong>Year of Study:</strong> {{ $student->year_of_study }}
                            </li>
                            <li class="list-group-item">
                                <strong>Is Account Manager?</strong>
                                @if ($student->is_account_manager === 1)
                                <p style="color: green;">Yes</p>
                                @else
                                <p style="color: red;">No</p>
                                @endif
                            </li>

                        </ul>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('view-student') }}" class="btn btn-secondary">Back to Student List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('layouts.footer')
</body>
</html>
