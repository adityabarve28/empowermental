@push('title')
<title>Empowermental || Login</title>
@endpush
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title')
    <link rel="icon" href="https://empowermental.onrender.com/images/logo.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://empowermental.onrender.com/css/style.css"> <!-- Link to your CSS file -->
     <link rel="stylesheet" href="/css/style.css">
    <!--<link rel="stylesheet" href="assets/css/signupstyle.css"> -->
    <style>
        .hidden {
            display: none;
        }

        .bg-fullscreenn {
            width: 100%;
            height: 100vh;
            /* Default height for initial load */
            /* background: url('background-image.jpg') no-repeat center center/cover; */
            position: relative;
        }

        /* .jumbotron-opaquee {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 5px;
    } */
         /* Ensure content preview height is fixed for consistent button placement */
    /* .content-preview {
        height: 1.5em; 
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3; 
        -webkit-box-orient: vertical;
    } */
    </style>
</head>
<body>
@include('layouts.navbar')

<div class="bg-fullscreen">
    <div class="jumbotron-opaque">
        <h2>Login</h2>
        <!-- Use POST method to send data to login route -->
        <form action="{{ route('login.submit') }}" method="POST">
            <!-- Include CSRF token for security -->
            @csrf
            <div class="form-group">
                <label for="loginEmail">Email Address</label>
                <input type="email" class="form-control email" id="loginEmail" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="loginPassword">Password</label>
                <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <p>Don't have an account? <a href="{{ route('sign-up') }}" id="signupLink">Sign up here</a></p>
            <p>Forgot Password? <a href="{{ route('password.reset') }}" id="ResetPassword">Reset Password</a></p>
        </form>

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

        <!-- Success message after login -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>

@include('layouts.footer')
</body>
</html>
