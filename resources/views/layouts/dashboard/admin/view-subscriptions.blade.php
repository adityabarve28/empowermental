@push('title-admin-dash')
    <title>Empowermental || View Subscriptions</title>
@endpush

@include('layouts.dashboard.admin.admin-dash-nav')

<body class="body-dashboard">
    <!-- Content Section -->
    <main class="container-dashboard">
        <h2>All Subscriptions</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Institute Name</th>
                    <th>Plan Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Amount</th>
                    <th>Counselor Name</th>
                    <th>Counselor Email</th>
                    <th>Status</th>
                    <th>Set Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->id }}</td>
                        <td>{{ $subscription->institute->institute_name ?? 'N/A' }}</td>
                        <td>{{ $subscription->plan->name ?? 'N/A' }}</td>
                        <td>{{ $subscription->start_date }}</td>
                        <td>{{ $subscription->end_date }}</td>
                        <td>{{ number_format($subscription->amount, 2) }}</td>
                        <td>{{ $subscription->therapist->full_name ?? 'N/A' }}</td>
                        <td>{{ $subscription->therapist->email ?? 'N/A' }}</td>
                        <td>{{ $subscription->status === 1 ? 'Active' : 'Inactive' }}</td>
                        <td>
                            @if($subscription->status === 1)
                                <form action="{{ route('subscriptions.setStatus', $subscription->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-warning">Set as Inactive</button>
                                </form>
                            @else
                                <form action="{{ route('subscriptions.setStatus', $subscription->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">Set as Active</button>
                                </form>
                            @endif

                            @if(is_null($subscription->therapist) && $subscription->plan->name !== 'Premium Plan')
                                <a href="{{ route('counselors.assign', $subscription->id) }}" class="btn btn-info">Assign Counselor</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">No subscriptions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</body>

@include('layouts.footer')
