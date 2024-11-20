@push('title-admin-dash')
<title>Empowermental || Create Follow-Ups</title>
@endpush
@include('layouts.dashboard.admin.admin-dash-nav')

<body class="body-dashboard">
    <div class="container-dashboard">
        <h2>Add Follow-Up</h2>
        <form action="{{ route('admin.follow-ups.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input type="text" name="phone_number" id="phone_number" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="date_of_appointment">Date of Appointment</label>
                <input type="datetime-local" name="date_of_appointment" id="date_of_appointment" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control" required>
                    <option value="counselor">Counselor</option>
                    <option value="institute">Institute</option>
                </select>
            </div>

            <div class="form-group">
                <label for="appointment_type">Appointment Type</label>
                <select name="appointment_type" id="appointment_type" class="form-control" required>
                    <option value="Call">Call</option>
                    <option value="Meet">Meet</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Add Follow-Up</button>
        </form>
    </div>
    @include('layouts.footer')