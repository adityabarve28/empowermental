@push('title-ins-dash')
<title>Empowermental || {{$student->name}}</title>
@endpush
@include('layouts.dashboard.institute.institute-dashboard-nav')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<body class="body-dashboard">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card container-dashboard">
                    <div class="card-header bg-primary text-white">
                        <h3>Edit Student: {{ $student->name }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('student.update', $student->id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $student->name }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $student->email }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ $student->phone }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control" name="dob" value="{{ $student->dob }}" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="year_of_study">Year of Study</label>
                                <input type="text" class="form-control" name="year_of_study" value="{{ $student->year_of_study }}" required>
                            </div>
                            <div class="form-check mb-4">
                                <input type="checkbox" class="form-check-input" id="is_account_manager" name="is_account_manager" value="1" {{ $student->is_account_manager ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_account_manager">Add as Account Manager</label>
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('view-student') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('layouts.footer')