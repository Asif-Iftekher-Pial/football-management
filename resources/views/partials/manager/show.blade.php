@extends('master.master')
@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-header">
            <i class="fa fa-user"></i>
            <strong class="card-title mb-3">Manager Profile</strong>
            <a href="{{ route('manager.export.pdf',$manager->id) }}" class="btn btn btn-success pull-right"><i class="fa fa-print" aria-hidden="true"></i></a>
        </div>
        <div class="card-body">
            <div class="mx-auto d-block">
                @if ($manager->user->photo)
                <img class="rounded-circle mx-auto d-block" src="{{ asset('images/' . $manager->user->photo) }}" alt="Photo" width="100px">
                @else
                No Photo
                @endif
                <h5 class="text-sm-center mt-2 mb-1">Name: {{ $manager->name }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Email: {{ $manager->user->email }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Age: {{ $manager->age }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Phone: {{ $manager->phone }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Address: {{ $manager->address }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Nationality: {{ $manager->nationality }}</h5>
                <div class="text-sm-center mt-2 mb-1">Date of Birth: {{ $manager->dob }}</div>
                <div class="text-sm-center mt-2 mb-1">Nationality: {{ $manager->nationality }}</div>
                <div class="text-sm-center mt-2 mb-1">Football Club Managed: {{ $manager->football_club_manage }}</div>
                <div class="text-sm-center mt-2 mb-1">Coaching Badges: {{ $manager->coaching_badges }}</div>
                <div class="text-sm-center mt-2 mb-1">Qualification: {{ $manager->qualification }}</div>
                <div class="text-sm-center mt-2 mb-1">Honours: {{ $manager->honours }}</div>
                <div class="text-sm-center mt-2 mb-1">International Team Managed: {{ $manager->international_team_managed }}</div>
                <h5 class="text-sm-center mt-2 mb-1">Video: {{ $manager->video }}</h5>
                
            </div>
            <hr>
           
        </div>
    </div>
</div>

{{-- <div class="col-md-12">
    <div class="card text-center">
        <div class="card-header">
            <strong class="card-title mb-3">Profile Card</strong>
        </div>
        <div class="card-body">
            <div class="mx-auto d-block">
                @if ($manager->user->photo)
                <img class="rounded-circle mx-auto d-block" src="{{ asset('images/' . $manager->user->photo) }}" alt="Photo" width="100px">
                @else
                No Photo
                @endif
                <h5 class="text-sm-center mt-2 mb-1">{{ $manager->name }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">{{ $manager->nationality }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">{{ $manager->contract_length }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">{{ $manager->football_group_manager }}</h5>
                <div class="location text-sm-center">{{ ucwords(str_replace('_', ' ', $manager->current_club)) }}</div>
                <div class="location text-sm-center">{{ ucwords(str_replace('_', ' ', $manager->position)) }}</div>
                <div class="location text-sm-center">{{ ucwords(str_replace('_', ' ', $manager->favourite_foot)) }}</div>
                <div class="location text-sm-center">{{ ucwords(str_replace('_', ' ', $manager->international_appearance)) }}</div>
                <div class="location text-sm-center">{{ ucwords(str_replace('_', ' ', $manager->passport_type)) }}</div>
                <div class="location text-sm-center">{{ ucwords(str_replace('_', ' ', $manager->is_passport_more_then_one)) }}</div>
                <div class="location text-sm-center">{{$manager->age }}</div>
                <div class="location text-sm-center">{{$manager->dob }}</div>
                <div class="location text-sm-center">{{$manager->height }}</div>
                <div class="location text-sm-center">{{$manager->weight }}</div>
                <div class="location text-sm-center">{{$manager->other_info }}</div>
            </div>
            <hr>
            <div class="card-text text-sm-center">
               <h2>Medical Information</h2>
               <div class="location text-sm-center">{{$manager->medical_info->blood_type }}</div>
               <div class="location text-sm-center">{{$manager->medical_info->allergies }}</div>
               <div class="location text-sm-center">{{$manager->medical_info->previous_injuries }}</div>
               <div class="location text-sm-center">{{$manager->medical_info->about_manager }}</div>

            </div>
        </div>
    </div>
</div> --}}
@endsection