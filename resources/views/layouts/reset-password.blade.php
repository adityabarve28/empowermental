<!-- resources/views/layout/reset-password.blade.php -->
@include('layouts.navbar')

<div class="bg-fullscreen">
    <div class="jumbotron-opaque">
        <h2>Reset Password</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required minlength="8">
            </div>

            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required minlength="8">
            </div>

            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
</div>
@include('layouts.footer')