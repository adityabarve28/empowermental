@if(isset($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
@endif

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title-stu-dash')
    <link rel="icon" href="{{ asset('/images/logo.png') }}" type="image/x-icon">
    <link rel="icon" href="https://aa52-2409-40c2-505e-581e-f03f-e85b-c0f1-1ad3.ngrok-free.app{{ asset('/images/logo.png') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/dashboard-style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href= "https://f560-2409-40c2-5006-c118-6811-4482-32b0-2261.ngrok-free.app/css/dashboard-style.css">
    <link rel="stylesheet" href=" https://f560-2409-40c2-5006-c118-6811-4482-32b0-2261.ngrok-free.app/css/style.css">

</head>

<body>
    <!-- Development Alert -->
    <div class="alert alert-warning alert-dismissible fade show text-center" role="alert" style="margin-bottom: 0;">
        <strong>Notice:</strong> This website is currently under development. Some features may not be available.
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <a class="navbar-brand" href="{{ route('stu-dashboard') }}">
            <img src="{{ asset('/images/logo.png') }}" alt="Logo" style="height: 90px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item hidden">
                    <a class="nav-link" href="#" data-text="View Your Report">View Your Report</a>
                </li>
                <li class="nav-item hidden">
                    <a class="nav-link" href="#" data-text="Resources">Resources</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('ask-for-help')}}" data-text="Ask for Help">Ask for Help</a>
                </li>

                <!-- Dropdown for Appointments -->
                <li class="nav-item dropdown hidden">
                    <a class="nav-link dropdown-toggle" href="#" id="appointmentsDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-text="Appointments">
                        Appointments
                    </a>
                    <div class="dropdown-menu" aria-labelledby="appointmentsDropdown">
                        <a class="dropdown-item" href="#">Schedule Appointment</a>
                        <a class="dropdown-item" href="#">View Appointment</a>
                    </div>
                </li>

                <!-- Show "Go to Account Manager Dashboard" if user is an account manager -->
                @auth
                @if (Auth::user()->id === $student->user_id && $student->is_account_manager === 1)

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('acc-man-dashboard') }}" data-text="Go to Account Manager Dashboard">
                        Go to Account Manager Dashboard
                    </a>
                </li>
                @endif
                @endauth
                <li class="nav-item">
                    <a class="nav-link" href="{{route('feedback-create-3')}}" data-text="Add Feedback">Add Feedback</a>
                </li>
            </ul>

            <!-- Logout -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" data-text="Logout">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</body>

</html>