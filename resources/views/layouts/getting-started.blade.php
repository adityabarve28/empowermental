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
<body class="body-getting-started">
    @push('title')
    <title>Empowermental || Getting Started</title>
    @endpush
    @include('layouts.navbar')
    <div class="container-getting-started">
        <h1 class="h1-gs">Getting Started with EmpowerMental</h1>
        <p>Welcome to EmpowerMental! Follow these steps to make the most out of your mental health journey. This guide will walk you through the process of registering, accessing services, and booking sessions on our platform.</p>

        <div class="step-gs">
            <h3>Step 1: Institution Registration</h3>
            <p>Your institution has already signed up and subscribed to EmpowerMental. You will receive login credentials from your institution to access your account.</p>
        </div>

        <div class="step-gs">
            <h3>Step 2: Explore Your Dashboard</h3>
            <p>After logging in, you will be redirected to your personalized dashboard. Here, you can view appointments based on the dates scheduled by your institution. This will help you stay informed about upcoming sessions and activities.</p>
        </div>

        <div class="step-gs">
            <h3>Step 3: Book and Manage Appointments</h3>
            <p>Navigate to the "Appointments" section of your dashboard to see a scheduled sessions with a licensed therapist. You can also use this section to clarify any doubts or make changes to your existing appointments.</p>
        </div>

        <div class="step-gs">
            <h3>Step 4: Attend Workshops (if applicable)</h3>
            <p>If your institution’s subscription plan includes workshops, visit the "Workshops" section to explore available events. Take full advantage of these sessions to enhance your mental well-being through valuable insights and coping strategies.</p>
        </div>
    </div>
    @include('layouts.footer')
</body>
</html>