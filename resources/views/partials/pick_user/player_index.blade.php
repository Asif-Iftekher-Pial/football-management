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
                                                    @if (Auth::user()->football_club->payment == 'paid')
                                                    {{ $player->user->email }}
                                                @else
                                                    <p>For paid user only</p>
                                                @endif
                                                   
                                                </td>
                                                <td>
                                                    @if (Auth::user()->football_club->payment == 'paid')
                                                    {{ $player->phone }}
                                                @else
                                                    <p>For paid user only</p>
                                                @endif
                                                </td>
                                                <td>
                                                    @if (Auth::user()->football_club->payment == 'paid')
                                                    {{ $player->address }}
                                                @else
                                                    <p>For paid user only</p>
                                                @endif
                                                </td>
                                                
                                                <td>{{ $player->nationality }}</td>
                                                <td class="row justify-content-between">
                                                    {{-- edit button --}}
                                                    <a href="{{ route('player.detail', $player->id) }}"
                                                        class="btn btn-success btn-sm">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                    @if (Auth::user()->football_club->payment == 'paid')
                                                    <a href="{{ route('player.pick', $player->id) }}"
                                                        class="btn btn-primary btn-sm m-2">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    </a>
                                                    @else
                                                        pay to select player
                                                    @endif
                                                    
                                                   
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
