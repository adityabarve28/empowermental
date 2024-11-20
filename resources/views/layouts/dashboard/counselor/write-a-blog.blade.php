@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@push('title-cons-dash')
<title>Empowermental || Write a Blog</title>
@endpush

<body class="body-dashboard">
    @include('layouts.dashboard.counselor.counselor-dash-nav')
    <!-- Success message after login -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @auth
    @if (Auth::user()->role === 'counselor')
    <div class="container-dashboard">
        <div class="welcome-section section">
            <h2>Write a New Blog</h2>
        </div>
        <!-- Blog Form -->
        <form action="{{route('blogs.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Blog Title <span class="text-danger">*</span></label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subtitle">Sub Title (Optional)</label>
                <input type="text" name="sub_title" id="subtitle" class="form-control">
            </div>
            <div class="form-group">
                <label for="content">Content (3000 characters max) <span class="text-danger">*</span></label>
                <textarea name="content" id="content" class="form-control" rows="8" maxlength="3000" required></textarea>
                <div class="char-count">Characters: <span id="charCount">0</span>/3000</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    @include('layouts.footer')
    @else
    <script>
        alert('Login To Continue');
        window.location.href = "{{ route('login') }}";
    </script>
    @endif
    @endauth

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // Character Count Tracker
        $('#content').on('input', function() {
            const charCount = this.value.length;
            $('#charCount').text(charCount);

            if (charCount > 3000) {
                alert('You have exceeded the 3000-character limit!');
                this.value = this.value.slice(0, 3000);
            }
        });
    </script>
</body>
