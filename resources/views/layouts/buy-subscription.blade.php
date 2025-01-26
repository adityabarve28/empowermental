@auth
    @if (Auth::user()->role === 'institute')

@push('title-ins-dash')
<title>Empowermental || Buy Subscription</title>
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
<body>
@include('layouts.dashboard.institute.institute-dashboard-nav')
<div class="container mt-5">
    <h1>Choose Subscription Details</h1>
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
                        <button type="submit" class="btn btn-success">Buy Subscription</button>
                    </form>
</div>

<script>
    $(document).ready(function() {
        const planId = parseInt("{{ $plan->id }}");
        const planPrice = parseFloat("{{ $plan->price }}");
        const planDiscount = parseFloat("{{ $plan->discount ?? 0 }}");

        // Initialize start date
        const today = new Date().toISOString().split('T')[0];
        $('#start_date').val(today);

        // Check if the plan is a workshop
        if (planId === 1) {
            setupWorkshopPlan();
        } else {
            setupRegularPlan();
        }

        function setupWorkshopPlan() {
            // Hide the month selection for workshops
            $('#non-workshop-options').hide();

            // Calculate fixed 15-day end date for workshops
            const endDate = new Date(today);
            endDate.setDate(endDate.getDate() + 15);
            $('#end_date').val(endDate.toISOString().split('T')[0]);

            // Calculate the total price for 1 month with discount
            calculateTotalPrice(1);
        }

        function setupRegularPlan() {
            // Show the month selection for regular plans
            $('#non-workshop-options').show();

            // Calculate initial end date and total price based on selected months (default 1 month)
            updateEndDateAndTotal();

            // Update end date and total price when months are selected
            $('#months').on('change', function() {
                updateEndDateAndTotal();
            });
        }

        function updateEndDateAndTotal() {
            const selectedMonths = parseInt($('#months').val()) || 1;
            const startDate = new Date($('#start_date').val());

            // Calculate the end date based on the number of selected months
            const endDate = new Date(startDate);
            endDate.setMonth(startDate.getMonth() + selectedMonths);
            $('#end_date').val(endDate.toISOString().split('T')[0]);

            // Calculate total price with selected months
            calculateTotalPrice(selectedMonths);
        }

        function calculateTotalPrice(months) {
            const totalPrice = months * planPrice;
            const discountAmount = totalPrice * (planDiscount / 100);
            const finalPrice = totalPrice - discountAmount;

            // Update the displayed total price and hidden input value
            $('#total_price').text(finalPrice.toFixed(2));
            $('#total_price_input').val(finalPrice.toFixed(2));
        }
    });
</script>









<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
<div class="modal fade" id="choosePlanModal" tabindex="-1" role="dialog" aria-labelledby="choosePlanModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="choosePlanModalLabel">Choose Subscription Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
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

    if (planName.toLowerCase() === 'workshop') {
        $('#non-workshop-options').hide();
        var endDate = new Date();
        endDate.setDate(endDate.getDate() + 15);
        $('#end_date').val(endDate.toISOString().split('T')[0]);
        calculateTotalPrice(1, planPrice, 0); // 1 month for workshop
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

        calculateTotalPrice(selectedMonths, $('#plan_price').text(), $('#plan_discount').text());
    }
});

function calculateTotalPrice(months, pricePerMonth, discountPercent) {
    let totalPrice = months * parseFloat(pricePerMonth);
    let discountAmount = totalPrice * (parseFloat(discountPercent) / 100);
    let finalPrice = totalPrice - discountAmount;

    $('#total_price').text(finalPrice.toFixed(2));
    $('#total_price_input').val(finalPrice.toFixed(2));
}

    </script>
@else
    <script>
        alert('Login To Continue');
        window.location.href = "{{ route('login') }}";
    </script>
    @endif
    @endauth

    </body>
    </html>