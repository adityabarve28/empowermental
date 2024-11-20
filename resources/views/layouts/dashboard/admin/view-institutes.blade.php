@push('title-admin-dash')
    <title>Empowermental || View Institutes</title>
@endpush

@include('layouts.dashboard.admin.admin-dash-nav')

<body class="body-dashboard">
    <!-- Content Section -->
    <main class="container-dashboard">
        <h2>All Institutes</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Institute Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @forelse($institutes as $institute)
                    <tr>
                        <td>{{ $institute->id }}</td>
                        <td>{{ $institute->institute_name }}</td>
                        <td>{{ $institute->ins_email }}</td>
                        <td>{{ $institute->ins_phone }}</td>
                        <td>{{ $institute->ins_address }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No institutes found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</body>

@include('layouts.footer')
