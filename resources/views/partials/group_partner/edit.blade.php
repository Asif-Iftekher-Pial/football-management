@extends('master.master')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Football Group Staff Edit</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('group-partner.update', $football_group_partner->id) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                @include('layouts.errorAndSuccessMessage')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class=" form-control-label">Club Name</label>
                            <input type="text" name="name" value="{{ $football_group_partner->name }}" placeholder="Enter your club name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="contact" class=" form-control-label">Contact</label>
                            <input type="number" name="contact" value="{{ $football_group_partner->contact }}" placeholder="Enter contact number" class="form-control">
                        </div>
                         <div class="form-group">
                            <label for="agent_number" class=" form-control-label">Agent Number</label>
                            <input type="number" name="agent_number" value="{{ $football_group_partner->agent_number }}" placeholder="Enter agent number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="address" class=" form-control-label">Address</label>
                            <textarea name="address" id="" cols="10" rows="2" value={{ $football_group_partner->address }} class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="website" class=" form-control-label">Website</label>
                            <input name="website" value="{{ $football_group_partner->website }}"  placeholder="https://www.yourwebsite.com"  class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telephone" class=" form-control-label">Telephone</label>
                            <input type="text" name="telephone" value="{{ $football_group_partner->telephone }}" placeholder="Enter your telephone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="country" class=" form-control-label">Country</label>
                            <input type="text" name="country" value="{{ $football_group_partner->country }}" placeholder="USA" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class=" form-control-label">Password</label>
                            <input type="password" name="password"  class="form-control">
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