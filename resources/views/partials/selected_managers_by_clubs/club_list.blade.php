@extends('master.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="au-card recent-report">
                <div class="au-card-inner">
                    @include('layouts.errorAndSuccessMessage')
                    <div class="overview-wrap">
                    <h2 class="title-1">Mannager - {{ $all_clubs_of_manager->name }}</h2>
                    </div>
                   <div class="row m-t-30">
                        <div class="col-md-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Club Name</th>
                                            <th>Club Email</th>
                                            <th>Club Phone</th>
                                            <th>Club Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_clubs_of_manager->clubs as $club_detail)
                                            <tr>
                                                <td>
                                                    @if ($club_detail->user->photo)
                                                        <img src="{{ asset('images/' . $club_detail->user->photo) }}"
                                                            alt="Photo" width="100px">
                                                    @else
                                                        No Photo
                                                    @endif
                                                </td>
                                                <td>{{ $club_detail->name }}</td>
                                                <td>
                                                   {{ $club_detail->user->email }}
                                               
                                                   
                                                </td>
                                                <td>
                                                   {{ $club_detail->phone }}
                                               
                                                </td>
                                                <td>
                                                    {{ $club_detail->address }}
                                               
                                                </td>
                                                <td class="row justify-content-between">
                                                    {{-- edit button --}}
                                                    <a href="{{ route('remove.selected.club.form.manager', ['manager_id' => $all_clubs_of_manager->id, 'club_id' => $club_detail->id]) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                        Done/Reject
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- END DATA TABLE-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
