@push('title-admin-dash')
<title>Empowermental || Manage Subscriptions</title>
@endpush

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empowermental || Admin Dashboard</title>
    <link rel="icon" href="https://empowermental.onrender.com/images/logo.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://empowermental.onrender.com/css/dashboard-style.css">

    <script>
        function showSuccessMessage(message) {
            alert(message); // Display success alert
        }
    </script>

</head>
<body class="body-dashboard">
    @include('layouts.dashboard.admin.admin-dash-nav')

    <div class="container subscription-form container-dashboard">
        <h2>Add Subscription Plan</h2>

        @if(session('success'))
            <script>showSuccessMessage("{{ session('success') }}");</script>
        @endif

        <form action="{{ route('admin.subscription-plans.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" step="0.01" name="price" id="price" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="duration">Duration</label>
        <select name="duration" id="duration" class="form-control" required>
            <option value="once">Once</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>
    <div class="form-group">
        <label for="features">Features</label>
        <textarea name="features" id="features" class="form-control" rows="4" required></textarea>
    </div>
    <div class="form-group">
        <label for="sessions_approved">Sessions Approved</label>
        <input type="number" name="sessions_approved" id="sessions_approved" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="discount">Discount</label>
        <input type="number" step="0.01" name="discount" id="discount" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Add Subscription</button>
</form>
</div>
<div class="container subscription-form container-dashboard">
        <hr>
        <h2>Update Subscription Plan</h2>
        <div class="form-group">
            <label for="subscription_id">Select Plan</label>
            <select id="subscription_id" class="form-control">
                <option value="">-- Select a Plan --</option>
                @foreach ($plans as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                @endforeach
            </select>
        </div>

       
        <form action="{{ route('admin.subscription-plans.update') }}" method="POST" id="subscription-details">
    @csrf
    <input type="hidden" name="subscription_id" id="subscription_id_hidden">
    <div class="form-group">
        <label for="update_name">Name</label>
        <input type="text" name="update_name" id="update_name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="update_price">Price</label>
        <input type="number" step="0.01" name="update_price" id="update_price" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="update_duration">Duration</label>
        <select name="update_duration" id="update_duration" class="form-control" required>
            <option value="once">Once</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>
    <div class="form-group">
        <label for="update_features">Features</label>
        <textarea name="update_features" id="update_features" class="form-control" rows="4" required></textarea>
    </div>
    <div class="form-group">
        <label for="update_sessions_approved">Sessions Approved</label>
        <input type="number" name="update_sessions_approved" id="update_sessions_approved" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="update_discount">Discount</label>
        <input type="number" step="0.01" name="update_discount" id="update_discount" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Update Subscription</button>
</form>

    </div>

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif
    <script>
    const plans = @json($plans); // Laravel's Blade directive to get the plans data
    console.log(plans);

    // This function will populate the fields based on the selected subscription ID
    function populateFields() {
        const selectedPlanId = document.getElementById('subscription_id').value;

        // Find the subscription details based on the selected plan ID
        const subscriptionDetails = plans.find(plan => plan.id == selectedPlanId);

        if (subscriptionDetails) {
            // Show the subscription details form
            document.getElementById('subscription-details').style.display = 'block';
            document.getElementById('subscription_id_hidden').value = selectedPlanId;

            // Populate the fields with the corresponding values from the selected plan
            document.getElementById('update_name').value = subscriptionDetails.name;
            document.getElementById('update_price').value = subscriptionDetails.price;
            document.getElementById('update_duration').value = subscriptionDetails.duration;
            document.getElementById('update_features').value = subscriptionDetails.features;
            document.getElementById('update_sessions_approved').value = subscriptionDetails.sessions_approved;
            document.getElementById('update_discount').value = subscriptionDetails.discount;
        } else {
            // Hide the subscription details form if no valid plan is selected
            document.getElementById('subscription-details').style.display = 'none';
        }
    }

    // Add an event listener to trigger the function when a plan is selected
    document.getElementById('subscription_id').addEventListener('change', populateFields);
</script>

@include('layouts.footer')
</body>
</html>
