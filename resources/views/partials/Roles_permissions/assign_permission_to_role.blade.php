@extends('master.master')
@section('content')

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Assign permission - ({{ $role->name }})</strong>
        </div>
        <div class="container ">
            <form action="{{ route('assignPermissionToRole',$role->id) }}" method="post">
                @csrf
                <div class="row">
                    @foreach ($permissions as $permission)
                    <div class="col-md-2 m-3">
                        <div class="row form-group">
                            <div class="form-check">
                                <div class="checkbox">
                                    <label for="checkbox{{ $permission->id }}" class="form-check-label ">
                                        <input type="checkbox" id="checkbox{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}"
                                            class="form-check-input" {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>{{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-sm btn-success mb-5">Submit</button>
            </form>
           
        </div>
       
    </div>
</div>
@endsection
