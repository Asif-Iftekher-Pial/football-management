<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Request</title>
    <style>
        /* Styles for Bootstrap-like success button */
        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            text-decoration: none; /* Remove underline */
        }

        .btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</head>
<body>
    <h4>Hello,</h4>
    <br>
    <p> {{ $user_name }} we are requesting you to pay to enjoy our premium services.</p>
    <br>
    <p>Please click on the below link to pay</p>
    {{-- <a href="http://www.google.com" target="_blank" class="btn-success">Make Payment</a>  --}}
    <div id="paypal-button-container-P-49L33337L23055829MXYFE6Y"></div>
    
    <script src="https://www.paypal.com/sdk/js?client-id=sb&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
    <script>
    paypal.Buttons({
        style: {
            shape: 'rect',
            color: 'gold',
            layout: 'vertical',
            label: 'subscribe'
        },
        createSubscription: function(data, actions) {
            return actions.subscription.create({
            /* Creates the subscription */
            plan_id: 'P-49L33337L23055829MXYFE6Y'
            });
        },
        onApprove: function(data, actions) {
            alert(data.subscriptionID); // You can add optional success message for the subscriber here
        }
    }).render('#paypal-button-container-P-49L33337L23055829MXYFE6Y'); // Renders the PayPal button
    </script>
</body>
</html>