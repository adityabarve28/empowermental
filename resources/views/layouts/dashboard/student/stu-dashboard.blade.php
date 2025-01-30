@auth
@if (Auth::user()->role === 'student')
@push('title-stu-dash')
<title>Empowermental || Student Dashboard</title>
@endpush
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title-stu-dash')
     <link rel="icon" href="https://empowermental.onrender.com/images/logo.png" type="image/x-icon">
    <link rel="icon" href="https://aa52-2409-40c2-505e-581e-f03f-e85b-c0f1-1ad3.ngrok-free.app{{ asset('/images/logo.png') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://empowermental.onrender.com/css/dashboard-style.css"">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href= "https://f560-2409-40c2-5006-c118-6811-4482-32b0-2261.ngrok-free.app/css/dashboard-style.css">
    <link rel="stylesheet" href=" https://f560-2409-40c2-5006-c118-6811-4482-32b0-2261.ngrok-free.app/css/style.css">

</head>
<body>
@include('layouts.dashboard.student.stu-dash-nav')
<div class="bg-fullscreen">
    <div class="container-dashboard">
        @if(isset($student))
            <h1>Welcome, {{ $student->name }}</h1>
            <p><strong>Email:</strong> {{ $student->email }}</p>
            <p><strong>Institute:</strong> {{ $institute->institute_name }}</p>
            <p><strong>Therapist(s) Allotted:</strong>
                @if($therapists->isNotEmpty())
                    @foreach($therapists as $therapist)
                        <span>{{ $therapist->full_name }}</span>@if(!$loop->last), @endif
                    @endforeach
                @else
                    <span>No therapists assigned.</span>
                @endif
            </p>
        @else
            <p>Student information is unavailable.</p>
        @endif
    </div>
</div>
@include('layouts.footer')
@else
<script>
    window.location.href = "{{ route('login') }}";
    alert("Please login to continue");
</script>
@endif
@endauth

@guest
<script>
    window.location.href = "{{ route('login') }}";
    alert("Please login to continue");
</script>
@endguest
</body>
</html>