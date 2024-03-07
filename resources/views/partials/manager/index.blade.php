@extends('master.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="au-card recent-report">
                <div class="au-card-inner">
                    @include('layouts.errorAndSuccessMessage')
                    <div class="overview-wrap">
                        @hasallroles($collectionOfRoles)
                        <h2 class="title-1">Managers</h2>
                        
                            <a href="{{ route('manager.create') }}" class="au-btn au-btn-icon au-btn--blue">
                                <i class="zmdi zmdi-plus"></i>Add Manager</a>
                        @else
                        @endhasallroles

                        @hasexactroles('manager')
                        <h2 class="title-1">Manager Information</h2>
                        @endhasexactroles

                        @if ((auth()->user()->hasRole('football_group_staff') ||auth()->user()->hasRole('partner') ) && (!auth()->user()->hasallroles($collectionOfRoles)))
                        <h2 class="title-1">Manager</h2>
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
                                        @foreach ($managers as $manager)
                                            <tr>
                                                <td>{{ $manager->name }}</td>
                                                <td>
                                                    @if ($manager->user->photo)
                                                        <img src="{{ asset('images/' . $manager->user->photo) }}"
                                                            alt="Photo" width="100px">
                                                    @else
                                                        No Photo
                                                    @endif
                                                </td>
                                                <td>{{ $manager->age }}</td>
                                                <td>{{ $manager->nationality }}</td>
                                                @hasallroles($collectionOfRoles)
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-sm {{ $manager->status == 'approved' ? 'btn-success' : 'btn-danger' }} dropdown-toggle"
                                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            {{ ucwords(str_replace('_', ' ', $manager->status)) }}
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="{{ route('manager.approve.status', ['id' => $manager->id, 'status' => 'approved']) }}">Approved</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('manager.approve.status', ['id' => $manager->id, 'status' => 'not_approved']) }}">Reject</a>

                                                        </div>
                                                    </div>

                                                </td>
                                                @endhasallroles
                                                {{-- <td class="process">{{ $staff->payment_status }}</td> --}}
                                                <td class="row justify-content-between">
                                                    {{-- edit button --}}
                                                    <a href="{{ route('manager.show', $manager->id) }}"
                                                        class="btn btn-success btn-sm"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></a>
                                                    @hasallroles($collectionOfRoles)
                                                    <a href="{{ route('manager.edit', $manager->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"
                                                            aria-hidden="true"></i></a>
                                                    <form action="{{ route('manager.destroy', $manager->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this manager?');"
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




                    @hasexactroles('manager')
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <div class="card text-center">
                                <div class="card-header">
                                    @if ($manager->manager->status == 'approved')
                                    <a href="{{ route('manager.edit', $manager->manager->id) }}"
                                        class="btn btn-warning pull-left m-1"><i class="fa fa-pencil-square-o"
                                            aria-hidden="true"></i>
                                    </a>
                                    @else
                                        <p>Get aprroved by admin to edit your profile</p>
                                    @endif
                                   

                                    <i class="fa fa-user"></i>
                                    <strong class="card-title mb-3">Manager Profile</strong>
                                   
                                    <a href="{{ route('manager.export.pdf',$manager->manager->id) }}" class="btn btn-success pull-right"><i class="fa fa-print" aria-hidden="true"></i></a>
                                </div>
                                <div class="card-body">
                                    <div class="mx-auto d-block">
                                        @if ($manager->photo)
                                        <img class="rounded-circle mx-auto d-block" src="{{ asset('images/' . $manager->photo) }}" alt="Photo" width="100px">
                                        @else
                                        No Photo
                                        @endif
                                        <h5 class="text-sm-center mt-2 mb-1">Name: {{ $manager->name }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Email: {{ $manager->email }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Phone: {{ $manager->manager->phone }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Address: {{ $manager->manager->address }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Nationality: {{ $manager->manager->nationality }}</h5>
                                        <div class="location text-sm-center">Age: {{ $manager->manager->age }}</div>
                                        <div class="location text-sm-center">Date of Birth: {{ $manager->manager->dob }}</div>

                                        <p>Football Club Manage: {{ $manager->manager->football_club_manage ?? '' }}</p>
                                        <p>Coaching badges: {{ $manager->manager->coaching_badges ?? '' }}</p>
                                        <p>Qualification: {{ $manager->manager->qualification ?? '' }}</p>
                                        <p>Honours:{{ $manager->manager->honours ?? '' }}</p>
                                        <p>International team managed: {{ $manager->manager->international_team_managed ?? '' }}</p>
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
