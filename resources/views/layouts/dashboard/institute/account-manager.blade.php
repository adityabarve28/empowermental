@include('layouts.dashboard.institute.institute-dashboard-nav')

@push('title')
<title>Account Manager Details</title>
@endpush


<body class="body-dashboard"></body>
<div class="container-dashboard">
    <h1>Account Manager Details</h1>

    <div class="account-manager-details">
        <p>Name: {{ $accountManager->name }}</p>
        <p>Email: {{ $accountManager->email }}</p>
        <p>Phone: {{ $accountManager->phone }}</p>
        <!-- Add more account manager details as needed -->
    </div>

    <div class="btn-container">
        <a href="{{ route('institute-dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
    </div>
</div>
</body>
@include('layouts.footer')