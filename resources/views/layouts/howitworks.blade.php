@push('title')
<title>Empowermental || How It Works</title>
@endpush
@include('layouts.navbar')

<body class="body-hiw">



    <div class="container-hiw">
        <h1 class="h1">How It Works</h1>
        <p>EmpowerMental is a cutting-edge platform designed to bridge the gap between educational institutions and mental
            health professionals. Our subscription-based model allows institutions to provide direct and free counseling
            and therapy services to their students. By subscribing to EmpowerMental, institutions can ensure that their
            students have access to high-quality mental health support without any additional cost to the students
            themselves.</p>

        <div class="step">
            <h3>Step 1: Institution Registration</h3>
            <p>Institutions interested in offering mental health services through EmpowerMental must first sign up on our
                platform. The registration process is simple and user-friendly. After registration, institutions can
                choose a subscription plan that best suits their needs—Basic, Standard, or Premium. Once the institution
                selects a plan, they can proceed to payment. EmpowerMental offers flexible payment options, including
                discounts for bulk subscriptions.</p>
        </div>

        <div class="step">
            <h3>Step 2: Therapist Matching</h3>
            <p>EmpowerMental partners with licensed and experienced therapists who specialize in various mental health
                services. Based on the chosen plan, the institution will be matched with the therapists. These
                therapists will be responsible for conducting sessions with the students. Institutions can coordinate
                with the assigned therapists to schedule sessions that fit the academic calendar and student needs.
                EmpowerMental’s platform allows for flexible scheduling to accommodate in-person sessions.</p>
        </div>

        <div class="step">
            <h3>Step 3: Student Access</h3>
            <p>Once the institution is subscribed, students can begin accessing the services provided by EmpowerMental.
                The counseling and therapy sessions are entirely free for students, as the subscription fees are covered
                by the institution. Our system ensures complete confidentiality and privacy, so students can feel safe seeking
                help without fear of judgment. Depending on the subscription plan, students can avail of one-on-one
                counseling, or participate in mental health workshops led by qualified professionals.</p>
        </div>

        <div class="step">
            <h3>Step 4: Monitoring and Reporting</h3>
             <!-- Development Alert -->
             <div class="alert alert-warning fade show text-center" role="alert" style="margin-bottom: 0;">
               Need More Assistance

            </div>
            <p>EmpowerMental provides institutions with customized reports and analytics on the mental health services
                being utilized. These reports include metrics such as session attendance, student feedback, and overall
                engagement. Each subscribed institution is assigned a dedicated account manager to ensure smooth
                operation and address any issues or concerns that may arise.</p>
        </div>

        <div class="benefits">
            <h3>Benefits of Using EmpowerMental</h3>
            <ul>
                <li>Direct access to licensed therapists</li>
                <li>Free services for students</li>
                <li>Flexible scheduling</li>
                <li>Confidential platform</li>
                <li>Customized solutions</li>
                <li>Discounted subscription rates</li>
            </ul>
        </div>

        <p>For a detailed breakdown of each plan, including pricing and features, please visit our <a href="{{route('subscription-plans')}}">Subscription Plans</a> page.</p>

        <a href="{{route('subscription-plans')}}" class="btn btn-primary btn-register">View Subscription Plans</a>
    </div>
    @include('layouts.footer')
</body>