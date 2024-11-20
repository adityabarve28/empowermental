@push('title-ins-dash')
<title>Empowermental || {{$student->name}}</title>
@endpush
@include('layouts.dashboard.institute.institute-dashboard-nav')

<body class="body-dashboard">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Bootstrap Card -->
                <div class="card container-dashboard">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Student Details: {{ $student->name }}</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Email:</strong> {{ $student->email }}
                            </li>
                            <li class="list-group-item">
                                <strong>Phone:</strong> {{ $student->phone }}
                            </li>
                            <li class="list-group-item">
                                <strong>Date of Birth:</strong> {{ $student->dob }}
                            </li>
                            <li class="list-group-item">
                                <strong>Year of Study:</strong> {{ $student->year_of_study }}
                            </li>
                            <li class="list-group-item">
                                <strong>Is Account Manager?</strong>
                                @if ($student->is_account_manager === 1)
                                <p style="color: green;">Yes</p>
                                @else
                                <p style="color: red;">No</p>
                                @endif
                            </li>

                        </ul>
                    </div>
                    <div class="card-footer text-right">
                        <a href="{{ route('view-student') }}" class="btn btn-secondary">Back to Student List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body><br>
@include('layouts.footer')