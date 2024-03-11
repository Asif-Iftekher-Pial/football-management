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
    <a href="http://www.google.com" target="_blank" class="btn-success">Make Payment</a> 
</body>
</html>