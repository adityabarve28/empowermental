@push('title-admin-dash')
    <title>Empowermental || View Counselors</title>
@endpush

@include('layouts.dashboard.admin.admin-dash-nav')

<body class="body-dashboard">
    <!-- Content Section -->
    <main class="container-dashboard">
        <h2>All Account Managers</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Account Manager Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accmans as $accman)
                    <tr>
                        <td>{{ $accman->id }}</td>
                        <td>{{ $accman->name }}</td>
                        <td>{{ $accman->email }}</td>
                        <td>{{ $accman->phone }}</td>
                        <td>{{ $accman->address }}</td>
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
