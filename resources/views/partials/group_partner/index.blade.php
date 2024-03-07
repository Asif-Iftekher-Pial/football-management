@extends('master.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="au-card recent-report">
            <div class="au-card-inner">
                @include('layouts.errorAndSuccessMessage')
                <div class="overview-wrap">
                    <h2 class="title-1">Partner Informations</h2>
                    @hasallroles($collectionOfRoles)
                    <a href="{{ route('group-partner.create') }}" class="au-btn au-btn-icon au-btn--blue">
                        <i class="zmdi zmdi-plus"></i>add partner</a>
                    @endhasallroles
                    
                </div>
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3" id="myTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Telephone</th>
                                        <th>Contact</th>
                                        <th>Website</th>
                                        @hasallroles($collectionOfRoles)
                                        <th>IS_Approved</th>
                                        @endhasallroles
                                        {{-- <th>Payment</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($football_group_staffs as $staff)
                                <tr>
                                    <td>{{ $staff->name }}</td>
                                    <td>
                                        @if ($staff->user->photo)
                                        <img src="{{ asset('images/' . $staff->user->photo) }}" alt="Photo" width="100px">
                                        @else
                                        No Photo
                                        @endif
                                    </td>
                                    <td>{{ $staff->address}}</td>
                                    <td>{{ $staff->country}}</td>
                                    <td>{{ $staff->telephone }}</td>
                                    <td>{{ $staff->contact}}</td>
                                    <td>
                                        <a href="{{ $staff->website }}" target="_blank">{{ $staff->website }}</a>
                                    </td>
                                    @hasallroles($collectionOfRoles)
                                    <td >
                                        <div class="dropdown">
                                            <button class="btn {{ $staff->status == 'approved' ? 'btn-success' : 'btn-danger' }} dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ ucwords(str_replace('_', ' ', $staff->status)) }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              <a class="dropdown-item" href="{{ route('admin.approve.status.partner',['id' => $staff->id, 'status' => 'approved']) }}">Approved</a>
                                              <a class="dropdown-item" href="{{ route('admin.approve.status.partner', ['id' => $staff->id, 'status' => 'not_approved']) }}">Reject</a>
                                            
                                            </div>
                                        </div>
                                        
                                    </td>
                                    @endhasallroles
                                    {{-- <td class="process">{{ $staff->payment_status }}</td> --}}
                                    <td class="row justify-content-between">
                                        {{-- edit button --}}
                                        @hasallroles($collectionOfRoles)
                                        <a href="{{ route('group-partner.edit', $staff->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        @endhasallroles
                                        <a href="{{ route('footballGroupPartner.export.pdf', $staff->id) }}" class="btn btn-success btn-sm"><i class="fa fa-print" aria-hidden="true"></i></a>
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