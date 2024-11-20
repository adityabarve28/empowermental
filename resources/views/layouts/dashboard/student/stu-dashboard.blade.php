@auth
@if (Auth::user()->role === 'student')
@push('title-stu-dash')
<title>Empowermental || Student Dashboard</title>
@endpush
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
