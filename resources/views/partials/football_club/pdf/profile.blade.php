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
            background-color: #f0f0f0;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .profile-header {
            text-align: center;
            margin-bottom: 10px;
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
            color: #f0f0f0;
        }
        
        .profile-header p {
            margin: 4px 0;
            color: #f0f0f0;
        }
        
        .profile-info {
            border-top: 1px solid #f0f0f0;
            padding-top: 10px;
        }
        
        .profile-info h2 {
            margin-top: 0;
            color: #f0f0f0;
        }
        
        .profile-info p {
            margin: 5px 0;
            color: #f0f0f0;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
   
    <div class="container">
        <div>
            <img src="{{ public_path('logo/pdf_header.png') }}" alt="" srcset="">
        </div>
        <div style="text-align: center"><h3>Club Profile</h3></div>
        <div class="profile-header">
            <img src="{{ 
                public_path('images/'.$club->photo) }}" alt="Profile Picture">
            <h2>{{$club->name ?? ''}}</h2>
            <h2>{{$club->email ?? ''}}</h2>
           
            
        </div>
        <div>
            <h4>Personal Information</h4>
            <p><strong>Phone:</strong> {{ $club->football_club->phone ?? '' }}</p>
            <p><strong>Contact:</strong> {{ $club->football_club->contact ?? '' }}</p>
            <p><strong>Address:</strong> {{ $club->football_club->address ?? '' }}</p>
            <p><strong>Country:</strong> {{ $club->football_club->country ?? '' }}</p>
            <p><strong>Website:</strong> {{ $club->football_club->website ?? '' }}</p>
            <p><strong>Payment:</strong> {{ $club->football_club->payment ?? '' }}</p>
        </div>
       
        <div>
            <img src="{{ public_path('logo/footer.png') }}" alt="" srcset="">
        </div>
    </div>
</body>
</html>
