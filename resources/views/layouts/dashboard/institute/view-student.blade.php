@push('title-ins-dash')
<title>Empowermental || View Students</title>
@endpush
@include('layouts.dashboard.institute.institute-dashboard-nav')


<body class="body-dashboard">
    <div class="container-dashboard">
        <!-- Student Management Section -->
        <div class="student-section section" id="student">
            <h2 class="h2">Student Management</h2>
            <p>View and manage registered students who are utilizing the mental health services.</p>

            <!-- Student Table -->
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Student ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Enrolled Date</th>
                        <!-- <th scope="col">Password</th> -->
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <th scope="row">{{ $student->id }}</th>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone }}</td>
                            <td>{{ $student->created_at->format('d M Y') }}</td>
                            <!-- <td>{{ $student->decryptedPassword }}</td> Decrypted password here -->
                            <td>
                                <!-- View Details Button -->
                                <a href="{{ route('student.view', $student->id) }}" class="btn btn-primary btn-sm mb-1">View Details</a>
                                
                                <!-- Edit Button -->
                                <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('student.delete', $student->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@include('layouts.footer')
</body>
