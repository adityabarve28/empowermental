@push('title-admin-dash')
<title>Empowermental || Create Follow-Ups</title>
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
        <h2>Add Follow-Up</h2>
        <form action="{{ route('admin.follow-ups.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="date_of_appointment">Date of Appointment</label>
                <input type="datetime-local" name="date_of_appointment" id="date_of_appointment" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="counselor">Counselor</option>
                    <option value="institute">Institute</option>
                </select>
            </div>

            <div class="form-group">
                <label for="appointment_type">Appointment Type</label>
                <select name="appointment_type" id="appointment_type" class="form-control" required>
                    <option value="Call">Call</option>
                    <option value="Meet">Meet</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Add Follow-Up</button>
        </form>
    </div>
    @include('layouts.footer')
    </body>
    </html>
