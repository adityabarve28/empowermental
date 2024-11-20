@push('title')
<title>Empowermental || All Blogs</title>
@endpush
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
