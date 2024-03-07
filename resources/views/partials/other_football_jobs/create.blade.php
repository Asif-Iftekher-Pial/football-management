@extends('master.master')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Other Football Job's Informations</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('other-football-job.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('layouts.errorAndSuccessMessage')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Name</label>
                            <input type="text" name="name" placeholder="Enter name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input type="email" name="email" placeholder="Enter email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-control-label">Phone</label>
                            <input type="number" name="phone" placeholder="Enter phone number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-control-label">Address</label>
                            <input type="text" name="address" placeholder="Enter address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="dob" class="form-control-label">Date of Birth</label>
                            <input type="date" name="dob" placeholder="Enter date of birth" class="form-control" >
                        </div>

                        <div class="form-group">
                            <label for="position" class="form-control-label">Position</label>
                            <select class="form-control" name="position" id="exampleFormControlSelect1">
                              <option value="" >---->Select Position<----</option>
                              <option value="chairperson" >Chairperson</option>
                              <option value="director" >Director</option>
                              <option value="secretarial">Secretarial</option>
                              <option value="public_relations" >Public Relations</option>
                              <option value="communication" >Communication</option>
                              <option value="marking" >Marking</option>
                              <option value="web_team" >Web Team</option>
                              <option value="social_media">Social Media</option>
                              <option value="grounds_person" >Grounds Person</option>
                              <option value="foundation_charity">Foundation/Charity</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="experience" class="form-control-label">Experience</label>
                            <input type="text" name="experience" placeholder="Enter your experience" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="about_you" class="form-control-label">About You</label>
                            <input type="text" name="about_you" placeholder="Enter about you" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <input type="password" name="password" placeholder="Enter password" class="form-control">
                        </div>
                       
                        <div class="form-group">
                            <label for="photo" class="form-control-label">Photo</label>
                            <input type="file" name="photo" class="form-control">
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