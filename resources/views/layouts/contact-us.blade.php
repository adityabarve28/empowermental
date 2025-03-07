@push('title')
<title>Empowermental || Contact Us</title>
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

<div class="bg-fullscreenn" id="bg-fullscreen">
    <!-- Signup Form -->
    <div id="" class="jumbotron-opaquee">
        <h2>Contact Us</h2>

        <div class="row">
            <div class="col-md-6">
                <h3>Get in Touch</h3>
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <div class="col-md-6">
                <h3>Our Location</h3>
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
        </div>

        <div class="contact-info">
            <h3>Contact Information</h3>
            <ul class="list-unstyled">
                <li>
                    <i class="fas fa-phone"></i>
                    <span>9137818209</span>
                </li>
                <li>
                    <i class="fas fa-envelope"></i>
                    <span>adityabarve28@gmail.com</span>
                </li>
                <li>
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Titwala</span>
                </li>
            </ul>
        </div>
        <!-- 19.298178, 73.208882 -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnwSkQXk0Ik3CV1hJfJB8FnLymrgBahrs&callback=initMap" async defer></script>
        <script>
            function initMap() {
                // Specify the location
                var location = {
                    lat: 19.298178,
                    lng: 73.208882
                }; // Replace with actual coordinates
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 8,
                    center: location
                });
                var marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
        </script>

    </div>
</div>

@include('layouts.footer')
</body>
</html>
