@extends('master.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="au-card recent-report">
                <div class="au-card-inner">
                    @include('layouts.errorAndSuccessMessage')
                    <div class="overview-wrap">
                        @hasallroles($collectionOfRoles)
                        <h2 class="title-1">Players</h2>
                        
                            <a href="{{ route('player.create') }}" class="au-btn au-btn-icon au-btn--blue">
                                <i class="zmdi zmdi-plus"></i>Add Player</a>
                        @else
                        @endhasallroles
                        @hasexactroles('player')
                        <h2 class="title-1">Player Information</h2>
                        @endhasexactroles
                        @if (auth()->user()->hasRole('football_group_staff'))
                        <h2 class="title-1">Players</h2>
                        @endif
                        
                    </div>
                    @if ( auth()->user()->hasRole('partner') || auth()->user()->hasRole('football_group_staff') ||auth()->user()->hasallroles($collectionOfRoles))
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Photo</th>
                                            <th>Age</th>
                                            <th>Nationality</th>
                                            @hasallroles($collectionOfRoles)
                                            <th>Is_Approved</th>
                                            @endhasallroles
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($players as $player)
                                            <tr>
                                                <td>{{ $player->name }}</td>
                                                <td>
                                                    @if ($player->user->photo)
                                                        <img src="{{ asset('images/' . $player->user->photo) }}"
                                                            alt="Photo" width="100px">
                                                    @else
                                                        No Photo
                                                    @endif
                                                </td>
                                                <td>{{ $player->age }}</td>
                                                <td>{{ $player->nationality }}</td>
                                                @hasallroles($collectionOfRoles)
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-sm {{ $player->status == 'approved' ? 'btn-success' : 'btn-danger' }} dropdown-toggle"
                                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            {{ ucwords(str_replace('_', ' ', $player->status)) }}
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.approve.player', ['id' => $player->id, 'status' => 'approved']) }}">Approved</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.approve.player', ['id' => $player->id, 'status' => 'not_approved']) }}">Reject</a>

                                                        </div>
                                                    </div>

                                                </td>
                                                @endhasallroles
                                                {{-- <td class="process">{{ $staff->payment_status }}</td> --}}
                                                <td class="row justify-content-between">
                                                    {{-- edit button --}}
                                                    <a href="{{ route('player.show', $player->id) }}"
                                                        class="btn btn-success btn-sm"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></a>
                                                    @hasallroles($collectionOfRoles)
                                                    <a href="{{ route('player.edit', $player->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"
                                                            aria-hidden="true"></i></a>
                                                    <form action="{{ route('player.destroy', $player->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this player?');"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                    @endhasallroles
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE-->
                        </div>
                    </div>
                    @else
                        
                    @endif




                    @hasexactroles('player')
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <div class="card text-center">
                                <div class="card-header">
                                    @if ($player->player->status == 'approved')
                                    <a href="{{ route('player.edit', $player->player->id) }}"
                                        class="btn btn-warning pull-left m-1"><i class="fa fa-pencil-square-o"
                                            aria-hidden="true"></i>
                                    </a>
                                    @else
                                        <p>Get aprroved by admin to edit your profile</p>
                                    @endif
                                   

                                    <i class="fa fa-user"></i>
                                    <strong class="card-title mb-3">Player Profile</strong>
                                   
                                    <a href="{{ route('player.export.pdf',$player->player->id) }}" class="btn btn-success pull-right"><i class="fa fa-print" aria-hidden="true"></i></a>
                                </div>
                                <div class="card-body">
                                    <div class="mx-auto d-block">
                                        @if ($player->photo)
                                        <img class="rounded-circle mx-auto d-block" src="{{ asset('images/' . $player->photo) }}" alt="Photo" width="100px">
                                        @else
                                        No Photo
                                        @endif
                                        <h5 class="text-sm-center mt-2 mb-1">Name: {{ $player->name }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Email: {{ $player->email }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Phone: {{ $player->player->phone }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Address: {{ $player->player->address }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Nationality: {{ $player->player->nationality }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Gender: {{ $player->player->gender }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Contract Length: {{ $player->player->contract_length }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Football Group Player: {{ $player->player->football_group_player }}</h5>
                                        <div class="location text-sm-center">Current Club: {{ ucwords(str_replace('_', ' ', $player->player->current_club)) }}</div>
                                        <div class="location text-sm-center">Position: {{ ucwords(str_replace('_', ' ', $player->player->position)) }}</div>
                                        <div class="location text-sm-center">Favourite Foot: {{ ucwords(str_replace('_', ' ', $player->player->favourite_foot)) }}</div>
                                        <div class="location text-sm-center">International Appearance: {{ ucwords(str_replace('_', ' ', $player->player->international_appearance)) }}</div>
                                        <div class="location text-sm-center">Passport Type: {{ ucwords(str_replace('_', ' ', $player->player->passport_type)) }}</div>
                                        <div class="location text-sm-center">Multiple Passports: {{ ucwords(str_replace('_', ' ', $player->player->is_passport_more_then_one)) }}</div>
                                        <div class="location text-sm-center">Age: {{ $player->player->age }}</div>
                                        <div class="location text-sm-center">Date of Birth: {{ $player->player->dob }}</div>
                                        <div class="location text-sm-center">Height: {{ $player->player->height }}</div>
                                        <div class="location text-sm-center">Weight: {{ $player->player->weight }}</div>
                                        <div class="location text-sm-center">Other Info: {{ $player->player->other_info }}</div>
                                    </div>
                                    <hr>
                                    <div class="card-text text-sm-center">
                                       <h2>Medical Information</h2>
                                       <div class="location text-sm-center">Blood Type: {{ $player->player->medical_info->blood_type }}</div>
                                       <div class="location text-sm-center">Allergies: {{ $player->player->medical_info->allergies }}</div>
                                       <div class="location text-sm-center">Previous Injuries: {{ $player->player->medical_info->previous_injuries }}</div>
                                       <div class="location text-sm-center">About Player: {{ $player->player->medical_info->about_player }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endhasexactroles
                </div>
            </div>
        </div>
    </div>
@endsection
