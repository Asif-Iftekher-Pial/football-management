@extends('master.master')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Football Job's Informations</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('other-football-job.update',$football_job->id) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                @include('layouts.errorAndSuccessMessage')
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Name</label>
                                <input type="text" name="name" placeholder="Enter name" class="form-control" value="{{ $football_job->name }}">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-control-label">Phone</label>
                                <input type="number" name="phone" placeholder="Enter phone number" class="form-control" value="{{ $football_job->phone }}">
                            </div>
                            <div class="form-group">
                                <label for="address" class="form-control-label">Address</label>
                                <input type="text" name="address" placeholder="Enter address" class="form-control" value="{{ $football_job->address }}">
                            </div>
                            <div class="form-group">
                                <label for="dob" class="form-control-label">Date of Birth</label>
                                <input type="date" name="dob" placeholder="Enter date of birth" class="form-control" value="{{ $football_job->dob }}">
                            </div>

                            <div class="form-group">
                                <label for="position" class="form-control-label">Position</label>
                                <select class="form-control" name="position" id="exampleFormControlSelect1">
                                  <option value="" >---->Select Position<----</option>
                                  <option value="chairperson" {{ $football_job->position == 'chairperson' ? 'selected' : '' }}>Chairperson</option>
                                  <option value="director" {{ $football_job->position == 'director' ? 'selected' : '' }}>Director</option>
                                  <option value="secretarial" {{ $football_job->position == 'secretarial' ? 'selected' : '' }}>Secretarial</option>
                                  <option value="public_relations" {{ $football_job->position == 'public_relations' ? 'selected' : '' }}>Public Relations</option>
                                  <option value="communication" {{ $football_job->position == 'communication' ? 'selected' : '' }}>Communication</option>
                                  <option value="marketing" {{ $football_job->position == 'marketing' ? 'selected' : '' }}>Marketing</option>
                                  <option value="web_team" {{ $football_job->position == 'web_team' ? 'selected' : '' }}>Web Team</option>
                                  <option value="social_media" {{ $football_job->position == 'social_media' ? 'selected' : '' }}>Social Media</option>
                                  <option value="grounds_person" {{ $football_job->position == 'grounds_person' ? 'selected' : '' }}>Grounds Person</option>
                                  <option value="foundation_charity" {{ $football_job->position == 'foundation_charity' ? 'selected' : '' }}>Foundation/Charity</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="experience" class="form-control-label">Experience</label>
                                <textarea cols="10" rows="3" name="experience" placeholder="Enter your experience" class="form-control">{{ $football_job->experience }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="about_you" class="form-control-label">About You</label>
                                <textarea cols="10" rows="3" name="about_you" placeholder="Enter about you" class="form-control">{{ $football_job->about_you }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password</label>
                                <input type="password" name="password" placeholder="Enter password" class="form-control" value="{{ $football_job->user->password }}">
                            </div>
                           
                            <div class="form-group">
                                <label for="photo" class="form-control-label">Photo</label>
                                <input type="file" name="photo" class="form-control">
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