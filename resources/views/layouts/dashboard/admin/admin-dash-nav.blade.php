<!-- Development Alert -->
<div class="alert alert-warning alert-dismissible fade show text-center fixed" role="alert" style="margin-bottom: 0;">
    <strong>Notice:</strong> This website is currently under development. Some features may not be available.
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top">
    <a class="navbar-brand" href="{{route('admin.dashboard')}}">
        <img src="{{ asset('/images/logo.png') }}" alt="Logo" style="height: 90px;">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
        <li class="nav-item">
                <a class="nav-link" href="{{route('admin.subscription-plans.manage')}}" data-text="Add Subscription Plan">Add Subscription Plan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.institutes.index')}}" data-text="View Institutes">View Institutes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.counselors.index')}}" data-text="View Counselors">View Counselors</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('ViewAccountManager')}}" data-text="View Account Managers">View Account Managers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.subscriptions.index')}}" data-text="View Subscriptions">View Subscriptions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ViewAppointments') }}" data-text="View Appointment">View Appointments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('ViewReturnRequestss') }}" data-text="View Return Requests">View Return Requests</a>
            </li>
            <!-- Dropdown for Institutions -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="institutionsDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-text="Follow Ups">
                    Follow Ups
                </a>
                <div class="dropdown-menu" aria-labelledby="institutionsDropdown">
                    <a class="dropdown-item" href="{{route('admin.follow-ups.index')}}">View Follow Ups</a>
                    <a class="dropdown-item" href="{{route('admin.follow-ups.create')}}">Add New Follow Ups</a>
                </div>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}" data-text="Logout">Logout</a>
            </li>
        </ul>
    </div>
</nav>