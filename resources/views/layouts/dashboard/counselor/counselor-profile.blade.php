@push('title-cons-dash')
<title>Empowermental || Counselor Profile</title>
@endpush
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@include('layouts.dashboard.counselor.counselor-dash-nav')

<body class="body-dashboard">
    <div class="profile-container">
        <div class="profile-card">
            <h2>View & Update Profile</h2>

            <!-- Display success message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Profile Image -->
            <img src="{{ asset('storage/' . $details->profile_pic) }}" alt="Profile Picture" />

            <!-- Form to update profile -->
            <form action="{{ route('counselor-profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" class="form-control hidden" id="license" name="license" value="{{ $details->license }}" hidden>
                <div id="counselorFields">
                    <div class="form-group">
                        <label for="profilePic">Update Profile Picture</label>
                        <input type="file" class="form-control-file" id="profilePic" name="profile_pic">
                    </div>
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" value="{{ $details->full_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $details->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ $details->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="qualification">Qualification</label>
                        <input type="text" class="form-control" id="qualification" name="qualification" value="{{ $details->qualification }}">
                    </div>
                    <div class="form-group">
                        <label for="experience">Years of Experience</label>
                        <input type="number" class="form-control" id="experience" name="experience" value="{{ $details->experience }}">
                    </div>
                    <div class="form-group">
                        <label for="specialization">Specialization</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" value="{{ $details->specialization }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $details->address }}">
                    </div>
                    <div class="form-group">
                        <label for="aboutMe">About Me</label>
                        <textarea class="form-control" id="aboutMe" name="about_me" rows="4">{{ $details->about_me }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Update Profile">
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.footer')
</body>
