@extends('master.master')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Football Group Staff</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('football-group-staff.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('layouts.errorAndSuccessMessage')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class=" form-control-label">Club Name</label>
                            <input type="text" name="name" placeholder="Enter your club name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class=" form-control-label">Email</label>
                            <input type="email" name="email" placeholder="club@gmail.com" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="contact" class=" form-control-label">Contact</label>
                            <input type="number" name="contact" placeholder="Enter contact number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address" class=" form-control-label">Address</label>
                            <textarea name="address" id="" cols="10" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="website" class=" form-control-label">Website</label>
                            <input name="website"  placeholder="https://www.yourwebsite.com"  class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telephone" class=" form-control-label">Telephone</label>
                            <input type="text" name="telephone" placeholder="Enter your telephone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="country" class=" form-control-label">Country</label>
                            <input type="text" name="country" placeholder="USA" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class=" form-control-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                       
                        <div class="form-group">
                            <label for="photo" class="form-control-label">Photo</label>
                            <input type="file" id="file-input" name="photo" class="form-control-file">
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