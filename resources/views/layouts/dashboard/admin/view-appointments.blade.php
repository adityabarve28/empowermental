@push('title-admin-dash')
<title>Empowermental || View Appointments</title>
@endpush

@include('layouts.dashboard.admin.admin-dash-nav')

<body class="body-dashboard">
    <!-- Content Section -->
    <main class="container-dashboard">
        <h2>All Appointments</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Institute Name</th>
                    <th>Counselor Name</th>
                    <th>Appointment Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <td>{{ $appointment->institute->institute_name ?? 'N/A' }}</td>
                    <td>{{ $appointment->counselorx->full_name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td>

                </tr>
                @empty
                <tr>
                    <td colspan="4">No Appointments found.</td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </main>
</body>

@include('layouts.footer')