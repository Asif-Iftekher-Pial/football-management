@extends('master.master')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Player Informations</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('player.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('layouts.errorAndSuccessMessage')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Name</label>
                            <input type="text" name="name" placeholder="Enter name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input type="email" name="email" placeholder="Enter Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="age" class="form-control-label">Age</label>
                            <input type="number" name="age" placeholder="Enter age" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-control-label">Phone</label>
                            <input type="number" name="phone" placeholder="Enter phpne number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-control-label">Address</label>
                            <input type="text" name="address" placeholder="Enter address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="dob" class="form-control-label">Date of Birth</label>
                            <input type="date" name="dob" placeholder="Enter date of birth" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="height" class="form-control-label">Height</label>
                            <input type="number" name="height" placeholder="Enter height" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="weight" class="form-control-label">Weight</label>
                            <input type="number" name="weight" placeholder="Enter weight" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="foot" class="form-control-label">Favourite Foot</label>
                            <select class="form-control" name="favourite_foot" id="foot">
                              <option value="left">Left</option>
                              <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="position" class="form-control-label">Position</label>
                            <select class="form-control" name="position" id="position">
                              <option value="">--Select Position--</option>
                              <option value="goalkeeper">Goalkeeper</option>
                              <option value="central_defender">Central Defender</option>
                              <option value="defender_right">Defender Right</option>
                              <option value="defender_left">Defender Left</option>
                              <option value="midfielder">Midfielder</option>
                              <option value="left_wing">Left Wing</option>
                              <option value="right_wing">Right Wing</option>
                              <option value="forward">Forward</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nationality" class="form-control-label">Nationality</label>
                            <input type="text" name="nationality" placeholder="Enter nationality" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="passport_type" class="form-control-label">Passport Type</label>
                            <select class="form-control" name="passport_type" id="passport_type">
                              <option value="">--Select Types--</option>
                              <option value="ordinary">Ordinary </option>
                              <option value="official">Official</option>
                              <option value="diplomatic">Diplomatic</option>
                              <option value="special">Special </option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="allergies" class="form-control-label">Allergies</label>
                            <select class="form-control" name="allergies" id="allergies">
                              <option value="">--Select---</option>
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                             
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label class="form-check-label" for="allergies">Player Have Allergie ? </label>
                            <br>
                            <div class="form-check-inline form-check">
                                <label for="yes" class="form-check-label mr-3 ">
                                    <input type="checkbox" id="yes"  class="form-check-input">Yes
                                </label>
                            </div>
                        </div>
                        <div class="form-group" style="display:none;" id="show_hide">
                            <input type="text" id="allergies_input" name="allergies" placeholder="Enter Type of Allergies" class="form-control">
                           
                        </div>

                       <div class="form-group">
                            <label for="gender" class="form-control-label">Gender</label>
                            <br>
                            {{-- radio --}}
                            <div class="form-check-inline form-check">
                                <label for="inline-radio1" class="form-check-label mr-3 ">
                                    <input type="radio" id="inline-radio1" name="gender"  value="male" class="form-check-input">Male
                                </label>
                                <label for="inline-radio2" class="form-check-label ">
                                    <input type="radio" id="inline-radio2" name="gender" value="female" class="form-check-input">Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- <div class="form-group">
                            <label for="is_passport_more_then_one" class="form-control-label">Multiple Passports</label>
                            <select class="form-control" name="is_passport_more_then_one" id="is_passport_more_then_one">
                              <option value="">--Select---</option>
                              <option value="yes">Yes</option>
                              <option value="no">No</option>
                            </select>
                        </div> --}}
                       

                        <div class="form-group">
                            <label for="current_club" class="form-control-label">Current Club</label>
                            <input type="text" name="current_club" placeholder="Enter current club" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="international_appearance" class="form-control-label">International Appearance</label>
                            <select class="form-control" name="international_appearance" id="international_appearance">
                                <option value="">--Select---</option>
                                <option value="full_cup">Full Cap</option>
                                <option value="under_21">Under 21's</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contract_length" class="form-control-label">Contract Length</label>
                            <input type="text" name="contract_length" placeholder="Enter contract length" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="football_group_player" class="form-control-label">Football Group Player</label>
                            <input type="text" name="football_group_player" placeholder="Enter football group player" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="blood_type" class="form-control-label">Blood Type</label>
                            <select class="form-control" name="blood_type" id="blood_type">
                              <option value="">--Select---</option>
                              <option value="a+">A+</option>
                              <option value="a-">A-</option>
                              <option value="b+">B+</option>
                              <option value="b-">B-</option>
                              <option value="ab+">AB+</option>
                              <option value="ab-">AB-</option>
                              <option value="o+">O+</option>
                              <option value="o-">O-</option>
                              
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <label for="previous_injuries" class="form-control-label">Previous Injuries</label>
                            <input type="text" name="previous_injuries" placeholder="Enter previous injuries" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="about_player" class="form-control-label">About Player</label>
                            <textarea name="about_player" cols="10" rows="1"  class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="other_info" class="form-control-label">Other Information</label>
                            <textarea name="other_info" cols="10" rows="2" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <input type="password" name="password"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="photo" class="form-control-label">Photo</label>
                            <input type="file" id="file-input" name="photo" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="video" class="form-control-label">Video</label>
                            <input type="text" id="file-input" name="video" placeholder="https://" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="form-check-label">Player Have Multiple Passports ? </label>
                            <br>
                            <div class="form-check-inline form-check">
                                <label for="multi_passport" class="form-check-label mr-3 ">
                                    <input type="checkbox" id="multi_passport"  class="form-check-input">Yes
                                </label>
                            </div>
                        </div>
                        <div class="form-group" style="display:none;" id="show_hide_multi_passport">
                            <textarea cols="10" rows="3" id="multi_passport_input" name="is_passport_more_then_one" placeholder="Enter List of Passport" class="form-control"></textarea>
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

@section('script')
<script>
    $(document).ready(function(){
        //allergies
        $("#yes").change(function(){
            if($("#yes").is(":checked")){
                $("#show_hide").show();
            } else {
                $("#allergies_input").val("");
                $("#show_hide").hide();
                
            }
        });

        //multiple passport
        $("#multi_passport").change(function(){
            if($("#multi_passport").is(":checked")){
                $("#show_hide_multi_passport").show();
            } else {
                $("#multi_passport_input").val("");
                $("#show_hide_multi_passport").hide();
            }
        });
    });
</script>
@endsection