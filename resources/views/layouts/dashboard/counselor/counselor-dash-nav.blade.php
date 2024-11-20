<?php session_start(); // Make sure session is started at the beginning 
?>
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
<!-- Development Alert -->
<div class="alert alert-warning alert-dismissible fade show text-center fixed" role="alert" style="margin-bottom: 0;">
    <strong>Notice:</strong> This website is currently under development. Some features may not be available.
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
    <a class="navbar-brand" href="{{route('institute-dashboard')}}">
        <img src="{{ asset('/images/logo.png') }}" alt="Logo" style="height: 90px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('counselor-dashboard')}}#appointments" data-text="View Appointments">View Appointments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('counselor-dashboard')}}#assignment" data-text="View Assignment">View Assignment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('write-a-blog')}}" data-text="Write a blog">Write a blog</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#students" id="studentsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-text="Returns">
                    Returns
                </a>
                <div class="dropdown-menu" aria-labelledby="studentsDropdown">
                    <a class="dropdown-item" href="{{route('view-return-form')}}">View Return Form</a>
                    <a class="dropdown-item" href="{{route('returns-view')}}">View Returns Status</a>

                </div>
            </li>
            <!-- Dropdown for Students -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#students" id="studentsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-text="Feedback">
                    Feedback
                </a>
                <div class="dropdown-menu" aria-labelledby="studentsDropdown">
                    <a class="dropdown-item" href="{{route('feedback-create-cons')}}">add Feedback</a>
                    <a class="dropdown-item" href="{{route('feedback-view-cons')}}">View Feedback</a>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('counselor-profile')}}" data-text="View Profile">View Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}" data-text="Logout">Logout</a>
            </li>
        </ul>
    </div>
</nav>