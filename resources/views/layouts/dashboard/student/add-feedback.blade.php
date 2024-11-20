@push('title-stu-dash')
<title>Empowermental || Add Feedback</title>
@endpush

@include('layouts.dashboard.student.stu-dash-nav')

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

                <!-- Select Assigned Counselor or Platform -->
                <div class="form-group">
                    <label for="to_name">Feedback To</label>
                    <select name="to_id" id="to_name" class="form-control" required onchange="updateCounselorName()">
                        <option value="" disabled selected>Select a recipient</option>
                        @if($counselor)
                            <option value="{{ $counselor->id }}">{{ $counselor->full_name }}</option>
                        @endif
                        <option value="0">Platform</option> <!-- Set Platform to ID 0 -->
                    </select>
                </div>

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
        function updateCounselorName() {
            var select = document.getElementById('to_name');
            var selectedValue = select.value;
            var toNameInput = document.createElement('input');
            toNameInput.type = 'hidden';
            toNameInput.name = 'to_name';

            if (selectedValue === '0') {
                toNameInput.value = 'Platform';
            } else {
                toNameInput.value = select.options[select.selectedIndex].text;
            }

            // Remove any existing hidden input and append the new one
            var existingInput = document.querySelector('input[name="to_name"]');
            if (existingInput) {
                existingInput.remove();
            }
            select.closest('form').appendChild(toNameInput);
        }
    </script>
</body>

@include('layouts.footer')
