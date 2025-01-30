
@push('title-ins-dash')
<title>Empowermental || Add Feedback</title>
@endpush
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title-ins-dash')
    <link rel="icon" href="{{ asset('/images/logo.png') }}" type="image/x-icon">
    <link rel="icon" href="https://aa52-2409-40c2-505e-581e-f03f-e85b-c0f1-1ad3.ngrok-free.app{{ asset('/images/logo.png') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href= "https://f560-2409-40c2-5006-c118-6811-4482-32b0-2261.ngrok-free.app/css/dashboard-style.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://empowermental.onrender.com/css/dashboard-style.css""> <!-- Link to your CSS file -->
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
    </style>
</head>
@include('layouts.dashboard.institute.institute-dashboard-nav')

<body class="body-dashboard">
    <div class="container-dashboard">
        <div class="feedback-section section">
            <h2>Submit Your Feedback</h2>
            
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

            <!-- Feedback form -->
            <form action="{{ route('feedback-store') }}" method="POST">
                @csrf
                
                <!-- Select Assigned Counselor or Platform -->
                <div class="form-group">
                    <label for="to_name">Feedback To</label>
                    <select name="to_id" id="to_name" class="form-control" required onchange="updateCounselorName()">
                        <option value="" disabled selected>Select a recipient</option>
                        @if($counselor)
                            <option value="{{ $counselor->id }}">{{ $counselor->full_name }}</option>
                        @endif
                        <option value="0">Platform</option> <!-- Set Platform to ID 0 -->
                    </select>
                </div>

                <!-- Feedback field -->
                <div class="form-group">
                    <label for="feedback">Your Feedback <span class="text-danger">*</span></label>
                    <textarea name="feedback" id="feedback" class="form-control" rows="5" maxlength="1000" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
        </div>
    </div>

    <script>
        function updateCounselorName() {
            var select = document.getElementById('to_name');
            var selectedValue = select.value;
            var toNameInput = document.createElement('input');
            toNameInput.type = 'hidden';
            toNameInput.name = 'to_name';

            if (selectedValue === '0') {
                toNameInput.value = 'Platform';
            } else {
                toNameInput.value = select.options[select.selectedIndex].text;
            }

            // Remove any existing hidden input and append the new one
            var existingInput = document.querySelector('input[name="to_name"]');
            if (existingInput) {
                existingInput.remove();
            }
            select.closest('form').appendChild(toNameInput);
        }
    </script>


@include('layouts.footer')
</body>
</html>
