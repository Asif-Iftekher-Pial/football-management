@extends('master.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="au-card recent-report">
                <div class="au-card-inner">
                    @include('layouts.errorAndSuccessMessage')
                    <div class="overview-wrap">
                        @hasallroles($collectionOfRoles)
                        <h2 class="title-1">Other Football Jobs</h2>
                        
                            <a href="{{ route('other-football-job.create') }}" class="au-btn au-btn-icon au-btn--blue">
                                <i class="zmdi zmdi-plus"></i>Add New</a>
                        @else
                        @endhasallroles

                        @hasexactroles('other_football_job')
                        <h2 class="title-1">Football Job's Information</h2>
                        @endhasexactroles

                        @if ((auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner')) && (!auth()->user()->hasallroles($collectionOfRoles)))
                        <h2 class="title-1">Football Job's Information</h2>
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
                                            <th>Position</th>
                                            @hasallroles($collectionOfRoles)
                                            <th>Is_Approved</th>
                                            @endhasallroles
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($otherFootballJobs as $otherFootballJob)
                                            <tr>
                                                <td>{{ $otherFootballJob->name }}</td>
                                                <td>
                                                    @if ($otherFootballJob->user->photo)
                                                        <img src="{{ asset('images/' . $otherFootballJob->user->photo) }}"
                                                            alt="Photo" width="100px">
                                                    @else
                                                        No Photo
                                                    @endif
                                                </td>
                                                <td>{{ $otherFootballJob->position }}</td>
                                                @hasallroles($collectionOfRoles)
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-sm {{ $otherFootballJob->status == 'approved' ? 'btn-success' : 'btn-danger' }} dropdown-toggle"
                                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            {{ ucwords(str_replace('_', ' ', $otherFootballJob->status)) }}
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="{{ route('football_job.approve.status', ['id' => $otherFootballJob->id, 'status' => 'approved']) }}">Approved</a>
                                                            <a class="dropdown-item"
                                                                href="{{ route('football_job.approve.status', ['id' => $otherFootballJob->id, 'status' => 'not_approved']) }}">Reject</a>

                                                        </div>
                                                    </div>

                                                </td>
                                                @endhasallroles
                                                {{-- <td class="process">{{ $staff->payment_status }}</td> --}}
                                                <td class="row justify-content-between">
                                                    {{-- edit button --}}
                                                    <a href="{{ route('other-football-job.show', $otherFootballJob->id) }}"
                                                        class="btn btn-success btn-sm"><i class="fa fa-eye"
                                                            aria-hidden="true"></i></a>
                                                    @hasallroles($collectionOfRoles)
                                                    <a href="{{ route('other-football-job.edit', $otherFootballJob->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fa fa-pencil-square-o"
                                                            aria-hidden="true"></i></a>
                                                    <form action="{{ route('other-football-job.destroy', $otherFootballJob->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to delete this?');"
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




                    @hasexactroles('other_football_job')
                    <div class="row m-t-30">
                        <div class="col-md-12">
                            <div class="card text-center">
                                <div class="card-header">
                                    @if ($other_football_job->other_football_job->status == 'approved')
                                    <a href="{{ route('other-football-job.edit', $other_football_job->other_football_job->id) }}"
                                        class="btn btn-warning pull-left m-1"><i class="fa fa-pencil-square-o"
                                            aria-hidden="true"></i>
                                    </a>
                                    @else
                                        <p>Get aprroved by admin to edit your profile</p>
                                    @endif
                                   

                                    <i class="fa fa-user"></i>
                                    <strong class="card-title mb-3">Football Job's Profile</strong>
                                   
                                    <a href="{{ route('football_job.export.pdf',$other_football_job->other_football_job->id) }}" class="btn btn-success pull-right"><i class="fa fa-print" aria-hidden="true"></i></a>
                                </div>
                                <div class="card-body">
                                    <div class="mx-auto d-block">
                                        @if ($other_football_job->photo)
                                        <img class="rounded-circle mx-auto d-block" src="{{ asset('images/' . $other_football_job->photo) }}" alt="Photo" width="100px">
                                        @else
                                        No Photo
                                        @endif
                                        <h5 class="text-sm-center mt-2 mb-1">Name: {{ $other_football_job->name }}</h5>
                                        <h5 class="text-sm-center mt-2 mb-1">Email: {{ $other_football_job->email }}</h5>
                                        <div class="location text-sm-center">Date of Birth: {{ $other_football_job->other_football_job->dob }}</div>

                                        <div class="text-sm-center mt-2 mb-1">Position: {{ $other_football_job->other_football_job->position }}</div>
                                        <div class="text-sm-center mt-2 mb-1">Phone: {{ $other_football_job->other_football_job->phone }}</div>
                                        <div class="text-sm-center mt-2 mb-1">Address: {{ $other_football_job->other_football_job->address }}</div>
                                        
                                        <div>Experience: {{ $other_football_job->other_football_job->experience ?? '' }}</div>
                                        <div>About: {{ $other_football_job->other_football_job->about_you ?? '' }}</div>
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
