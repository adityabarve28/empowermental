<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title')
    <link rel="icon" href="{{ asset('/images/logo.png') }}" type="image/x-icon">
    <link rel="icon" href="https://aa52-2409-40c2-505e-581e-f03f-e85b-c0f1-1ad3.ngrok-free.app/images/logo.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}"> <!-- Link to your CSS file -->
    <link rel="stylesheet" href=" https://f560-2409-40c2-5006-c118-6811-4482-32b0-2261.ngrok-free.app/css/style.css">
    <!-- <link rel="stylesheet" href="assets/css//loginstyle.css">
    <link rel="stylesheet" href="assets/css/signupstyle.css"> -->
    <style>
        .hidden {
            display: none;
        }

        .bg-fullscreenn {
            width: 100%;
            height: 100vh;
            /* Default height for initial load */
            /* background: url('background-image.jpg') no-repeat center center/cover; */
            position: relative;
        }

        /* .jumbotron-opaquee {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 5px;
    } */
         /* Ensure content preview height is fixed for consistent button placement */
    /* .content-preview {
        height: 1.5em; 
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3; 
        -webkit-box-orient: vertical;
    } */
    </style>
</head>

<!-- Development Alert -->
<div class="alert alert-warning alert-dismissible fade show text-center" role="alert" style="margin-bottom: 0;">
    <strong>Notice:</strong> This website is currently under development. Some features may not be available.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
    <a class="navbar-brand" href="{{route('index')}}">
        <img src="{{ asset('/images/logo.png') }}" alt="Logo" style="height: 90px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('index')}}" data-text="Home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('index')}}#aboutus" data-text="About Us">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('blogs.index')}}#sec-blog" data-text="Blogs">Blogs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('contact-us')}}" data-text="Contact Us">Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('index')}}#faqs" data-text="FAQs">FAQs</a>
            </li>
            <!-- Dropdown for Institutions -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="institutionsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-text="Institutions">
                    Institutions
                </a>
                <div class="dropdown-menu" aria-labelledby="institutionsDropdown">
                    <a class="dropdown-item" href="{{route('how-it-works')}}">How it works?</a>
                    <a class="dropdown-item" href="{{route('subscription-plans')}}">Subscription Plans</a>
                    <a class="dropdown-item" href="{{route('sign-up')}}">Sign-up / Registration</a>
                </div>
            </li>
            <!-- Dropdown for Services -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="services.php" id="servicesDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-text="Services">
                    Services
                </a>
                <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                    <a class="dropdown-item" href="{{route('services')}}#1on1">1 on 1 Counselling</a>
                    <!-- <a class="dropdown-item" href="{{route('services')}}#group">Group Counselling</a> -->
                    <a class="dropdown-item" href="{{route('services')}}#workshops">Workshops</a>
                    <a class="dropdown-item" href="{{route('services')}}#special">Special Programs</a>
                </div>
            </li>
            <!-- Dropdown for Students -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="studentsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-text="Students">
                    Students
                </a>
                <div class="dropdown-menu" aria-labelledby="studentsDropdown">
                    <a class="dropdown-item" href="{{route('getting-started')}}">Getting started</a>
                    <a class="dropdown-item hidden" href="{{route('resources')}}">Resources</a>
                    <a class="dropdown-item" href="{{route('ask-for-help')}}">Ask for Help</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('feedbacks')}}" data-text="Testimonials">Testimonials</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @if(Auth::check())
            @php
            $user = Auth::user();
            $dashboardRoute = '';
            if ($user->role == 'student') {
            $dashboardRoute = route('stu-dashboard');
            } elseif ($user->role == 'institute') {
            $dashboardRoute = route('institute-dashboard');
            } elseif ($user->role == 'counselor') {
            $dashboardRoute = route('counselor-dashboard');
            }
            @endphp
            <li class="nav-item">
                <a class="nav-link" href="{{ $dashboardRoute }}" data-text="Dashboard">Dashboard</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}" data-text="Login / Sign Up">Login / Sign Up</a>
            </li>
            @endif
        </ul>
    </div>
</nav>