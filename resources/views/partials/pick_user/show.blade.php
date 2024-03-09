@extends('master.master')
@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-header">
            <i class="fa fa-user"></i>
            <strong class="card-title mb-3">Player Profile</strong>
            <a href="{{ route('player.detail.export.pdf',$player->id) }}" class="btn btn btn-success pull-right"><i class="fa fa-print" aria-hidden="true"></i></a>
        </div>
        <div class="card-body">
            <div class="mx-auto d-block">
                @if ($player->user->photo)
                <img class="rounded-circle mx-auto d-block" src="{{ asset('images/' . $player->user->photo) }}" alt="Photo" width="100px">
                @else
                No Photo
                @endif
                <h5 class="text-sm-center mt-2 mb-1">Name: {{ $player->name }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Email: 
                    @if (Auth::user()->football_club->payment == 'paid')
                        {{ $player->user->email }}
                    @else
                        <p>For paid user only</p>
                    @endif
                </h5>



                <h5 class="text-sm-center mt-2 mb-1">Phone: 
                    @if (Auth::user()->football_club->payment == 'paid')
                        {{ $player->phone }}
                    @else
                        <p>For paid user only</p>
                    @endif
                    
                </h5>
                <h5 class="text-sm-center mt-2 mb-1">Address:
                    @if (Auth::user()->football_club->payment == 'paid')
                    {{ $player->address }}
                    @else
                        <p>For paid user only</p>
                    @endif 
                </h5>
                <h5 class="text-sm-center mt-2 mb-1">Nationality: {{ $player->nationality }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Gender: {{ $player->gender }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Contract Length: {{ $player->contract_length }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Football Group Player: {{ $player->football_group_player }}</h5>
                <div class="location text-sm-center">Current Club: {{ ucwords(str_replace('_', ' ', $player->current_club)) }}</div>
                <div class="location text-sm-center">Position: {{ ucwords(str_replace('_', ' ', $player->position)) }}</div>
                <div class="location text-sm-center">Favourite Foot: {{ ucwords(str_replace('_', ' ', $player->favourite_foot)) }}</div>
                <div class="location text-sm-center">International Appearance: {{ ucwords(str_replace('_', ' ', $player->international_appearance)) }}</div>
                <div class="location text-sm-center">Passport Type: {{ ucwords(str_replace('_', ' ', $player->passport_type)) }}</div>
                <div class="location text-sm-center">Multiple Passports: {{ ucwords(str_replace('_', ' ', $player->is_passport_more_then_one)) }}</div>
                <div class="location text-sm-center">Age: {{ $player->age }}</div>
                <div class="location text-sm-center">Date of Birth: {{ $player->dob }}</div>
                <div class="location text-sm-center">Height: {{ $player->height }}</div>
                <div class="location text-sm-center">Weight: {{ $player->weight }}</div>
                <div class="location text-sm-center">Other Info: {{ $player->other_info }}</div>
            </div>
            <hr>
            <div class="card-text text-sm-center">
               <h2>Medical Information</h2>
               @if (Auth::user()->football_club->payment == 'paid')
               <div class="location text-sm-center">Blood Type: {{ $player->medical_info->blood_type }}</div>
               <div class="location text-sm-center">Allergies: {{ $player->medical_info->allergies }}</div>
               <div class="location text-sm-center">Previous Injuries: {{ $player->medical_info->previous_injuries }}</div>
               <div class="location text-sm-center">About Player: {{ $player->medical_info->about_player }}</div>
                @else
                    <p>For paid user only</p>
                @endif
              
            </div>
        </div>
    </div>
</div>
@endsection