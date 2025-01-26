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

<body class="body-resources">

@push('title')
<title>Empowermental || Resources</title>
@endpush
@include('layouts.navbar')

    <div class="container-resources">
        <h1 class="h1">Resources</h1>
        <p>Explore our curated resources designed to support your mental health journey. These resources include articles, videos, and guides that you can access anytime to help you manage stress, anxiety, and other mental health challenges.</p>

        <div class="resource-section">
            <h3>Articles</h3>
            <ul class="resource-list">
                <li><a href="article1.php" target="_blank">Managing Stress During Exams</a></li>
                <li><a href="article2.php" target="_blank">5 Tips for Better Mental Health</a></li>
                <li><a href="article3.php" target="_blank">How to Practice Mindfulness</a></li>
            </ul>
        </div>

        <div class="resource-section">
            <h3>Videos</h3>
            <ul class="resource-list">
                <li><a href="video1.php" target="_blank">Introduction to Meditation</a></li>
                <li><a href="video2.php" target="_blank">Dealing with Anxiety in College</a></li>
                <li><a href="video3.php" target="_blank">Time Management Strategies</a></li>
            </ul>
        </div>

        <div class="resource-section">
            <h3>Guides</h3>
            <ul class="resource-list">
                <li><a href="guide1.php" target="_blank">Step-by-Step Guide to Self-Care</a></li>
                <li><a href="guide2.php" target="_blank">Creating a Healthy Study Routine</a></li>
                <li><a href="guide3.php" target="_blank">Building Confidence and Reducing Stress</a></li>
            </ul>
        </div>
    </div>

@include('layouts.footer')
</body>
</html>
