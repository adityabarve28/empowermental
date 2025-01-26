@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@push('title-cons-dash')
<title>Empowermental || Write a Blog</title>
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
<body class="body-dashboard">
    @include('layouts.dashboard.counselor.counselor-dash-nav')
    <!-- Success message after login -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @auth
    @if (Auth::user()->role === 'counselor')
    <div class="container-dashboard">
        <div class="welcome-section section">
            <h2>Write a New Blog</h2>
        </div>
        <!-- Blog Form -->
        <form action="{{route('blogs.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Blog Title <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subtitle">Sub Title (Optional)</label>
                <input type="text" name="sub_title" id="subtitle" class="form-control">
            </div>
            <div class="form-group">
                <label for="content">Content (3000 characters max) <span class="text-danger">*</span></label>
                <textarea name="content" id="content" class="form-control" rows="8" maxlength="3000" required></textarea>
                <div class="char-count">Characters: <span id="charCount">0</span>/3000</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    @include('layouts.footer')
    @else
    <script>
        alert('Login To Continue');
        window.location.href = "{{ route('login') }}";
    </script>
    @endif
    @endauth

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // Character Count Tracker
        $('#content').on('input', function() {
            const charCount = this.value.length;
            $('#charCount').text(charCount);

            if (charCount > 3000) {
                alert('You have exceeded the 3000-character limit!');
                this.value = this.value.slice(0, 3000);
            }
        });
    </script>
</body>
</html>