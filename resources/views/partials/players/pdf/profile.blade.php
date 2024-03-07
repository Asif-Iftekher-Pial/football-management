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
        <div style="text-align: center"><h3>Player Profile</h3></div>
        <div class="profile-header">
            <img src="{{ 
                public_path('images/'.$player->photo) }}" alt="Profile Picture">
            <h2>{{$player->name ?? ''}}</h2>
            <h2>{{$player->player->position ?? ''}}</h2>
           
            
        </div>
        <div>
            <h4>Personal Information</h4>
            {{-- <h2><strong>Email: </strong>{{$player->email ?? ''}}</h2>
            <h2><strong>Phone:</strong>{{$player->player->phone ?? ''}}</h2>
            <h2><strong>Address:</strong>{{$player->player->address ?? ''}}</h2> --}}

            <h2><strong>Age:</strong>{{$player->player->age ?? ''}}</h2>
            <p><strong>Date of Birth:</strong> {{ $player->player->dob ?? '' }}</p>
            <p><strong>Gender:</strong> {{ $player->player->gender ?? '' }}</p>
            <p><strong>Height:</strong> {{ $player->player->height ?? '' }}</p>
            <p><strong>Weight:</strong> {{ $player->player->weight ?? '' }}</p>
            <p><strong>Favourite Foot:</strong> {{ $player->player->favourite_foot ?? '' }}</p>
            <p><strong>Nationality:</strong> {{ $player->player->nationality ?? '' }}</p>
            <p><strong>Passport Type:</strong> {{ $player->player->passport_type ?? '' }}</p>
            <p><strong>Has More Than One Passport:</strong> {{ $player->player->is_passport_more_then_one ?? '' }}</p>
        </div>
        <div >
            <h4>Career Information</h4>
            <p><strong>Current Club:</strong> {{ $player->player->current_club ?? '' }}</p>
            <p><strong>International Appearances:</strong> {{ $player->player->international_appearance ?? '' }}</p>
            <p><strong>Contract Length:</strong> {{ $player->player->contract_length ?? '' }}</p>
            <p><strong>Football Group Player:</strong> {{ $player->player->football_group_player ?? '' }}</p>
            <p><strong>Other Information:</strong> {{ $player->player->other_info ?? '' }}</p>
        </div>
        {{-- <div class="profile-info">
            <h4>Medical Information</h4>
            <p><strong>Blood Type:</strong> {{ $player->player->medical_info->blood_type ?? '' }}</p>
            <p><strong>Allergies:</strong> {{ $player->player->medical_info->allergies ?? '' }}</p>
            <p><strong>Previous Injuries:</strong> {{ $player->player->medical_info->previous_injuries ?? '' }}</p>
            <p><strong>About Player:</strong> {{ $player->player->medical_info->about_player ?? '' }}</p>
        </div> --}}
        <div>
            <img src="{{ public_path('logo/footer.png') }}" alt="" srcset="">
        </div>
    </div>


</body>
</html>
