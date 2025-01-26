@push('title')
<title>Empowermental || Subscription Plans</title>
@endpush

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title')
    <link rel="icon" href="https://empowermental.onrender.com/images/logo.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://empowermental.onrender.com/css/style.css"> <!-- Link to your CSS file -->
    <!-- <link rel="stylesheet" href="assets/css//loginstyle.css">
    <link rel="stylesheet" href="assets/css/signupstyle.css"> -->
    <style>
        .hidden {
            display: none;
        }

        .bg-fullscreenn {
            width: 100%;
            height: 100vh;
            /* Default height for initial load */
            /* background: url('background-image.jpg') no-repeat center center/cover; */
            position: relative;
        }

        /* .jumbotron-opaquee {
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 5px;
    } */
         /* Ensure content preview height is fixed for consistent button placement */
    /* .content-preview {
        height: 1.5em; 
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3; 
        -webkit-box-orient: vertical;
    } */
    </style>
</head>
<body class="body-plans">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @include('layouts.navbar')

    <div class="container-plans">
        <h1 class="h1-subs">Our Subscription Plans</h1>
        <div class="row">
            @foreach($plans as $plan)
            <div class="col-md-6">
                <div class="card plan-card">
                    <div class="card-header text-center">
                        <h3 style="color:#ffffff">{{ $plan->name }}</h3>
                    </div>
                    <div class="card-body text-center">
                        <h4>₹{{ number_format($plan->price, 2) }}</h4>
                        <p>{{ $plan->discount ? $plan->discount . '% discount for 3 months or more' : '' }}</p>
                        <ul>
                            @foreach(explode(',', $plan->features) as $feature)
                            <li>{{ trim($feature) }}</li>
                            @endforeach
                        </ul>
                        @auth
                        @if (Auth::user()->role === 'institute')
                        <a href="#" class="btn btn-primary btn-chplan" data-toggle="modal" data-target="#choosePlanModal"
                            data-plan-id="{{ $plan->id }}" data-plan-name="{{ $plan->name }}" data-plan-price="{{ $plan->price }}" data-plan-discount="{{ $plan->discount ?? 0 }}">
                            Choose Plan
                        </a>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @include('layouts.footer')
    <div class="modal fade" id="choosePlanModal" tabindex="-1" role="dialog" aria-labelledby="choosePlanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="choosePlanModalLabel">Choose Subscription Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Scrollable modal body -->
                <div class="modal-body modal-body-scrollable">
                    <form action="{{ route('processPayment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="plan_id" id="plan_id">
                        <input type="hidden" name="total_price" id="total_price_input">

                        <div id="non-workshop-options" class="form-group" style="display: none;">
                            <label for="months">Select Number of Months</label>
                            <select class="form-control" id="months" name="months">
                                @for($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}">{{ $i }} Month{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ date('Y-m-d') }}" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" readonly required>
                        </div>

                        <div class="billing-summary">
                            <h5>Billing Summary</h5>
                            <p>Plan: <span id="plan_name"></span></p>
                            <p>Price per Month: ₹<span id="plan_price"></span></p>
                            <p>Discount: <span id="plan_discount"></span>%</p>
                            <p>Total: ₹<span id="total_price"></span></p>
                        </div>

                        <div class="qr-image-container text-center">
                            <img src="{{ asset('/images/qr.jpeg') }}" alt="payment-QR" class="qr-image">
                        </div>

                        @auth
                        @if (Auth::user()->role === 'institute')
                        <button type="submit" class="btn btn-success mt-3">Buy Subscription</button>
                        @endif
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script>
        $('#choosePlanModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var planId = button.data('plan-id');
            var planName = button.data('plan-name');
            var planPrice = button.data('plan-price');
            var planDiscount = button.data('plan-discount');

            var modal = $(this);
            modal.find('#plan_id').val(planId);
            modal.find('#plan_name').text(planName);
            modal.find('#plan_price').text(parseFloat(planPrice).toFixed(2));
            modal.find('#plan_discount').text(planDiscount);

            // Set start date to today's date
            var today = new Date().toISOString().split('T')[0];
            $('#start_date').val(today);

            if (planId === 1) {
                $('#non-workshop-options').hide();
                var endDate = new Date();
                endDate.setDate(endDate.getDate() + 15);
                $('#end_date').val(endDate.toISOString().split('T')[0]);
                calculateTotalPrice(1, planPrice, planName); // 1 month for workshop
            } else {
                $('#non-workshop-options').show();
                $('#months').val('');
                $('#end_date').val('');
                $('#total_price').text('0.00');
                $('#total_price_input').val('0.00');
            }
        });

        // Update end date and calculate total price when months are selected
        $('#months').change(function() {
            if ($('#months').val()) {
                var selectedMonths = parseInt($('#months').val());
                var startDate = new Date($('#start_date').val());

                // Calculate end date based on the selected number of months
                var endDate = new Date(startDate);
                endDate.setMonth(startDate.getMonth() + selectedMonths);
                $('#end_date').val(endDate.toISOString().split('T')[0]);

                calculateTotalPrice(selectedMonths, $('#plan_price').text(), $('#plan_name').text());
            }
        });

        function calculateTotalPrice(months, pricePerMonth, planName) {
            let totalPrice = months * parseFloat(pricePerMonth);
            let discountAmount = 0;

            // Log for debugging
            console.log("Months:", months);
            console.log("Price per Month:", pricePerMonth);
            console.log("Total Price before Discount:", totalPrice);
            console.log("Plan Name:", planName);

            // Determine discount based on selected months and plan type
            if (planName.toLowerCase().includes('basic') && months >= 2) {
                discountAmount = totalPrice * 0.05; // 5% discount for basic plan
            } else if (planName.toLowerCase().includes('standard') && months >= 3) {
                discountAmount = totalPrice * 0.10; // 10% discount for standard plan
            } else if (planName.toLowerCase().includes('premium') && months >= 4) {
                discountAmount = totalPrice * 0.15; // 15% discount for premium plan
            }

            let finalPrice = totalPrice - discountAmount;

            // Log final prices
            console.log("Discount Amount:", discountAmount);
            console.log("Final Price:", finalPrice);

            $('#total_price').text(finalPrice.toFixed(2));
            $('#total_price_input').val(finalPrice.toFixed(2));
        }
    </script>

</body>
</html>