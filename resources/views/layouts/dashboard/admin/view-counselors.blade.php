@push('title-admin-dash')
    <title>Empowermental || View Counselors</title>
@endpush

@include('layouts.dashboard.admin.admin-dash-nav')

<body class="body-dashboard">
    <!-- Content Section -->
    <main class="container-dashboard">
        <h2>All Counselors</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Counselor Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse($counselors as $counselor)
                    <tr>
                        <td>{{ $counselor->id }}</td>
                        <td>{{ $counselor->full_name }}</td>
                        <td>{{ $counselor->email }}</td>
                        <td>{{ $counselor->phone }}</td>
                        <td>{{ $counselor->address }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No counselors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</body>

@include('layouts.footer')
