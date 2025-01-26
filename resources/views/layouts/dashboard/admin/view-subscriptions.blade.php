@push('title-admin-dash')
    <title>Empowermental || View Subscriptions</title>
@endpush
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Empowermental || Admin Dashboard</title>
        <link rel="icon" href="http://empowermental.onrender.com/images/logo.png" type="image/x-icon">
    <link rel="icon" href="https://aa52-2409-40c2-505e-581e-f03f-e85b-c0f1-1ad3.ngrok-free.apphttp://empowermental.onrender.com/images/logo.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   
    <link rel="stylesheet" href= "https://f560-2409-40c2-5006-c118-6811-4482-32b0-2261.ngrok-free.app/css/dashboard-style.css">
    <link rel="stylesheet" href="http://empowermental.onrender.com/css/dashboard-style.css"> <!-- Link to your CSS file -->
    <!-- <link rel="stylesheet" href="assets/css//loginstyle.css">
    <link rel="stylesheet" href="assets/css/signupstyle.css"> -->
    <style>
        .btn-logo-upload {
            background-image: url('../assets/images/logo.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 150px;
            /* Set a width */
            height: 150px;
            /* Set a height */
            border: none;
            outline: none;
            cursor: pointer;
            position: relative;
        }

        /* Hide the actual file input */
        .btn-logo-upload input[type="file"] {
            opacity: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            cursor: pointer;
        }

        /* Ensure modals appear above other elements */
        .modal-backdrop {
            z-index: 1050;
            /* Default is 1040, increase if needed */
        }

        .modal {
            z-index: 1060;
            /* Default is 1050, increase if needed */
        }

        .word-count {
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>

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

@include('layouts.footer')
</body>
</html>
