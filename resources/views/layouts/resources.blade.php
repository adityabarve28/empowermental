<body class="body-resources">

@push('title')
<title>Empowermental || Resources</title>
@endpush
@include('layouts.navbar')

    <div class="container-resources">
        <h1 class="h1">Resources</h1>
        <p>Explore our curated resources designed to support your mental health journey. These resources include articles, videos, and guides that you can access anytime to help you manage stress, anxiety, and other mental health challenges.</p>

        <div class="resource-section">
            <h3>Articles</h3>
            <ul class="resource-list">
                <li><a href="article1.php" target="_blank">Managing Stress During Exams</a></li>
                <li><a href="article2.php" target="_blank">5 Tips for Better Mental Health</a></li>
                <li><a href="article3.php" target="_blank">How to Practice Mindfulness</a></li>
            </ul>
        </div>

        <div class="resource-section">
            <h3>Videos</h3>
            <ul class="resource-list">
                <li><a href="video1.php" target="_blank">Introduction to Meditation</a></li>
                <li><a href="video2.php" target="_blank">Dealing with Anxiety in College</a></li>
                <li><a href="video3.php" target="_blank">Time Management Strategies</a></li>
            </ul>
        </div>

        <div class="resource-section">
            <h3>Guides</h3>
            <ul class="resource-list">
                <li><a href="guide1.php" target="_blank">Step-by-Step Guide to Self-Care</a></li>
                <li><a href="guide2.php" target="_blank">Creating a Healthy Study Routine</a></li>
                <li><a href="guide3.php" target="_blank">Building Confidence and Reducing Stress</a></li>
            </ul>
        </div>
    </div>

@include('layouts.footer')
</body>