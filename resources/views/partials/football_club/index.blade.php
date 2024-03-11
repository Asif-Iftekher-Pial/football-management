@extends('master.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="au-card recent-report">
                <div class="au-card-inner">
                    @include('layouts.errorAndSuccessMessage')
                    <div class="overview-wrap">
                        @hasallroles($collectionOfRoles)
                        <h2 class="title-1">Football Clubs</h2>
                        
                            <a href="{{ route('football-club.create') }}" class="au-btn au-btn-icon au-btn--blue">
                                <i class="zmdi zmdi-plus"></i>Add Football Club</a>
                        @else
                        @endhasallroles

                        @hasexactroles('registered_football_club')
                        <h2 class="title-1">Club Information</h2>
                        @endhasexactroles

                        @if ((auth()->user()->hasRole('football_group_staff') ||auth()->user()->hasRole('partner') ) && (!auth()->user()->hasallroles($collectionOfRoles)))
                        <h2 class="title-1">Club</h2>
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
                                            <th>Country</th>
                                            <th>Website</th>
                                            @hasallroles($collectionOfRoles)
                                            <th>Is_Approved</th>
                                            <th>Payment Status</th>
                                            @endhasallroles
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_football_clubs as $football_club)
                                            <tr>
                                                <td>{{ $football_club->name }}</td>
                                                <td>
                                                    @if ($football_club->user->photo)
                                                        <img src="{{ asset('images/' . $football_club->user->photo) }}"
                                                            alt="Photo" width="100px">
                                                    @else
                                                        No Photo
                                                    @endif
                                                </td>
                                                <td>{{ $football_club->country }}</td>
                                                <td>{{ $football_club->website }}</td>
                                                @hasallroles($collectionOfRoles)
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-sm {{ $football_club->status == 'approved' ? 'btn-success' : 'btn-danger' }} dropdown-toggle"
                                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            {{ ucwords(str_replace('_', ' ', $football_club->status)) }}
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="{{ route('football_club.approve.status', ['id' => $football_club->id, 'status' => 'approved']) }}">Approved</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('football_club.approve.status', ['id' => $football_club->id, 'status' => 'not_approved']) }}">Reject</a>

                                                        </div>
                                                    </div>

                                                </td>
                                                <td>
                                                    @if ($football_club->payment == 'not_paid' )
                                                    <a href="{{ route('sendPaypalPaymentLink',$football_club->user->id) }}" class="btn btn-sm btn-outline-primary"><i class="fa fa-envelope m-1" aria-hidden="true"></i>Payment Link</a>
                                                    @else
                                                        
                                                    @endif
                                                   <p class="text-{{ $football_club->payment == 'paid' ? 'success' : 'danger' }}"> {{ $football_club->payment }}</p>
                                                </td>
                                                @endhasallroles
                                                {{-- <td class="process">{{ $staff->payment_status }}</td> --}}
                                                <td class="row justify-content-between">
                                                    {{-- edit button --}}
                                                    <a href="{{ route('football-club.show', $football_club->id) }}"
                                                        class="btn btn-success btn-sm"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></a>
                                                    @hasallroles($collectionOfRoles)
                                                    <a href="{{ route('football-club.edit', $football_club->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"
                                                            aria-hidden="true"></i></a>
                                                    {{-- <form action="{{ route('football-club.destroy', $football_club->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this manager?');"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                        </button>
                                                    </form> --}}
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




                    @hasexactroles('registered_football_club')
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <div class="card text-center">
                                <div class="card-header">
                                    @if ($football_club->football_club->status == 'approved')
                                    <a href="{{ route('football-club.edit', $football_club->football_club->id) }}"
                                        class="btn btn-warning pull-left m-1"><i class="fa fa-pencil-square-o"
                                            aria-hidden="true"></i>
                                    </a>
                                    @else
                                        <p>Get aprroved by admin to edit your profile</p>
                                    @endif
                                   

                                    <i class="fa fa-user"></i>
                                    <strong class="card-title mb-3">Club Profile</strong>
                                   
                                    <a href="{{ route('football_club.export.pdf',$football_club->football_club->id) }}" class="btn btn-success pull-right"><i class="fa fa-print" aria-hidden="true"></i></a>
                                </div>
                                <div class="card-body">
                                    <div class="mx-auto d-block">
                                        @if ($football_club->photo)
                                        <img class="rounded-circle mx-auto d-block" src="{{ asset('images/' . $football_club->photo) }}" alt="Photo" width="100px">
                                        @else
                                        No Photo
                                        @endif
                                        <h5 class="text-sm-center mt-2 mb-1">Name: {{ $football_club->name }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Email: {{ $football_club->email }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Phone: {{ $football_club->football_club->phone }}</h5>
                                        <p class="text-sm-center mt-2 mb-1">Address: {{ $football_club->football_club->address }}</p>
                                        <p class="text-sm-center mt-2 mb-1">Country: {{ $football_club->football_club->country }}</p>
                                        <p class="location text-sm-center">Contact: {{ $football_club->football_club->contact }}</p>
                                        <p class="location text-sm-center ">Payment Status: <p class="text-{{ $football_club->football_club->payment == 'paid' ? 'success' : 'danger' }}">{{ ucwords(str_replace('_', ' ', $football_club->football_club->payment))  }}</p> </p>
                                    </div>
                                    <hr>
                                    
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
