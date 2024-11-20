@push('title-cons-dash')
<title>Empowermental || View Feedback</title>
@endpush

@include('layouts.dashboard.counselor.counselor-dash-nav')

<body class="body-dashboard">
    <div class="container-dashboard">
        <div class="feedback-section section">
            <h2>Received Feedback</h2>

            <!-- Display feedback in a table -->
            @if($feedbacks->isEmpty())
                <p>No feedback available.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->from_name }}</td>
                                <td>{{ $feedback->feedback }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>

@include('layouts.footer')
