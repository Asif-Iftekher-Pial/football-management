@extends('master.master')
@section('content')
<div class="card">
    <div class="card-header">
        <strong class="card-title">Warning</strong>
    </div>
    <div class="card-body">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Oops!</h4>
            <p> Account Disabled!</p>
            <hr>
            <p class="mb-0">Your account is disabled.Please wait for the admin to activate your account.</p>
            <p class="mb-0">Contact Admin: {{ app\Models\User::where('id','1')->pluck('email')->first() }}</p>
            
        </div>
    </div>
</div>
@endsection