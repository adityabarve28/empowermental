@push('title')
<title>Empowermental || Testimonials</title>
@endpush
@include('layouts.navbar')
<section class="sec-testimonials sec-full-len-vab" id="sec-testimonials">
    <div class="container" style="height:100vh;">
        <h2>Testimonials</h2>
        <div class="row">
            @forelse($feedbacks as $feedback)
            <div class="col-md-4" style="padding:10px">
                <div class="card" style="height: 100%;">
                    <div class="card-body">
                        <!-- Role as the title -->
                        <h5 class="card-title">{{ $feedback->users->role }}</h5>

                        <!-- Feedback message as content -->
                        <p class="card-text">{{ $feedback->feedback }}</p>

                        <!-- Written By section -->
                        <p class="card-text">Written By: {{ $feedback->users->name }}</p>
                    </div>
                </div>
            </div>
            @empty
            <p>No feedback available.</p>
            @endforelse
        </div>
    </div>
</section>
@include('layouts.footer')