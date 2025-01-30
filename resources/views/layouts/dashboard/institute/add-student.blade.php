@push('title-ins-dash')
<title>Empowermental || Add Student</title>
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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<body class="body-dashboard">
    <div class="profile-container">
        <div class="profile-card">
            <h2>Add Student</h2>

            <!-- Display success message -->
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('student.store') }}" method="POST">
                @csrf
                <!-- User ID (Auto-generated) -->
                <div class="form-group">
                    <label for="user_id">User ID (Auto-generated)</label>
                    <input type="text" class="form-control" id="user_id" name="user_id" placeholder="You can view Id in view students" readonly>
                </div>
                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="name" name="email" required>
                </div>
                <!-- Phone -->
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>

                    <!-- DOB -->
                    <div class="col-md-6">
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                </div>
                <!-- Gender -->
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <!-- Year of Study -->
                    <div class="col-md-6">
                        <label for="year_of_study">Year of Study</label>
                        <input type="text" class="form-control" id="year_of_study" name="year_of_study" required>
                    </div>

                </div>
                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea type="text" class="form-control" id="address" name="address" required></textarea>
                </div>

                <!-- Institute ID (Registration Number) - Auto-filled and Disabled -->
                <div class="form-group">
                    <label for="institute_id">Institute ID (Registration Number)</label>
                    <input type="text" class="form-control" id="institute_id" name="institute_id" value="{{ $institute->id }}" disabled>
                </div>

                <!-- Password (Auto-generated) -->
                <div class="form-group">
                    <label for="password">Password (Auto-generated)</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="You can view password in view students" readonly>
                </div>

                <!-- Submit -->
                <div class="btn-container">
                    <button type="submit" class="btn btn-primary">Add Student</button>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.footer')
</body></html>