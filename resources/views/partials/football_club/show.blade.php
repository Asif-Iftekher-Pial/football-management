@extends('master.master')
@section('content')
<div class="col-md-12">
    <div class="card text-center">
        <div class="card-header">
            <i class="fa fa-user"></i>
            <strong class="card-title mb-3">Club Profile</strong>
            <a href="{{ route('football_club.export.pdf',$club->id) }}" class="btn btn btn-success pull-right"><i class="fa fa-print" aria-hidden="true"></i></a>
        </div>
        <div class="card-body">
            <div class="mx-auto d-block">
                @if ($club->user->photo)
                <img class="rounded-circle mx-auto d-block" src="{{ asset('images/' . $club->user->photo) }}" alt="Photo" width="100px">
                @else
                No Photo
                @endif
                <h5 class="text-sm-center mt-2 mb-1">Name: {{ $club->name }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Email: {{ $club->user->email }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Phone: {{ $club->phone }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Address: {{ $club->address }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">Country: {{ $club->country }}</h5>
                <div class="text-sm-center mt-2 mb-1">Contact: {{ $club->contact }}</div>
                <div class="text-sm-center mt-2 mb-1">Website: {{ $club->website }}</div>
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
                @if ($club->user->photo)
                <img class="rounded-circle mx-auto d-block" src="{{ asset('images/' . $club->user->photo) }}" alt="Photo" width="100px">
                @else
                No Photo
                @endif
                <h5 class="text-sm-center mt-2 mb-1">{{ $club->name }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">{{ $club->nationality }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">{{ $club->contract_length }}</h5>
                <h5 class="text-sm-center mt-2 mb-1">{{ $club->football_group_club }}</h5>
                <div class="location text-sm-center">{{ ucwords(str_replace('_', ' ', $club->current_club)) }}</div>
                <div class="location text-sm-center">{{ ucwords(str_replace('_', ' ', $club->position)) }}</div>
                <div class="location text-sm-center">{{ ucwords(str_replace('_', ' ', $club->favourite_foot)) }}</div>
                <div class="location text-sm-center">{{ ucwords(str_replace('_', ' ', $club->international_appearance)) }}</div>
                <div class="location text-sm-center">{{ ucwords(str_replace('_', ' ', $club->passport_type)) }}</div>
                <div class="location text-sm-center">{{ ucwords(str_replace('_', ' ', $club->is_passport_more_then_one)) }}</div>
                <div class="location text-sm-center">{{$club->age }}</div>
                <div class="location text-sm-center">{{$club->dob }}</div>
                <div class="location text-sm-center">{{$club->height }}</div>
                <div class="location text-sm-center">{{$club->weight }}</div>
                <div class="location text-sm-center">{{$club->other_info }}</div>
            </div>
            <hr>
            <div class="card-text text-sm-center">
               <h2>Medical Information</h2>
               <div class="location text-sm-center">{{$club->medical_info->blood_type }}</div>
               <div class="location text-sm-center">{{$club->medical_info->allergies }}</div>
               <div class="location text-sm-center">{{$club->medical_info->previous_injuries }}</div>
               <div class="location text-sm-center">{{$club->medical_info->about_club }}</div>

            </div>
        </div>
    </div>
</div> --}}
@endsection