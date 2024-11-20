@include('layouts.dashboard.counselor.counselor-dash-nav')

@push('title-cons-dash')
<title>Empowermental || Request a Return</title>
@endpush
<body class="body-dashboard">
    <div class="container-dashboard">
        <div class="section">
            <h2>Request a Return</h2>
            
            <!-- Display success message -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Return Request Form -->
            <form action="{{ route('returns-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Travel Date -->
                <div class="form-group">
                    <label for="travel_date">Travel Date <span class="text-danger">*</span></label>
                    <input type="date" name="travel_date" id="travel_date" class="form-control" required>
                </div>
                
                <!-- Travel Location -->
                <div class="form-group">
                    <label for="travel_location">Travel Location <span class="text-danger">*</span></label>
                    <input type="text" name="travel_location" id="travel_location" class="form-control" required>
                </div>
                
                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description (Optional)</label>
                    <textarea name="description" id="description" class="form-control" rows="4" maxlength="500"></textarea>
                </div>
                
                <!-- Upload Screenshots -->
                <div class="form-group">
                    <label for="screenshots">Upload Screenshots</label>
                    <input type="file" name="screenshots[]" id="screenshots" class="form-control-file" multiple>
                    <small class="form-text text-muted">You can upload multiple images (jpeg, png, jpg, gif). Max size: 2MB each.</small>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit Return Request</button>
            </form>
        </div>
    </div>
</body>
@include('layouts.footer')