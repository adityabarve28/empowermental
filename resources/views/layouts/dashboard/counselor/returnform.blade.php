

@push('title-cons-dash')
<title>Empowermental || Request a Return</title>
@endpush
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title-cons-dash')
    <link rel="icon" href="{{ asset('/images/logo.png') }}" type="image/x-icon">
    <link rel="icon" href="https://aa52-2409-40c2-505e-581e-f03f-e85b-c0f1-1ad3.ngrok-free.app{{ asset('/images/logo.png') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href= "https://f560-2409-40c2-5006-c118-6811-4482-32b0-2261.ngrok-free.app/css/dashboard-style.css">

    <link rel="stylesheet" href="{{ asset('/css/dashboard-style.css') }}"> <!-- Link to your CSS file -->
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
@include('layouts.dashboard.counselor.counselor-dash-nav')
<body class="body-dashboard">
    <div class="container-dashboard">
        <div class="section">
            <h2>Request a Return</h2>
            
            <!-- Display success message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Return Request Form -->
            <form action="{{ route('returns-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Travel Date -->
                <div class="form-group">
                    <label for="travel_date">Travel Date <span class="text-danger">*</span></label>
                    <input type="date" name="travel_date" id="travel_date" class="form-control" required>
                </div>
                
                <!-- Travel Location -->
                <div class="form-group">
                    <label for="travel_location">Travel Location <span class="text-danger">*</span></label>
                    <input type="text" name="travel_location" id="travel_location" class="form-control" required>
                </div>
                
                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description (Optional)</label>
                    <textarea name="description" id="description" class="form-control" rows="4" maxlength="500"></textarea>
                </div>
                
                <!-- Upload Screenshots -->
                <div class="form-group">
                    <label for="screenshots">Upload Screenshots</label>
                    <input type="file" name="screenshots[]" id="screenshots" class="form-control-file" multiple>
                    <small class="form-text text-muted">You can upload multiple images (jpeg, png, jpg, gif). Max size: 2MB each.</small>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit Return Request</button>
            </form>
        </div>
    </div>

@include('layouts.footer')
</body>
</html>
