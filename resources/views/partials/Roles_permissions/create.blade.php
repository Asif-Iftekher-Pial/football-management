@extends('master.master')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Create permission</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('roles-permissions.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('layouts.errorAndSuccessMessage')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class=" form-control-label">Permission Name</label>
                            <input type="text" name="name" placeholder="Permission name" class="form-control">
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