@push('title-ins-dash')
<title>Empowermental || View Reports</title>
@endpush
@include('layouts.dashboard.institute.institute-dashboard-nav')
<body>

<div class="reports-container">
    <div class="reports-header">
        <h2>View Reports</h2>
    </div>

    <table class="report-table">
        <thead>
            <tr>
                <th>Report ID</th>
                <th>Therapist Name</th>
                <th>Session Date</th>
                <th>Student Name</th>
                <th>Session Summary</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Sample PHP to fetch reports (replace with actual DB fetching logic)
            $reports = [
                ['id' => 1, 'therapist' => 'Dr. Smith', 'date' => '2024-09-14', 'student' => 'John Doe', 'summary' => 'Summary of the session', 'file' => 'report1.pdf'],
                ['id' => 2, 'therapist' => 'Dr. Jane', 'date' => '2024-09-10', 'student' => 'Jane Smith', 'summary' => 'Another session summary', 'file' => 'report2.pdf']
            ];

            foreach ($reports as $report) {
                echo "<tr>
                        <td>{$report['id']}</td>
                        <td>{$report['therapist']}</td>
                        <td>{$report['date']}</td>
                        <td>{$report['student']}</td>
                        <td>{$report['summary']}</td>
                        <td><a href='/path/to/reports/{$report['file']}' download>Download</a></td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
@include('layouts.footer')
</body>