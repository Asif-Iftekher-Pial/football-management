@extends('master.master')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Club Informations</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('football-club.update',$club->id) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                @include('layouts.errorAndSuccessMessage')
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- {{ $club }} --}}
                            <div class="form-group">
                                <label for="name" class="form-control-label">Name</label>
                                <input type="text" name="name" placeholder="Enter name" class="form-control" value="{{ $club->name }}">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-control-label">Phone</label>
                                <input type="number" name="phone" placeholder="Enter phone number" class="form-control" value="{{ $club->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="address" class="form-control-label">Address</label>
                                <input type="text" name="address" placeholder="Enter address" class="form-control" value="{{ $club->address }}">
                            </div>
                           
                            
                           
                            <div class="form-group">
                                <label for="photo" class="form-control-label">Photo</label>
                                <input type="file" name="photo" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country" class="form-control-label">Country</label>
                                <input type="text" name="country" placeholder="USA" class="form-control" value="{{ $club->country }}">
                            </div>
                            <div class="form-group">
                                <label for="contact" class="form-control-label">Contact</label>
                                <input type="text" name="contact" placeholder="Enter contact information" class="form-control" value="{{ $club->contact }}">
                            </div>
                            <div class="form-group">
                                <label for="website" class="form-control-label">Website</label>
                                <input type="text" name="website" placeholder="http://" class="form-control" value="{{ $club->website }}">
                            </div>
                           
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password</label>
                                <input type="password" name="password" placeholder="Enter password" class="form-control" value="{{ $club->user->password }}">
                            </div>
                           
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                </div>
                
                    
                
            </form>
           
        </div>
    </div>
</div>
@endsection