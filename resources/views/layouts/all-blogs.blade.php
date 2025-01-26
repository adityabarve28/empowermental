@push('title')
<title>Empowermental || All Blogs</title>
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
<section class="sec-blog sec-full-len-vab" id="sec-blog">
    <div class="container">
        <div class="row">
            @forelse($blogs as $blog)
            <div class="col-md-4" style=" padding:10px">
                <div class="card" style="height: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        
                        <!-- Fixed-height content preview -->
                        <p class="card-text content-preview">
                            {{ Str::limit($blog->content, 150) }}
                        </p>

                        <!-- Therapist Details -->
                        @if($blog->therapist)
                            <p class="card-text">Written By: {{ $blog->therapist->full_name }}</p>
                        @else
                        <p>Therapist details not available.</p>
                        @endif

                        <!-- Read More button always visible -->
                        <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            @empty
            <p>No blogs available.</p>
            @endforelse
        </div>
    </div>
</section>
@include('layouts.footer')
</body>
</html>