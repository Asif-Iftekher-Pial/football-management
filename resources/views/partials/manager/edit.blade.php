@extends('master.master')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Manager Informations</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('manager.update',$manager->id) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                @include('layouts.errorAndSuccessMessage')
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Name</label>
                                <input type="text" name="name" placeholder="Enter name" class="form-control" value="{{ $manager->name }}">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-control-label">Phone</label>
                                <input type="number" name="phone" placeholder="Enter phone number" class="form-control" value="{{ $manager->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="address" class="form-control-label">Address</label>
                                <input type="text" name="address" placeholder="Enter address" class="form-control" value="{{ $manager->address }}">
                            </div>
                            <div class="form-group">
                                <label for="age" class="form-control-label">Age</label>
                                <input type="number" name="age" placeholder="Enter age" class="form-control" value="{{ $manager->age }}">
                            </div>
                            <div class="form-group">
                                <label for="qualification" class="form-control-label">Qualification</label>
                                <textarea cols="10" rows="3" name="qualification" placeholder="Enter qualification" class="form-control">{{ $manager->qualification }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="honours" class="form-control-label">International Honours</label>
                                <textarea cols="10" rows="3" type="text" name="honours" placeholder="Enter any international honours" class="form-control" >{{ $manager->honours }}</textarea>
                            </div>
                           
                            <div class="form-group">
                                <label for="photo" class="form-control-label">Photo</label>
                                <input type="file" name="photo" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob" class="form-control-label">Date of Birth</label>
                                <input type="date" name="dob" placeholder="Enter date of birth" class="form-control" value="{{ $manager->dob }}">
                            </div>
                            <div class="form-group">
                                <label for="nationality" class="form-control-label">Nationality</label>
                                <input type="text" name="nationality" placeholder="Enter nationality" class="form-control" value="{{ $manager->nationality }}">
                            </div>
                            <div class="form-group">
                                <label for="football_club_manage" class="form-control-label">Football Club Managed</label>
                                <input type="text" name="football_club_manage" placeholder="Enter football club managed" class="form-control" value="{{ $manager->football_club_manage }}">
                            </div>
                            <div class="form-group">
                                <label for="coaching_badges" class="form-control-label">Coaching Badges</label>
                                <textarea cols="10" rows="3"  name="coaching_badges" placeholder="Enter coaching badges" class="form-control">{{ $manager->coaching_badges }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="international_team_managed" class="form-control-label">International Team Managed</label>
                                <textarea cols="10" rows="3" name="international_team_managed" placeholder="Enter international team managed" class="form-control">{{ $manager->international_team_managed }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password</label>
                                <input type="password" name="password" placeholder="Enter password" class="form-control" value="{{ $manager->user->password }}">
                            </div>
                            <div class="form-group">
                                <label for="video" class="form-control-label">Video</label>
                                <input type="text" name="video" placeholder="https://" class="form-control" value="{{ $manager->video }}">
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                
            </form>
           
        </div>
    </div>
</div>
@endsection