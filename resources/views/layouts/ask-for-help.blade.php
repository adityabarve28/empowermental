@push('title')
<title>Empowermental || Ask For Help</title>
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
    <!-- <link rel="stylesheet" href="assets/css//loginstyle.css">
    <link rel="stylesheet" href="assets/css/signupstyle.css"> -->
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
</html>
