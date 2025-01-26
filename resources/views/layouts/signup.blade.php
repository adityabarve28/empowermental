@push('title')
<title>Empowermental || Signup</title>
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
    <div id="signupForm" class="jumbotron-opaquee">
        <h2>Signup</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="post" id="signupFormm" enctype="multipart/form-data">
            @csrf

            <!-- Signup Type -->
            <div class="form-group">
                <label for="signupType">Signup as:</label>
                <select name="type" class="form-control" id="signupType" required>
                    <option value="">Select</option>
                    <option value="counselor">Counselor</option>
                    <option value="institute">Institute</option>
                </select>
            </div>

            <!-- Counselor Fields -->
            <div id="counselorFields" class="hidden">
                <div class="form-group">
                    <label for="profile_pic">Profile Pic</label>
                    <input type="file" class="form-control" id="profile_pic" name="profile_pic">
                </div>
                <div class="form-group">
                    <label for="counselorName">Full Name <span id="counselorNameCount">0/36</span></label>
                    <input type="text" class="form-control" id="counselorName" name="full_name" maxlength="36" placeholder="Enter your full name" required oninput="updateCharacterCount('counselorName', 'counselorNameCount')">
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="counselorEmail">Email Address</label>
                        <input type="email" class="form-control" id="counselorEmail" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="col-md-6">
                        <label for="counselorLicense">License/Certification Number</label>
                        <input type="text" class="form-control" id="counselorLicense" name="license" placeholder="Enter your license or certification number" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="counselorPassword">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="counselorPassword" name="password" placeholder="Password" required>
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('counselorPassword')">Show</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="counselorConfirmPassword">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="counselorConfirmPassword" name="password_confirmation" placeholder="Confirm Password" required>
                            <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('counselorConfirmPassword')">Show</button>
                        </div>
                    </div>
                </div>

                <!-- Additional counselor fields -->
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="counselorPhone">Phone Number</label>
                        <input type="tel" class="form-control" id="counselorPhone" name="phone" placeholder="Enter your phone number" required>
                    </div>
                    <div class="col-md-6">
                        <label for="counselorQualification">Qualification</label>
                        <input type="text" class="form-control" id="counselorQualification" name="qualification" placeholder="Enter your qualifications" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="counselorExperience">Years of Experience</label>
                        <input type="number" class="form-control" id="counselorExperience" name="experience" placeholder="Enter your experience in years" required>
                    </div>
                    <div class="col-md-6">
                        <label for="counselorSpecialization">Specialization</label>
                        <input type="text" class="form-control" id="counselorSpecialization" name="specialization" placeholder="Enter your specialization" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="counselorAddress">Address</label>
                    <input type="text" class="form-control" id="counselorAddress" name="address" placeholder="Enter your address" required>
                </div>
                <div class="form-group">
                    <label for="counselorAbout">About Me</label>
                    <textarea class="form-control" id="counselorAbout" name="about_me" rows="3" placeholder="Tell us about yourself (optional)"></textarea>
                </div>
            </div>
            <!-- Institute Fields -->
            <div id="instituteFields">
                <div class="form-group">
                    <label for="instituteName">Institute Name</label>
                    <input type="text" class="form-control" id="instituteName" name="institute_name" placeholder="Enter the institute name" required>
                </div>

                <div class="form-group">
                    <label for="instituteEmail">Institute Email Address</label>
                    <input type="email" class="form-control" id="instituteEmail" name="ins_email" placeholder="Enter the institute email" required>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="institutePassword">Password</label>
                        <input type="password" class="form-control" id="institutePassword" name="ins_password" placeholder="Password" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('institutePassword')">Show</button>
                    </div>
                    <div class="col-md-6">
                        <label for="instituteConfirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="instituteConfirmPassword" name="institute_confirm_password" placeholder="Confirm Password" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePasswordVisibility('instituteConfirmPassword')">Show</button>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="institutePhone">Institute Phone Number</label>
                        <input type="tel" class="form-control" id="institutePhone" name="ins_phone" placeholder="Enter the institute phone number" required>
                    </div>
                    <div class="col-md-6">
                        <label for="instituteRegNumber">Registration Number</label>
                        <input type="text" class="form-control" id="instituteRegNumber" name="registration_number" placeholder="Enter the institute registration number" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="instituteAddress">Institute Address</label>
                        <input type="text" class="form-control" id="instituteAddress" name="ins_address" placeholder="Enter the institute address" required>
                    </div>
                    <div class="col-md-6">
                        <label for="instituteWebsite">Website</label>
                        <input type="url" class="form-control" id="instituteWebsite" name="website" placeholder="Enter the institute website (optional)">
                    </div>
                </div>

                <div class="form-group">
                    <label for="instituteType">Institute Type</label>
                    <select name="ins_type" class="form-control" id="instituteType" required>
                        <option value="">Select</option>
                        <option value="Private">Private</option>
                        <option value="Government">Government</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="instituteHead">Principal/Director's Name</label>
                    <input type="text" class="form-control" id="instituteHead" name="principal_name" placeholder="Enter the head of the institute's name" required>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="instituteEstablishment">Year of Establishment</label>
                        <input type="number" class="form-control" id="instituteEstablishment" name="year_of_establishment" placeholder="Enter year of establishment" required>
                    </div>
                    <div class="col-md-6">
                        <label for="number_of_students">Number of Students</label>
                        <input type="number" class="form-control" id="number_of_students" name="number_of_students" placeholder="Enter number of students" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="instituteDescription">Institute Description</label>
                    <textarea class="form-control" id="instituteDescription" name="description" rows="3" placeholder="Describe the institute (optional)"></textarea>
                </div>

                <div class="form-group">
                    <label for="instituteLogo">Institute Logo</label>
                    <input type="file" class="form-control-file" id="instituteLogo" name="institute_logo">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@include('layouts.footer')

<script>
    document.getElementById('signupType').addEventListener('change', function() {
        document.getElementById('counselorFields').classList.add('hidden');
        document.getElementById('instituteFields').classList.add('hidden');

        if (this.value === 'counselor') {
            document.getElementById('counselorFields').classList.remove('hidden');
        } else if (this.value === 'institute') {
            document.getElementById('instituteFields').classList.remove('hidden');
        }
    });

    function updateCharacterCount(inputId, countId) {
        var inputElement = document.getElementById(inputId);
        var countElement = document.getElementById(countId);
        countElement.textContent = inputElement.value.length + '/36';
    }

    function togglePasswordVisibility(passwordId) {
        var passwordField = document.getElementById(passwordId);
        passwordField.type = (passwordField.type === 'password') ? 'text' : 'password';
    }
</script>
</body>
</html>
