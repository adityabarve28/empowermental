@push('title')
<title>Empowermental || {{$blog->title}} Blog</title>
@endpush
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