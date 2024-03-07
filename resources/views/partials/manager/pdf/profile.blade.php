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
   

    {{-- Auth user --}}
    <div class="container">
        <div>
            <img src="{{ public_path('logo/pdf_header.png') }}" alt="" srcset="">
        </div>
        <div style="text-align: center"><h3>Manager Profile</h3></div>
        <div class="profile-header">
            <img src="{{ 
                public_path('images/'.$manager->photo) }}" alt="Profile Picture">
            <h2>{{$manager->name ?? ''}}</h2>
           
            
        </div>
        <div>
            <h4>Personal Information</h4>
            <p><strong>Age:</strong> {{ $manager->manager->age ?? '' }}</p>
            <p><strong>Date of Birth:</strong> {{ $manager->manager->dob ?? '' }}</p>
            <p><strong>Nationality:</strong> {{ $manager->manager->nationality ?? '' }}</p>
        </div>
        <div>
            <h4>Career Information</h4>
            <p><strong>Football Club Manage:</strong> {{ $manager->manager->football_club_manage ?? '' }}</p>
            <p><strong>Coaching badges:</strong> {{ $manager->manager->coaching_badges ?? '' }}</p>
            <p><strong>Qualification:</strong> {{ $manager->manager->qualification ?? '' }}</p>
            <p><strong>Honours:</strong> {{ $manager->manager->honours ?? '' }}</p>
            <p><strong>International team managed:</strong> {{ $manager->manager->international_team_managed ?? '' }}</p>
        </div>
        {{-- <div class="profile-info">
            <h4>Medical Information</h4>
            <p><strong>Blood Type:</strong> {{ $manager->manager->medical_info->blood_type ?? '' }}</p>
            <p><strong>Allergies:</strong> {{ $manager->manager->medical_info->allergies ?? '' }}</p>
            <p><strong>Previous Injuries:</strong> {{ $manager->manager->medical_info->previous_injuries ?? '' }}</p>
            <p><strong>About manager:</strong> {{ $manager->manager->medical_info->about_manager ?? '' }}</p>
        </div> --}}
        <div>
            <img src="{{ public_path('logo/footer.png') }}" alt="" srcset="">
        </div>
    </div>


</body>
</html>
