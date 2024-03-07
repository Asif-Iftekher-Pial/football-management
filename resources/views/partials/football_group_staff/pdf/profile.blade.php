<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .profile-header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .profile-header img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        
        .profile-header h1 {
            margin: 0;
            color: #333;
        }
        
        .profile-header p {
            margin: 5px 0;
            color: #666;
        }
        
        .profile-info {
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        
        .profile-info h2 {
            margin-top: 0;
            color: #333;
        }
        
        .profile-info p {
            margin: 5px 0;
            color: #666;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container profile-info">
        <div style="text-align: center"><h1>Football Group Staff Profile</h1></div>
        <div class="profile-header">
            <img src="{{ public_path('images/'.$football_group->user->photo) }}" alt="Profile Picture">
            <h2>{{$football_group->name ?? ''}}</h2>
        </div>
        <div class="profile-info">
            <h2>Football Group Staff Information</h2>
            <p><strong>Name:</strong> {{ $football_group->name ?? '' }}</p>
            <p><strong>Address:</strong> {{ $football_group->address ?? '' }}</p>
            <p><strong>Country:</strong> {{ $football_group->country ?? '' }}</p>
            <p><strong>Telephone:</strong> {{ $football_group->telephone ?? '' }}</p>
            <p><strong>Contact:</strong> {{ $football_group->contact ?? '' }}</p>
            <p><strong>Website:</strong> {{ $football_group->website ?? '' }}</p>
            <p><strong>Status:</strong> {{ $football_group->status ?? '' }}</p>
            <p><strong>Payment Status:</strong> {{ $football_group->payment_status ?? '' }}</p>
        </div>
       
    </div>
</body>
</html>
