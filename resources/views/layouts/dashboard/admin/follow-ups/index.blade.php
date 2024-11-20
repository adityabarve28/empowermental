@push('title-admin-dash')
        <title>Empowermental || View Follow-Ups</title>
    @endpush
@include('layouts.dashboard.admin.admin-dash-nav')

<body class="body-dashboard">
    <div class="container-dashboard">
        <h2>Follow-Ups</h2>
        <!-- <a href="{{ route('admin.follow-ups.create') }}" class="btn btn-success mb-3">Add New Follow-Up</a> -->

        @if($followUps->isEmpty())
        <p>No follow-ups found.</p>
        @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Phone Number</th>
                    <th>Date of Appointment</th>
                    <th>Role</th>
                    <th>Appointment Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($followUps as $followUp)
                <tr>
                    <td>{{ $followUp->name }}</td>
                    <td>{{ $followUp->location }}</td>
                    <td>{{ $followUp->phone_number }}</td>
                    <td>{{ $followUp->date_of_appointment }}</td>
                    <td>{{ ucfirst($followUp->role) }}</td>
                    <td>{{ ucfirst($followUp->appointment_type) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</body>
@include('layouts.footer')