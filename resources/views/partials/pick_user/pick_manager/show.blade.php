@extends('master.master')
@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-header">
            <i class="fa fa-user"></i>
            <strong class="card-title mb-3">Manager Profile</strong>
            <a href="{{ route('manager.detail.export.pdf',$manager->id) }}" class="btn btn btn-success pull-right"><i class="fa fa-print" aria-hidden="true"></i></a>
        </div>
        <div class="card-body">
            <div class="mx-auto d-block">
                @if ($manager->user->photo)
                <img class="rounded-circle mx-auto d-block" src="{{ asset('images/' . $manager->user->photo) }}" alt="Photo" width="100px">
                @else
                No Photo
                @endif
                <h5 class="text-sm-center mt-2 mb-1">Name: {{ $manager->name }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Email: 
                    @if (Auth::user()->football_club->payment == 'paid')
                        {{ $manager->user->email }}
                    @else
                        <p>For paid user only</p>
                    @endif
                </h5>



                <h5 class="text-sm-center mt-2 mb-1">Phone: 
                    @if (Auth::user()->football_club->payment == 'paid')
                        {{ $manager->phone }}
                    @else
                        <p>For paid user only</p>
                    @endif
                    
                </h5>
                <h5 class="text-sm-center mt-2 mb-1">Address:
                    @if (Auth::user()->football_club->payment == 'paid')
                    {{ $manager->address }}
                    @else
                        <p>For paid user only</p>
                    @endif 
                </h5>
                <h5 class="text-sm-center mt-2 mb-1">Nationality: {{ $manager->nationality }}</h5>
                <div class="location text-sm-center">Age: {{ $manager->age }}</div>
                <div class="location text-sm-center">Date of Birth: {{ $manager->dob }}</div>
                <div class="text-sm-center mt-2 mb-1">Football Club Managed: {{ $manager->football_club_manage }}</div>
                <div class="text-sm-center mt-2 mb-1">Coaching Badges: {{ $manager->coaching_badges }}</div>
                <div class="text-sm-center mt-2 mb-1">Qualification: {{ $manager->qualification }}</div>
                <div class="text-sm-center mt-2 mb-1">Honours: {{ $manager->honours }}</div>
                <div class="text-sm-center mt-2 mb-1">International Team Managed: {{ $manager->international_team_managed }}</div>
                <div class="text-sm-center mt-2 mb-1">Video: {{ $manager->video }}</div>
            </div>
            <hr>
            
        </div>
    </div>
</div>
@endsection