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
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<body class="body-dashboard">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card container-dashboard">
                    <div class="card-header bg-primary text-white">
                        <h3>Edit Student: {{ $student->name }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('student.update', $student->id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $student->name }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $student->email }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ $student->phone }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" value="{{ $student->dob }}" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="year_of_study">Year of Study</label>
                                <input type="text" class="form-control" name="year_of_study" value="{{ $student->year_of_study }}" required>
                            </div>
                            <div class="form-check mb-4">
                                <input type="checkbox" class="form-check-input" id="is_account_manager" name="is_account_manager" value="1" {{ $student->is_account_manager ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_account_manager">Add as Account Manager</label>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('view-student') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@include('layouts.footer')
</body>
</html>
