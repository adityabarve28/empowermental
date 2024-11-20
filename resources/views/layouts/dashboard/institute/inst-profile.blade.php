@push('title-ins-dash')
<title>Empowermental || Institute Profile</title>
@endpush

@include('layouts.dashboard.institute.institute-dashboard-nav')

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
            <img src="{{ asset('storage/' . $institute->institute_logo) }}" alt="Institute Logo" />


            <!-- Form to update profile -->
            <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- CSRF token for security -->

                <div id="instituteFields">
                    <div class="form-group">
                        <label for="instituteLogo">Update Institute Logo</label>
                        <input type="file" class="form-control-file" id="instituteLogo" name="instituteLogo">
                    </div>
                    <div class="form-group">
                        <label for="instituteName">Institute Name</label>
                        <input type="text" class="form-control" id="instituteName" name="instituteName" value="{{ $institute->institute_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="instituteEmail">Institute Email Address</label>
                        <input type="email" class="form-control" id="instituteEmail" name="instituteEmail" value="{{ $institute->ins_email }}" required>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="institutePhone">Institute Phone Number</label>
                            <input type="tel" class="form-control" id="institutePhone" name="institutePhone" value="{{ $institute->ins_phone }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="instituteStudents">Number of Students</label>
                            <input type="number" class="form-control" id="instituteStudents" name="instituteStudents" value="{{ $institute->number_of_students }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="instituteAddress">Institute Address</label>
                            <input type="text" class="form-control" id="instituteAddress" name="instituteAddress" value="{{ $institute->ins_address }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="instituteWebsite">Website</label>
                            <input type="url" class="form-control" id="instituteWebsite" name="instituteWebsite" value="{{ $institute->website }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="instituteHead">Principal/Director's Name</label>
                        <input type="text" class="form-control" id="instituteHead" name="instituteHead" value="{{ $institute->principal_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="instituteAffiliations">Affiliations/Accreditations</label>
                        <textarea class="form-control" id="instituteAffiliations" name="instituteAffiliations" rows="3">{{ $institute->affiliations }}</textarea>
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