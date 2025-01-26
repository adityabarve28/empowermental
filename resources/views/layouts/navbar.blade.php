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