@extends('master.master')
@section('content')
<div class="row">

    <div class="col-lg-12">
        <div class="au-card recent-report">
            <div class="au-card-inner">
                <div class="overview-wrap">
                    <h2 class="title-1">Users</h2>
                   
                            
                </div>
                <div class="row m-t-30">

                    <div class="col-md-12">
                        @include('layouts.errorAndSuccessMessage')
                        <a href="{{ route('roles-permissions.create') }}" class="btn btn-sm btn-success">
                            <i class="zmdi zmdi-plus"></i> add Players</a>
                            <a href="{{ route('roles-permissions.create') }}" class="btn btn-sm btn-primary">
                                <i class="zmdi zmdi-plus"></i>add Football Group Staff</a>
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40 mt-3">
                            <table class="table table-borderless table-data3" id="myTable">
                                <thead>
                                    <tr>
                                        <th style="text-align: left;">User Name</th>
                                        <th style="text-align: left;">User Email</th>
                                        <th style="text-align: left;">Assign Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td style="text-align: left;">{{ $user->name }}</td>
                                    <td style="text-align: left;">{{ $user->email }}</td>
                                    <td style="text-align: left;">
                                        <a style="display: {{ $user->id == 1 ? 'none' : '' }}" href="{{ route('assignRoleToUser',$user->id) }}" class="btn btn-sm btn-primary">
                                            <i class="zmdi zmdi-plus"></i></a>
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




    <div class="col-lg-12">
        <div class="au-card recent-report">
            <div class="au-card-inner">
                <div class="overview-wrap">
                    <h2 class="title-1">Roles</h2>
                    {{-- <a href="{{ route('football-group-staff.create') }}" class="au-btn au-btn-icon au-btn--blue">
                        <i class="zmdi zmdi-plus"></i>add staff</a> --}}
                </div>
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3" id="myTable">
                                <thead>
                                    <tr>
                                        <th style="text-align: left;">Name</th>
                                        {{-- <th style="text-align: left;">Assign Permissions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td style="text-align: left;">{{ $role->name }}</td>
                                    {{-- <td style="text-align: left;">
                                        <a href="{{ route('assignPermissionToRolePage', $role->id) }}" class="btn btn-success btn-sm"><i class="fa fa-address-card" aria-hidden="true"></i></a>
                                       
                                    </td> --}}
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
    {{-- <div class="col-lg-12">
        <div class="au-card recent-report">
            <div class="au-card-inner">
                <div class="overview-wrap">
                    <h2 class="title-1">Permissions</h2>
                    <a href="{{ route('roles-permissions.create') }}" class="au-btn au-btn-icon au-btn--blue">
                        <i class="zmdi zmdi-plus"></i>add permission</a>
                </div>
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3" id="myTable">
                                <thead>
                                    <tr>
                                        <th style="text-align: left;">Permission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td style="text-align: left;">{{ $permission->name }}</td>
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
    </div> --}}
</div>
@endsection