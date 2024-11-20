@push('title-cons-dash')
<title>Empowermental || Add Feedback</title>
@endpush
@include('layouts.dashboard.counselor.counselor-dash-nav')

<body class="body-dashboard">
    <div class="container-dashboard">
        <div class="feedback-section section">
            <h2>Submit Your Feedback</h2>

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

            <!-- Feedback form -->
            <form action="{{ route('feedback-store') }}" method="POST">
                @csrf

                <!-- Select Institute or Platform -->
                <div class="form-group">
                    <label for="to_name">Feedback To <span class="text-danger">*</span></label>
                    <select id="to_name" name="to_id" class="form-control" required onchange="updateInstituteName()">
                        <option value="" disabled selected>Select a recipient</option>
                        @foreach($institutes as $institute)
                            <option value="{{ $institute->id }}">{{ $institute->institute_name }}</option>
                        @endforeach
                        <option value="0">Platform</option> <!-- Platform has ID 0 -->
                    </select>
                </div>

                <!-- Hidden Institute Name (for clarity in storage) -->
                <input type="hidden" name="to_name" id="to_name_hidden">

                <!-- Feedback field -->
                <div class="form-group">
                    <label for="feedback">Your Feedback <span class="text-danger">*</span></label>
                    <textarea name="feedback" id="feedback" class="form-control" rows="5" maxlength="1000" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
        </div>
    </div>

    <script>
        function updateInstituteName() {
            const select = document.getElementById('to_name');
            const selectedOption = select.options[select.selectedIndex];
            const toNameInput = document.getElementById('to_name_hidden');

            if (selectedOption.value === '0') {
                toNameInput.value = 'Platform';
            } else {
                toNameInput.value = selectedOption.text;
            }
        }
    </script>
</body>

@include('layouts.footer')
