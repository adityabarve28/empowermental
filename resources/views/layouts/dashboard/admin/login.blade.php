@push('title')
<title>Empowermental || Admin Login</title>
@endpush

@include('layouts.navbar')

<div class="bg-fullscreen">
    <div class="jumbotron-opaque">
        <h2>Login</h2>
        <!-- Use POST method to send data to login route -->
        <form action="" method="POST">
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

@php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect input values
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Connect to the database
        $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Use prepared statement to prevent SQL injection
        $stmt = $pdo->prepare('SELECT * FROM _admins WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        // Directly compare input password with stored password (plain text)
        if ($user && $password === $user['password']) {
            // Store user information in session
            session(['user_id' => $user['id']]);
            session()->flash('success', 'Login successful!');
        } else {
            session()->flash('error', 'Invalid email or password.');
        }
    } catch (PDOException $e) {
        // Handle any errors
        echo 'Connection failed: ' . $e->getMessage();
    }
}
@endphp
