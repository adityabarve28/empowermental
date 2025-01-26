@push('title-admin-dash')
<title>Empowermental || View Counselors</title>
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
    @include('layouts.footer')
</body>

</html>