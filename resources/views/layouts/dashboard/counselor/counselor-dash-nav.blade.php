<?php session_start(); // Make sure session is started at the beginning 
?>

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