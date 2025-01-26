<?php session_start(); // Make sure session is started at the beginning 
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
    <a class="navbar-brand" href="{{route('stu-dashboard')}}">
        <img src="{{ asset('/images/logo.png') }}" alt="Logo" style="height: 90px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('stu-dashboard')}}#reports" data-text="Back to Student Dashboard">Back to Student Dashboard</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}" data-text="Logout">Logout</a>
            </li>
        </ul>
    </div>
</nav>