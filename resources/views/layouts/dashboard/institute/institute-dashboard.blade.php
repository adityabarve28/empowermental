@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@push('title-ins-dash')
<title>Empowermental || Institute Dashboard</title>
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
    <link rel="stylesheet" href="https://empowermental.onrender.com/css/dashboard-style.css"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href="/css/dashboard-style.css"> <!-- Link to your CSS file -->
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
    @auth
    @if (Auth::user()->role === 'institute')
    <div class="container-dashboard">
        <!-- Welcome Section -->
        <div class="welcome-section section">
            <h1 class="h1">Welcome, {{ Auth::user()->name }}</h1>

            @if($currentPlan)
            <p>Current Plan: <strong>{{ $currentPlan->name }}</strong></p>
            @isset($discountedPrice)
            <p>Price Paid: <strong>₹{{ number_format($subscription->amount) }}</strong></p>
            @endisset
            <p>Plan Cost: <strong>₹{{ number_format($currentPlan->price) }}/month</strong></p>

            @else
            <p>No active subscription plan found. Please consider subscribing to access services.</p>
            <div class="btn-container">
                <a href="{{ route('subscription-plans') }}" class="btn btn-primary">View Subscription Plans</a>
            </div>
            @endif
        </div>
    </div>

    @if ($currentPlan)
    <div class="container-dashboard">
        <!-- Key Metrics Section -->
        <div class="metrics-section section">
            <h2 class="h2">Key Metrics</h2>
            <div class="metrics-grid">
                <div class="metric-card">
                    <h3>Sessions Booked</h3>
                    <p><strong style="color: green;">{{ (number_format($sessionsBooked) ?? 0) . '/' . (number_format($sessionApproved) ?? 0) }}</strong> sessions booked this month</p>
                </div>

                <div class="metric-card">
                    <h3>Monthly Appointments</h3>
                    <ul>
                        @foreach($monthlyAppointments as $monthData)
                        <li><strong>{{ $monthData['count'] }}</strong> sessions booked</li>
                        @endforeach
                    </ul>
                </div>


                <div class="metric-card">
                    <h3>Therapist Assigned</h3>
                    <p>Name: <strong style="color: green;">{{ $therapist ? $therapist->full_name : 'N/A' }}</strong></p>
                    <p>Years of Experience: {{ $therapist ? $therapist->experience : 'N/A' }} years</p>
                </div>

                <div class="metric-card">
                    <h3>Scheduled Appointment Dates</h3>
                    <p>
                        @foreach ($scheduledAppointments as $appointment)
                        @if ($appointment->status === "completed")
                        <strong style="color: red;">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y D') }}</strong><br>
                        @elseif($appointment->status != "completed")
                        <strong style="color: green;">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y D') }}</strong><br>
                        @endif
                        @endforeach
                    </p>
                </div>

                <div class="metric-card">
                    <h3>Account Manager</h3>
                    @if($accountManager)
                    <p>
                        Name:
                        <a href="{{ route('account-manager', ['id' => $accountManager->id]) }}">
                            <strong>{{ $accountManager->name }}</strong>
                        </a>
                    </p>
                    @else
                    <p>Name: <strong>N/A</strong></p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Appointment & Scheduling Section -->
        <div class="container-dashboard">
            <div class="appointment-section section" id="appointments">
                <h2 class="h2">Book An Appointment</h2>
                <!-- Appointment Form -->
                <form action="{{ route('appointments.schedule') }}" method="POST">
                    @csrf

                    <!-- Display General Errors -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Display Individual Field Errors (if any) -->
                    <label for="counselor_id">Assigned Counselor:</label>
                    <input class="form-control" type="text" name="counselor_name" id="counselor_name" value="{{ $therapist ? $therapist->full_name : 'N/A' }}" readonly>
                    <input type="hidden" name="counselor_id" value="{{ $therapist ? $therapist->id : '' }}">
                    @error('counselor_id')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <label for="scheduled_date">Select Date:</label>
                    <input class="form-control" type="date" name="scheduled_date" id="appointmentDate" required>
                    @error('scheduled_date')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <button class="form-control btn-primary" type="submit">Schedule Appointment</button>
                </form>

            </div>
        </div>

        <div class="container-dashboard">
            <div class="reschedule-requests-section section" id="reschedule-requests">
                <h2 class="h2">Reschedule Requests</h2>
                @if($rescheduleRequests->isEmpty())
                <p>No reschedule requests from counselors at this time.</p>
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Appointment Date</th>
                            <th>Requested by</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rescheduleRequests as $request)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($request->appointment_date)->format('d M Y D') }}</td>
                            <td>{{ $request->counselor->full_name ?? 'N/A' }}</td>
                            <td>The counselor has asked to reschedule the appointment of {{ \Carbon\Carbon::parse($request->appointment_date)->format('d-M-Y-D') }}.</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
        <!-- Appointments Section -->
        <div class="container-dashboard">
            <div class="appointment-section section" id="appointments">
                <h2 class="h2">My Appointments</h2>

                @if($scheduledAppointments->isEmpty())
                <p>No appointments scheduled.</p>
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Appointment Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($scheduledAppointments as $appointment)
                        @if ($appointment->status != "completed")
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y D') }}</td>
                            <td>{{ ucfirst($appointment->status) }}</td>
                            <td>
                                <!-- Reschedule Form -->
                                <div class="reschedule-form" id="reschedule-form-{{ $appointment->id }}">
                                    <form action="{{ route('appointments.reschedule', ['appointmentId' => $appointment->id]) }}" method="POST">
                                        @csrf
                                        <label for="new_scheduled_date">New Date:</label>
                                        <input class="form-control" type="date" name="scheduled_date" id="new_scheduled_date"
                                            required min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                            max="{{ \Carbon\Carbon::parse($endDate)->format('Y-m-d')}}">
                                        @error('scheduled_date')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <button class="btn btn-primary" type="submit">Confirm Reschedule</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif

                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>

        <!-- Therapist Management Section -->
        <div class="container-dashboard">
            <div class="therapist-section section" id="therapist">
                <h2 class="h2">Therapist Management</h2>

                @if($currentPlan && $currentPlan->name === 'Premium Plan' && $therapist == NULL)
                <div class="therapist-selection">
                    <h4>Select a Therapist:</h4>

                    <div class="therapist-grid">
                        @foreach($therapistsAvailable as $availableTherapist)
                        <div class="therapist-card">
                            <img src="{{ $availableTherapist->profile_pic ? asset('storage/' . $availableTherapist->profile_pic) : 'assets/images/default-therapist.jpg' }}"
                                alt="{{ $availableTherapist->full_name }}" class="therapist-photo">
                            <h3>{{ $availableTherapist->full_name }}</h3>
                            <p>Specialization: {{ $availableTherapist->specialization }}</p>
                            <p>Years of Experience: {{ $availableTherapist->experience }} years</p>
                            <div class="btn-container">
                                <!-- Assign Therapist Button -->
                                <form action="{{ route('assign-therapist') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="therapist_id" value="{{ $availableTherapist->id }}">
                                    <button type="submit" class="btn btn-primary">Assign Therapist</button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @elseif($currentPlan && $currentPlan->name != 'Premium Plan' && $therapist == NULL)
                <p>Contact admin for therapist assignment</p>
                @endif

                <div class="therapist-grid">
                    @if($therapist)
                    <div class="therapist-card">
                        <img src="{{ $therapist->profile_pic ? asset('storage/' . $therapist->profile_pic) : 'assets/images/default-therapist.jpg' }}"
                            alt="{{ $therapist->full_name }}" class="therapist-photo">
                        <h3>{{ $therapist->full_name }}</h3>
                        <p>Specialization: {{ $therapist->specialization }}</p>
                        <p>Years of Experience: {{ $therapist->experience }} years</p>
                        <div class="btn-container">
                            <a href="{{ route('view-therapists-details', ['therapist' => $therapist->id]) }}"
                                class="btn btn-primary">View Full Details</a>
                        </div>
                    </div>
                    @else
                    <p>No therapist assigned</p>
                    @endif
                </div>
            </div>
        </div>


        <!-- Student Management Section -->
        <div class="container-dashboard">
            <div class="student-section section" id="student">
                <h2 class="h2">Student Management</h2>
                <p>View and manage registered students who are utilizing the mental health services.</p>
                <div class="btn-container">
                    <a href="{{ route('view-student') }}" class="btn btn-primary">View Students</a>
                </div>
            </div>
        </div>

        <!-- Billing & Subscription Section -->
        <div class="container-dashboard">
            <div class="myplan-section section" id="myplan">
                <h2 class="h2">My Plan</h2>
                <div class="billing-details">
                    <h3>Current Plan: <strong>{{ $currentPlan->name }}</strong></h3>

                    @if ($discountedPrice > 0)
                    <p>Original Plan Price: <strong>₹{{ number_format($currentPlan->price) }}/month</strong></p>
                    <p>Discount Applied: <strong>{{ $discountPercent }}%</strong></p>
                    @if ($discountPercent != 0)
                    <p class="">Discounted Price for Total Duration: <strong>₹{{ number_format($discountedPrice) }}</strong></p>
                    @endif
                    <p>Price Paid: <strong>₹{{ number_format($subscription->amount) }}</strong></p>
                    <p>For: <strong>{{ number_format($totalMonths) }} Months</strong></p> <!-- Show decimal months and days -->
                    @else
                    <p>Plan Price: <strong>₹{{ number_format($currentPlan->price) }}/month</strong></p>
                    @endif

                    <p>Date of Purchase: <strong>{{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y D') }}</strong></p>
                    <p>Expiry Date: <strong>{{ \Carbon\Carbon::parse($subscription->end_date)->format('d M Y D') }}</strong></p>
                    <p>Subscription Duration: <strong>{{ number_format($totalMonths) }} months</strong></p>

                    <!-- <div class="btn-container">
                        <a href="#" class="btn btn-primary">Manage Subscription</a>
                    </div> -->
                </div>
            </div>
        </div>
        @else
        <!-- No Active Subscription -->
        <div class="container-dashboard">
            <div class="myplan-section section" id="myplan">
                <h2 class="h2">My Plan</h2>
                <div class="billing-details">
                    <h3>No Active Subscription Plan</h3>
                    <div class="btn-container">
                        <a href="{{ route('subscription-plans') }}" class="btn btn-primary">View Subscription Plans</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    @include('layouts.footer')
    @else
    <script>
        alert('Login To Continue');
        window.location.href = "{{ route('login') }}";
    </script>
    @endif
    @endauth
</body>
</html>