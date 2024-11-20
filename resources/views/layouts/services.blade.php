@push('title')
<title>Empowermental || Services</title>
@endpush
@include('layouts.navbar')
    <!-- 1-on-1 Counseling Section -->
    <section class="sec-full-len" id="1on1">
        <div class="row align-items-center h-100">
            <div class="col-md-6 text-center">
                <h2 class="h2">1-on-1 Counseling</h2>
                <p style="padding:10px">EmpowerMental offers personalized 1-on-1 counseling sessions where students can engage with licensed therapists in a confidential environment. These sessions are tailored to address individual concerns, providing students with the tools and support needed to navigate their mental health journey.</p>
                  <a href="#workshops"><button class="btn btn-primary">Workshops</button></a>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('/images/1on1counselling.jpg') }}" loading="lazy"  alt="1-on-1 Counseling" class="img-fluid">
            </div>
        </div>
    </section>

    <!-- Group Counseling Section
    <section class="sec-full-len" id="group">
        <div class="row align-items-center h-100">
            <div class="col-md-6 order-md-2 text-center">
                <h2 class="h2">Group Counseling</h2>
                <p style="padding:10px">Our Group Counseling sessions foster a supportive community where students can connect with peers facing similar challenges. Guided by professional therapists, these sessions encourage open dialogue and mutual understanding, promoting a collective approach to mental wellness.</p>
                <a href="#workshops"><button class="btn btn-primary">Workshops</button></a>
            </div>
            <div class="col-md-6 order-md-1 text-center">
                <img src="{{ asset('/images/groupcounselling.jpg') }}" alt="Group Counseling" class="img-fluid">
            </div>
        </div>
    </section> -->

    <!-- Workshops Section -->
    <section class="sec-full-len" id="workshops">
        <div class="row align-items-center h-100">
            <div class="col-md-6 text-center">
                <h2 class="h2">Workshops</h2>
                <p style="padding:10px">Our Workshops are designed to address specific mental health topics and challenges. These interactive sessions, led by experts, provide students with practical tools and strategies to enhance their mental well-being. Workshops can be customized to meet the unique needs of different institutions.</p>
                <a href="#special"><button class="btn btn-primary">Special Programs</button></a>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ asset('/images/workshop.jpg') }}" loading="lazy"  alt="Workshops" class="img-fluid">
            </div>
        </div>
    </section>

    <!-- Special Programs Section -->
    <section class="sec-full-len" id="special">
        <div class="row align-items-center h-100">
            <div class="col-md-6 order-md-2 text-center">
                <h2 class="h2">Special Programs</h2>
                <p style="padding:10px">Our Special Programs are designed to provide free therapy and counseling to individuals in need. At EmpowerMental, we are committed to supporting those who may not have access to mental health care, ensuring that everyone has the opportunity to receive the help they deserve. Additionally, a portion of our profits is dedicated to funding counseling services for those in need.</p>
                <a href="#1on1"><button class="btn btn-primary">Back To top</button></a>
            </div>
            <div class="col-md-6 order-md-1 text-center">
                <img src="{{ asset('/images/special.jpg') }}" loading="lazy"  alt="Special Programs" class="img-fluid">
            </div>
        </div>
    </section>
@include('layouts.footer')
</body>

</html>