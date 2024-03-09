@extends('master.master')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Assign Role To - ({{ $user->name }})</strong>
            </div>
            <div class="container ">
                @include('layouts.errorAndSuccessMessage')
                <form action="{{ route('assignRolesToUser', $user->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-center m-4">
                                Please be carefull about assigning new role to user.Your system might behave unexpectedly!
                            
                            </h5>
                            <h5 class="text-center m-4">
                                You can not assign role registered_football_club to any user. This is a default role for users who registered as registered_football_club
                            </h5>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-check">
                                    <label for="checkboxSuperAdmin" class="form-check-label">
                                        <input type="checkbox" id="checkboxSuperAdmin" class="form-check-input">
                                        Super Admin (Select All)
                                    </label>
                                </div>
                            </div>
                        </div>

                        @foreach ($roles as $role)
                            <div class="col-md-3 m-3">
                                <div class="row form-group">
                                    <div class="form-check">
                                        <div class="checkbox">
                                            <label for="checkbox{{ $role->id }}" class="form-check-label ">
                                                <input type="checkbox" id="checkbox{{ $role->id }}" name="roles[]"
                                                    value="{{ $role->name }}" class="form-check-input"
                                                    {{ $user->roles->contains('id', $role->id) ? 'checked' : '' }}
                                                    {{ $role->name == 'registered_football_club' ? 'disabled' : '' }}>{{ $role->name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-sm btn-success mb-5" onclick="return confirm('Are you sure you want to assign role to this user?');">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

        $(document).ready(function() {
            var checkboxSuperAdmin = $('#checkboxSuperAdmin');
            var otherCheckboxes = $('input[type="checkbox"][name="roles[]"]').not(checkboxSuperAdmin);

             // **Check for initial checked state from database:**
            var areOthersChecked = otherCheckboxes.length === otherCheckboxes.filter(':checked').length;
            checkboxSuperAdmin.prop('checked', areOthersChecked);

            // Initially set the disabled state of the submit button
            updateSubmitButton();

            // Handle clicking the "Super Admin" checkbox
            checkboxSuperAdmin.click(function() {
                var isChecked = $(this).is(':checked');
                otherCheckboxes.prop('checked', isChecked);

                updateSubmitButton();
            });

            // Handle clicking any other checkbox
            otherCheckboxes.click(function() {
                // Check if all other checkboxes are now checked
                var areAllChecked = otherCheckboxes.length === otherCheckboxes.filter(':checked').length;
                checkboxSuperAdmin.prop('checked', areAllChecked);

                updateSubmitButton();
            });

            function updateSubmitButton() {
                var submitButton = $('button[type="submit"]');
                submitButton.prop('disabled', !otherCheckboxes.is(':checked'));
            }
        });
    </script>
@endsection
