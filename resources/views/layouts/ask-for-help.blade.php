<head><link rel="icon" href="{{ asset('/images/logo.png') }}" type="image/x-icon"></head>
<body class="body-askforhelp">

@push('title')
<title>Empowermental || Ask For Help</title>
@endpush
@include('layouts.navbar')

    <div class="container-help">
        <h1 class="h1">Ask for Help</h1>
        <p>If you're facing any difficulties, have questions, or need guidance, feel free to reach out. We're here to support you in every step of your mental health journey.</p>

        <form action="submit_help_request.php" method="post">
            <div class="form-group">
                <label for="name">Your Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label for="email">Your Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="message">How can we help you?</label>
                <textarea class="form-control" id="message" name="message" rows="5" placeholder="Describe your issue or question" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-submit">Submit</button>
        </form>
    </div>
@include('layouts.footer')
</body>