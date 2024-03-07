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
        <div style="text-align: center"><h3>Football Job's Profile</h3></div>
        <div class="profile-header">
            <img src="{{ 
                public_path('images/'.$football_job->user->photo) }}" alt="Profile Picture">
            <h2>{{$football_job->name ?? ''}}</h2>
             
            <h2>
                @if ( auth()->user()->hasAllRoles($collectionOfRoles))
                <strong>Email: </strong>{{$football_job->user->email ?? ''}}</h2>
                @else
                @endif
            <h2>
                @if ( auth()->user()->hasAllRoles($collectionOfRoles))
                <strong>Phone:</strong>{{$football_job->phone ?? ''}}
                @else
                @endif
               
            </h2>
            <h2>
                @if ( auth()->user()->hasAllRoles($collectionOfRoles))
                <strong>Address:</strong>{{$football_job->address ?? ''}}</h2>
                @else
                @endif
        </div>
        <div>
            <h4>Personal Information</h4>
            <p><strong>Date of Birth:</strong> {{ $football_job->dob ?? '' }}</p>
            <p><strong>Position:</strong> {{ $football_job->position ?? '' }}</p>
            <p><strong>Experience:</strong> {{ $football_job->experience ?? '' }}</p>
            <p><strong>About:</strong> {{ $football_job->about_you ?? '' }}</p>
        </div>
        <div>
            <img src="{{ public_path('logo/footer.png') }}" alt="" srcset="">
        </div>
    </div>
</body>
</html>
