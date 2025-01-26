    <!-- Footer -->
    <footer class="footer bg-dark text-white">
        <div class="container py-4">
            <div class="row">
                <!-- Logo and About Section -->
                <div class="col-md-4 text-center text-md-left">
                    <img src="{{ asset('/images/logo.png') }}" alt="EmpowerMental Logo" class="img-fluid mb-2" style="max-width: 150px;">
                    <p>EmpowerMental is dedicated to bridging the gap between educational institutions and mental health professionals. Our mission is to provide accessible and high-quality mental health support to students everywhere.</p>
                </div>
                <!-- Quick Links -->
                <div class="col-md-4 text-center text-md-left">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{route('how-it-works')}}" class="text-white">How It Works</a></li>
                        <li><a href="{{route('services')}}" class="text-white">Services</a></li>
                        <li><a href="{{route('subscription-plans')}}" class="text-white">Subscription Plans</a></li>
                        <li><a href="{{route('contact-us')}}" class="text-white">Contact Us</a></li>
                    </ul>
                </div>
                <!-- Contact Information -->
                <div class="col-md-4 text-center text-md-left">
                    <h5>Contact Us</h5>
                    <p>Email: <a href="mailto:support@empowermental.com" class="text-white">support@empowermental.com</a></p>
                    <p>Phone: +91-12345-67890</p>
                    <p>Address: 123, EmpowerMental Street, Mumbai, Maharashtra, India</p>
                    <!-- Social Media Links -->
                    <div class="social-icons">
                        <a href="#" class="text-white mr-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white mr-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white mr-3"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <!-- Footer Bottom -->
            <div class="row mt-4">
                <div class="col text-center">
                    <p class="mb-0">&copy; 2024 EmpowerMental. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- FontAwesome Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        function toggleFAQ(element) {
            // Get all FAQ contents
            const allContents = document.querySelectorAll('.faq-content');

            // Close all other FAQ contents
            allContents.forEach(content => {
                if (content !== element.querySelector('.faq-content')) {
                    content.style.display = 'none';
                }
            });

            // Toggle the clicked FAQ content
            const content = element.querySelector('.faq-content');
            content.style.display = content.style.display === 'block' ? 'none' : 'block';
        }
    </script>
    </script>
    <script>
        const signupType = document.getElementById('signupType');
        const counselorFields = document.getElementById('counselorFields');
        const instituteFields = document.getElementById('instituteFields');
        const bgFullscreen = document.getElementById('bg-fullscreen');

        signupType.addEventListener('change', function() {
            if (signupType.value === 'counselor' || signupType.value === 'institute') {
                counselorFields.classList.add('hidden');
                instituteFields.classList.add('hidden');
                document.getElementById(`${signupType.value}Fields`).classList.remove('hidden');
                bgFullscreen.style.height = "auto";
            } else {
                counselorFields.classList.add('hidden');
                instituteFields.classList.add('hidden');
                bgFullscreen.style.height = "100vh";
            }
        });

        // Initial display state
        counselorFields.classList.add('hidden');
        instituteFields.classList.add('hidden');
        bgFullscreen.style.height = "100vh";
    </script>

    <!-- Include JavaScript files for chart and calendar functionality -->
    <script>
        var ctx = document.getElementById('reportChart').getContext('2d');
        var reportChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Sessions Used', 'Sessions Remaining', 'Therapists Available', 'Attendance'],
                datasets: [{
                    label: 'Report Analytics',
                    data: [10, 0, 0, 9], // Updated data values for sessions used, sessions remaining, therapists, and attendance
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(13, 12, 255, 0.6)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(13, 12, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        // Calendar and Appointment Script
        const augustBookedDates = [5, 10, 15, 20, 25]; // Dates in August that have booked appointments
        const septemberBookedDates = [1, 10, 15]; // Dates in September that have booked appointments
        let selectedDate = null;

        function createCalendar() {
            const calendarElement = document.getElementById('calendar');
            const currentMonthDays = [...Array(31).keys()].map(i => i + 1); // August: 31 days

            // August Calendar
            currentMonthDays.forEach(day => {
                const dayElement = document.createElement('div');
                dayElement.classList.add('day');
                dayElement.innerText = `Aug ${day}`;
                if (augustBookedDates.includes(day)) {
                    dayElement.classList.add('appointment-booked');
                }
                dayElement.addEventListener('click', () => selectDate(dayElement, `August ${day}`));
                calendarElement.appendChild(dayElement);
            });

            // September Calendar
            const septemberDays = [...Array(30).keys()].map(i => i + 1); // September: 30 days
            septemberDays.forEach(day => {
                const dayElement = document.createElement('div');
                dayElement.classList.add('day');
                dayElement.innerText = `Sep ${day}`;
                if (septemberBookedDates.includes(day)) {
                    dayElement.classList.add('appointment-booked');
                }
                dayElement.addEventListener('click', () => selectDate(dayElement, `September ${day}`));
                calendarElement.appendChild(dayElement);
            });
        }

        function selectDate(dayElement, date) {
            const previouslySelected = document.querySelector('.day.selected');
            if (previouslySelected) {
                previouslySelected.classList.remove('selected');
            }
            dayElement.classList.add('selected');
            selectedDate = date;

            // Show Book Appointment button only if the date is not booked
            const isBooked = dayElement.classList.contains('appointment-booked');
            const bookAppointmentBtn = document.getElementById('bookAppointmentBtn');
            bookAppointmentBtn.style.display = isBooked ? 'none' : 'block';
            if (!isBooked) {
                bookAppointmentBtn.onclick = function() {
                    alert(`Appointment booked for ${selectedDate}`);
                };
            }
        }

        createCalendar();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const signupType = document.getElementById('signupType');
            const counselorFields = document.getElementById('counselorFields');
            const instituteFields = document.getElementById('instituteFields');
            const bgFullscreen = document.getElementById('bg-fullscreen');

            signupType.addEventListener('change', function() {
                if (signupType.value === 'counselor') {
                    counselorFields.classList.remove('hidden');
                    instituteFields.classList.add('hidden');
                    toggleRequiredFields(counselorFields, true);
                    toggleRequiredFields(instituteFields, false);
                } else if (signupType.value === 'institute') {
                    counselorFields.classList.add('hidden');
                    instituteFields.classList.remove('hidden');
                    toggleRequiredFields(counselorFields, false);
                    toggleRequiredFields(instituteFields, true);
                } else {
                    counselorFields.classList.add('hidden');
                    instituteFields.classList.add('hidden');
                    toggleRequiredFields(counselorFields, false);
                    toggleRequiredFields(instituteFields, false);
                }
                bgFullscreen.style.height = 'auto'; // Adjust background height dynamically
            });

            function toggleRequiredFields(container, required) {
                const inputs = container.querySelectorAll('input, select, textarea');
                inputs.forEach(input => input.required = required);
            }

            // Initial setup
            toggleRequiredFields(counselorFields, false);
            toggleRequiredFields(instituteFields, false);
        });
    </script>
    <script>
        document.getElementById('signupType').addEventListener('change', function() {
            const form = document.getElementById('signupFormm');
            const selectedType = this.value;

            if (selectedType === 'institute') {
                form.action = "{{ route('signup.institute') }}";
                console.log("Form action set to institute signup");
            } else if (selectedType === 'counselor') {
                form.action = "{{ route('signup.counselor') }}";
                console.log("Form action set to counselor signup");
            }
        });
    </script>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            // Select all images on the page
            const images = document.querySelectorAll('img');

            // Loop through each image and add the lazy load attribute
            images.forEach(function(image) {
                image.setAttribute('loading', 'lazy');
            });
        });
    </script>



    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
