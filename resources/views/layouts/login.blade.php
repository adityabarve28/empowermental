@push('title')
<title>Empowermental || Login</title>
@endpush

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
                <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter your email" required>
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
