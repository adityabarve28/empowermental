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
                    <th>Travel Date</th>
                    <th>Travel Location</th>
                    <th>Description</th>
                    <th>Proof's</th>
                    <th>Current Status</th>
                    <th>Update Status</th> <!-- New Column for Status -->
                    <th>Action</th> <!-- New Column for Update Button -->
                </tr>
            </thead>
            <tbody>
                @forelse($bills as $bill)
                <tr>
                    <td>{{ $bill->id }}</td>
                    <td>{{ $bill->counselorr->full_name }}</td>
                    <td>{{ $bill->travel_date }}</td>
                    <td>{{ $bill->travel_location }}</td>
                    <td>{{ $bill->description }}</td>
                    <td>
                        @foreach ($bill->screenshots as $screenshot)
                        <a href="{{ asset('storage/' . $screenshot) }}" target="_blank">
                            <img src="{{ asset('storage/' . $screenshot) }}" alt="Screenshot" width="50">
                        </a>
                        @endforeach
                    </td>
                    <td>{{ $bill->status }}</td>
                    <td>
                        <!-- Form for Status Update -->
                        <form action="{{ route('admin.updateReturnStatus', $bill->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-control">
                                <option value="">Select</option>

                                <!-- Show "Approved" if status is pending -->
                                @if ($bill->status === 'pending' || $bill->status === 'declined')
                                <option value="Approved" {{ $bill->status === 'Approved' ? 'selected' : '' }}>Approved</option>
                                @endif
                                @if ($bill->status === 'pending' || $bill->status === 'approved')
                                <!-- Always show "Completed" option -->
                                <option value="Completed" {{ $bill->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                @endif
                                <!-- Show "Declined" if status is pending -->
                                @if ($bill->status === 'pending')
                                <option value="Declined" {{ $bill->status === 'Declined' ? 'selected' : '' }}>Declined</option>
                                @endif
                            </select>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </td>


                </tr>
                @empty
                <tr>
                    <td colspan="8">No Returns found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </main>
</body>

@include('layouts.footer')