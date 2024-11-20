@push('title-stu-dash')
<title>Empowermental || Student Login</title>
@endpush
@include('layouts.dashboard.student.stu-dash-nav')
<div class="bg-fullscreen">
    <div class="jumbotron-opaque">
        <h2>Login</h2>
        <form id="loginForm">
            <div class="form-group">
                <label for="loginEmail">Email Address</label>
                <input type="email" class="form-control" id="loginEmail" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="loginPassword">Password</label>
                <input type="password" class="form-control" id="loginPassword" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <p>Ask your Institute for Credentials</p>
        </form>
    </div>
</div>
@include('layouts.footer')