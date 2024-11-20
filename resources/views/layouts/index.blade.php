@push('title')
<title>Empowermental</title>
@endpush

<head>
    <link rel="icon" href="{{ asset('/images/logo.png') }}" type="image/x-icon">
</head>
<!-- Development Alert -->
<div class="alert alert-warning fade show text-center" role="alert" style="margin-bottom: 0;">
    <strong>Notice:</strong> This website is currently under development. Some features may not be available.

</div>
<section class="sec-full-len">
    <div class="container">
        <img loading="lazy"  src="{{ asset('/images/logo.png') }}" alt="Empower Mental Logo" style="height: 250px;">
        <p>Our goal at EmpowerMental is to create a safe space where students can talk to qualified professionals
            about their mental health concerns without any hesitation or judgment. We believe that everyone deserves
            access to quality mental health support, regardless of their financial or social status and mental
            health is a fundamental aspect of a person's overall well-being and should not be overlooked or ignored.
            Therefore, our team at EmpowerMental strives to make mental health support accessible, convenient, and
            affordable for students</p>
        <a href="#aboutus" class="btn btn-primary">Learn More</a>
    </div>
</section>
@include('layouts.navbar')
<section class="sec-about sec-full-len" id="aboutus">
    <div class="container position-relative">
        <h1 class="abouttxt">About EmpowerMental</h1>
        <div id="aboutCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#aboutCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#aboutCarousel" data-slide-to="1"></li>
                <li data-target="#aboutCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Carousel Items -->
            <div class="carousel-inner">
                <!-- First Slide -->
                <div class="carousel-item active">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <p class="abouttext">Our goal at EmpowerMental is to create a safe space where students
                                can talk
                                to qualified professionals about their mental health concerns without any hesitation
                                or judgment.
                                We believe that everyone deserves access to quality mental health support,
                                regardless of their
                                financial or social status. Mental health is a fundamental aspect of a person's
                                overall well-being
                                and should not be overlooked or ignored. Therefore, our team at EmpowerMental
                                strives to make
                                mental health support accessible, convenient, and affordable for students.
                            </p>
                        </div>
                        <div class="col-md-4">
                            <img class="slider-image" loading="lazy" src="{{ asset('/images/sliderimg1.jpg') }}" alt="">
                        </div>
                    </div>
                </div>

                <!-- Second Slide -->
                <div class="carousel-item">
                    <div class="row align-items-center">
                        <div class="col-md-4 order-md-1">
                            <img class="slider-image" loading="lazy" src="{{ asset('/images/sliderimg2.jpg') }}" alt="">
                        </div>
                        <div class="col-md-8 order-md-2">
                            <p class="abouttext">
                                Mental health is a crucial aspect of our overall wellbeing, yet it is often
                                neglected and
                                stigmatized. With EmpowerMental, we aim to break down these barriers and make mental
                                health
                                support available to everyone. EmpowerMental is committed to providing a safe and
                                inclusive space
                                where students can seek help, support, and guidance without fear of judgment or
                                discrimination.
                                Our goal is to empower individuals and communities to take charge of their mental
                                health and
                                achieve their full potential.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Third Slide -->
                <div class="carousel-item">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <p class="abouttext">
                                EmpowerMental is an innovative subscription-based website that serves as a solution
                                to help
                                educational institutions provide direct and free counselling/therapy to their
                                students. With
                                EmpowerMental, institutes can register and pay subscription fees, and we will
                                arrange counselling
                                and therapy sessions in the institute itself. The main benefit of this is that
                                students can use
                                our service for free as the institute will pay for the fees of our subscription. Our
                                platform
                                connects institutions with qualified therapists who offer a range of mental health
                                services,
                                including one-on-one counselling, group therapy, and workshops.
                            </p>
                        </div>
                        <div class="col-md-4">
                            <img class="slider-image" loading="lazy" src="{{ asset('/images/sliderimg4.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#aboutCarousel" role="button" data-slide="prev"
                style="position: absolute; top: 50%; transform: translateX(-70%); left: 0;">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#aboutCarousel" role="button" data-slide="next"
                style="position: absolute; top: 50%; transform: translateX(50%); right: 0;">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>
<section class="sec-blog sec-full-len" id="sec-blog">
    <div class="container">
        <div class="row">
            @forelse($blogs as $blog)
            <div class="col-md-4" style=" padding:10px">
                <div class="card" style="height: 100%">
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

            <!-- View More Blogs Button -->
            <div class="col-md-4">
                <div class="card" style="height: 100%;">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <a href="{{ route('blogs.all') }}" class="btn btn-primary">View More Blogs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="sec-faqs sec-full-len" id="faqs">
    <div class="container">
        <h1>Frequently Asked Questions</h1>

        <div class="faq-grid">

            <div class="faq-section" onclick="toggleFAQ(this)">
                <h5>What is the purpose of this platform?</h5>
                <div class="faq-content">
                    Our platform connects counselors and educational institutes with individuals seeking guidance. Whether you are a student, parent, or professional, you can find expert advice tailored to your needs.
                </div>
            </div>

            <div class="faq-section" onclick="toggleFAQ(this)">
                <h5>How do I create an account?</h5>
                <div class="faq-content">
                    You can sign up as either a counselor or an institute by selecting the appropriate option on our registration page and filling out the required details.
                </div>
            </div>

            <div class="faq-section" onclick="toggleFAQ(this)">
                <h5>Is the platform free to use?</h5>
                <div class="faq-content">
                    Basic access to our platform is free. However, premium services provided by counselors or institutes may have associated costs.
                </div>
            </div>

            <div class="faq-section" onclick="toggleFAQ(this)">
                <h5>How do I register as a counselor?</h5>
                <div class="faq-content">
                    Go to the signup page, select “Counselor” from the dropdown menu, and fill in your details, including your qualifications and experience.
                </div>
            </div>

            <div class="faq-section" onclick="toggleFAQ(this)">
                <h5>How do I sign up as an institute?</h5>
                <div class="faq-content">
                    On the signup page, select “Institute” and fill out the registration form with your institute’s details, including registration number, address, and contact information.
                </div>
            </div>

            <div class="faq-section" onclick="toggleFAQ(this)">
                <h5>I forgot my password. How can I reset it?</h5>
                <div class="faq-content">
                    Click on the “Forgot Password” link on the login page, enter your registered email address, and follow the instructions to reset your password.
                </div>
            </div>

            <div class="faq-section" onclick="toggleFAQ(this)">
                <h5>How do I contact support for further assistance?</h5>
                <div class="faq-content">
                    If you need more help, you can reach out to our support team via the contact form on the “Contact Us” page or email us directly at support@example.com.
                </div>
            </div>

            <div class="faq-section" onclick="toggleFAQ(this)">
                <h5>Can I update my profile information?</h5>
                <div class="faq-content">
                    Yes, you can update your profile information anytime by logging into your account and navigating to the "Profile" section.
                </div>
            </div>

            <div class="faq-section" onclick="toggleFAQ(this)">
                <h5>What if I encounter issues using the platform?</h5>
                <div class="faq-content">
                    Please reach out to our support team, and we will assist you in resolving any issues as quickly as possible.
                </div>
            </div>

        </div>
    </div>
</section>
<!-- <section class="sec-full-len sec-contactus" id="contactus">
       
        <div class="containerr">
        <h1>Contact Us</h1>
        <div id="globe"></div>
        <div class="info">
            <p><strong>Email:</strong> sample.email@example.com</p>
            <p><strong>Phone:</strong> +91 12345 67890</p>
        </div>
    </div>
    </section> -->
@include('layouts.footer')