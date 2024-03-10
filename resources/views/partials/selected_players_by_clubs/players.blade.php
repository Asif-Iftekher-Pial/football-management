@extends('master.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="au-card recent-report">
                <div class="au-card-inner">
                    @include('layouts.errorAndSuccessMessage')
                    <div class="overview-wrap">
                    <h2 class="title-1">Players</h2>
                    </div>
                   <div class="row m-t-30">
                        <div class="col-md-12">
                            <!-- DATA TABLE-->
                            <div class="table-responsive m-b-40">
                                <table class="table table-borderless table-data3" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Nationality</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($players as $player)
                                            <tr>
                                                <td>
                                                    @if ($player->user->photo)
                                                        <img src="{{ asset('images/' . $player->user->photo) }}"
                                                            alt="Photo" width="100px">
                                                    @else
                                                        No Photo
                                                    @endif
                                                </td>
                                                <td>{{ $player->name }}</td>
                                                <td>
                                                   {{ $player->user->email }}
                                               
                                                   
                                                </td>
                                                <td>
                                                   {{ $player->phone }}
                                               
                                                </td>
                                                <td>
                                                    {{ $player->address }}
                                               
                                                </td>
                                                
                                                <td>{{ $player->nationality }}</td>
                                                <td class="row justify-content-between">
                                                    {{-- edit button --}}
                                                    <a href="{{ route('player.show', $player->id) }}"
                                                        class="btn btn-success btn-sm">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                  


                                                    <a href="{{ route('view.selected.clubs', $player->id) }}"
                                                        class="btn btn-primary btn-sm m-2">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                        view Clubs
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
