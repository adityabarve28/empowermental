@push('title-cons-dash')
<title>Empowermental || Add Feedback</title>
@endpush
@include('layouts.dashboard.counselor.counselor-dash-nav')
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

                <!-- Select Institute or Platform -->
                <div class="form-group">
                    <label for="to_name">Feedback To <span class="text-danger">*</span></label>
                    <select id="to_name" name="to_id" class="form-control" required onchange="updateInstituteName()">
                        <option value="" disabled selected>Select a recipient</option>
                        @foreach($institutes as $institute)
                            <option value="{{ $institute->id }}">{{ $institute->institute_name }}</option>
                        @endforeach
                        <option value="0">Platform</option> <!-- Platform has ID 0 -->
                    </select>
                </div>

                <!-- Hidden Institute Name (for clarity in storage) -->
                <input type="hidden" name="to_name" id="to_name_hidden">

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
        function updateInstituteName() {
            const select = document.getElementById('to_name');
            const selectedOption = select.options[select.selectedIndex];
            const toNameInput = document.getElementById('to_name_hidden');

            if (selectedOption.value === '0') {
                toNameInput.value = 'Platform';
            } else {
                toNameInput.value = selectedOption.text;
            }
        }
    </script>

@include('layouts.footer')
</body>
</html>