@push('title')
<title>Empowermental || {{$blog->title}} Blog</title>
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
<section class="sec-blog sec-full-len" id="sec-blog">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $blog->title }}</h5>
                @if ($blog->sub_title != NULL)
                <h6 class="card-text"><strong>{{ $blog->sub_title }}</strong></h6>
                @endif
                <p class="card-text">
                {!! nl2br(e($blog->content)) !!}
                </p>
                <p class="card-text">Written by: <strong>{{ $therapist->full_name}}</strong></p>
            </div>
        </div>
    </div>
</section>
@include('layouts.footer')
</body>
</html>
