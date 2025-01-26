@push('title-admin-dash')
        <title>Empowermental || View Follow-Ups</title>
    @endpush
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Empowermental || Admin Dashboard</title>
        <link rel="icon" href="http://empowermental.onrender.com/images/logo.png" type="image/x-icon">
    <link rel="icon" href="https://aa52-2409-40c2-505e-581e-f03f-e85b-c0f1-1ad3.ngrok-free.apphttp://empowermental.onrender.com/images/logo.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   
    <link rel="stylesheet" href= "https://f560-2409-40c2-5006-c118-6811-4482-32b0-2261.ngrok-free.app/css/dashboard-style.css">
    <link rel="stylesheet" href="http://empowermental.onrender.com/css/dashboard-style.css"> <!-- Link to your CSS file -->
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
    <div class="container-dashboard">
        <h2>Follow-Ups</h2>
        <!-- <a href="{{ route('admin.follow-ups.create') }}" class="btn btn-success mb-3">Add New Follow-Up</a> -->

        @if($followUps->isEmpty())
        <p>No follow-ups found.</p>
        @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Phone Number</th>
                    <th>Date of Appointment</th>
                    <th>Role</th>
                    <th>Appointment Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($followUps as $followUp)
                <tr>
                    <td>{{ $followUp->name }}</td>
                    <td>{{ $followUp->location }}</td>
                    <td>{{ $followUp->phone_number }}</td>
                    <td>{{ $followUp->date_of_appointment }}</td>
                    <td>{{ ucfirst($followUp->role) }}</td>
                    <td>{{ ucfirst($followUp->appointment_type) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

@include('layouts.footer')
</body>
</html>
