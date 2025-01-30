@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@push('title-cons-dash')
<title>Empowermental || Counselor Dashboard</title>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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

<body class="body-dashboard">

    @auth
    @if (Auth::user()->role === 'counselor')
    <div class="container-dashboard">
        <!-- Welcome Section -->
        <div class="welcome-section section">
            <h1 class="h1">Welcome, {{ $name }}</h1>
        </div>
    </div>
    <div class="container-dashboard" id="appointments">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Appointment Date</th>
                    <th scope="col">Co-ordinator</th>
                    <th scope="col">Institute Name</th>
                    <th scope="col">Institute Location</th>
                    <th scope="col">Is Workshop?</th>
                    <th scope="col">Ask To Reschedule</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $appointment)
                <tr>
                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('D d M Y') }}</td>

                    <td scope="row">{{ $appointment->coordinator->name ?? 'N/A' }}</td>
                    <td scope="row">{{ $appointment->institute->institute_name }}</td>
                    <td scope="row">{{ $appointment->institute->ins_address }}</td>
                    <td scope="row">
                        @if ($appointment->plan && $appointment->plan->plan_id === 1)
                        Yes
                        @else
                        No
                        @endif
                    </td>
                    <td scope="row">
                        <form action="{{ route('appointments.askToReschedule', $appointment->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning" {{ $appointment->asked_to_reschedule ? 'disabled' : '' }}>
                                Ask to Reschedule
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">No appointments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="container-dashboard" id="assignment">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Institute Name</th>
                    <th scope="col">Institute Location</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Email ID</th>
                    <th scope="col">Co-ordinator</th>
                    <th scope="col">Co-ordinator Contact Number</th>
                    <th scope="col">Co-ordinator Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($institutes as $institute)
                @php
                    $appointment = $appointments->firstWhere('institute_id', $institute->id);
                    $accountManager = $accountManagers->get($institute->id);
                @endphp

                @if ($appointment)
                <tr>
                    <td scope="row">
                        <a href="#" data-toggle="modal" data-target="#instituteModal{{ $institute->id }}">
                            {{ $institute->institute_name }}
                        </a>
                    </td>
                    <td scope="row">{{ $institute->ins_address }}</td>
                    <td scope="row">{{ $institute->ins_phone }}</td>
                    <td scope="row">{{ $institute->ins_email }}</td>
                    <td scope="row">
                        @if ($accountManager)
                        <a href="#" data-toggle="modal" data-target="#accountManagerModal{{ $accountManager->id }}">
                            {{ $accountManager->name }}
                        </a>
                        @else
                        NA
                        @endif
                    </td>
                    <td scope="row">{{ $accountManager->phone ?? 'NA' }}</td>
                    <td scope="row">{{ $accountManager->email ?? 'NA' }}</td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="7">No appointments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

                <!-- Institute Modal -->
                <div class="modal fade" id="instituteModal{{ $institute->id }}" tabindex="-1" role="dialog" aria-labelledby="instituteModalLabel{{ $institute->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="instituteModalLabel{{ $institute->id }}">Institute Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Institute Name:</strong> {{ $institute->institute_name }}</p>
                                <p><strong>Email:</strong> {{ $institute->ins_email }}</p>
                                <p><strong>Phone:</strong> {{ $institute->ins_phone }}</p>
                                <p><strong>Registration Number:</strong> {{ $institute->registration_number }}</p>
                                <p><strong>Address:</strong> {{ $institute->ins_address }}</p>
                                <p><strong>Website:</strong> <a href="{{ $institute->website }}" target="_blank">{{ $institute->website }}</a></p>
                                <p><strong>Type:</strong> {{ $institute->ins_type }}</p>
                                <p><strong>Principal Name:</strong> {{ $institute->principal_name }}</p>
                                <p><strong>Establishment Year:</strong> {{ $institute->establishment_year }}</p>
                                <p><strong>Number of Students:</strong> {{ $institute->number_of_students }}</p>
                                <p><strong>Affiliations:</strong> {{ $institute->affiliations }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account Manager Modal -->
                @if ($accountManager)
                <div class="modal fade" id="accountManagerModal{{ $accountManager->id }}" tabindex="-1" role="dialog" aria-labelledby="accountManagerModalLabel{{ $accountManager->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="accountManagerModalLabel{{ $accountManager->id }}">Account Manager Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Name:</strong> {{ $accountManager->name }}</p>
                                <p><strong>Email:</strong> {{ $accountManager->email }}</p>
                                <p><strong>Phone:</strong> {{ $accountManager->phone }}</p>
                                <p><strong>Year of Study:</strong> {{ $accountManager->year_of_study }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
    @include('layouts.footer')
</body>
@else
<script>
    alert('Login To Continue');
    window.location.href = "{{ route('login') }}";
</script>
@endif
@endauth
                </html>