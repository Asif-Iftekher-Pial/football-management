@extends('master.master')
@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Player Informations</strong>
        </div>
        <div class="card-body card-block">
            <form action="{{ route('player.update',$player->id) }}" method="post" enctype="multipart/form-data">
                @method('patch')
                @csrf
                @include('layouts.errorAndSuccessMessage')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="form-control-label">Name</label>
                            <input type="text" name="name" value="{{ $player->name }}" placeholder="Enter name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="age" class="form-control-label">Age</label>
                            <input type="number" name="age" value="{{ $player->age }}" placeholder="Enter age" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="form-control-label">Phone</label>
                            <input type="number" name="phone" value="{{ $player->phone }}" placeholder="Enter phpne number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address" class="form-control-label">Address</label>
                            <input type="text" name="address" value="{{ $player->address }}" placeholder="Enter address" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="dob" class="form-control-label">Date of Birth</label>
                            <input type="date" name="dob" value="{{ $player->dob }}" placeholder="Enter date of birth" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="height" class="form-control-label">Height</label>
                            <input type="number" name="height" value="{{ $player->height }}" placeholder="Enter height" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="weight" class="form-control-label">Weight</label>
                            <input type="number" name="weight"  value="{{ $player->weight }}" placeholder="Enter weight" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="foot" class="form-control-label">Favourite Foot</label>
                            <select class="form-control" name="favourite_foot" id="foot">
                              <option value="left" {{ $player->favourite_foot == 'left' ? 'selected' : '' }}>Left</option>
                              <option value="right" {{ $player->favourite_foot == 'right' ? 'selected' : '' }}>Right</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="position" class="form-control-label">Position</label>
                            <select class="form-control" name="position" id="position">
                              <option value="">--Select Position--</option>
                              <option value="goalkeeper" {{ $player->position == 'goalkeeper' ? 'selected' : '' }}>Goalkeeper</option>
                              <option value="central_defender" {{ $player->position == 'central_defender' ? 'selected' : '' }}>Central Defender</option>
                              <option value="defender_right"{{ $player->position == 'defender_right' ? 'selected' : '' }}>Defender Right</option>
                              <option value="defender_left" {{ $player->position == 'defender_left' ? 'selected' : '' }}>Defender Left</option>
                              <option value="midfielder" {{ $player->position == 'midfielder' ? 'selected' : '' }}>Midfielder</option>
                              <option value="left_wing" {{ $player->position == 'left_wing' ? 'selected' : '' }}>Left Wing</option>
                              <option value="right_wing" {{ $player->position == 'right_wing' ? 'selected' : '' }}>Right Wing</option>
                              <option value="forward" {{ $player->position == 'forward' ? 'selected' : '' }}>Forward</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nationality" class="form-control-label">Nationality</label>
                            <input type="text" name="nationality" value="{{ $player->nationality }}" placeholder="Enter nationality" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="passport_type" class="form-control-label">Passport Type</label>
                            <select class="form-control" name="passport_type" id="passport_type">
                              <option value="">--Select Types--</option>
                              <option value="ordinary" {{ $player->passport_type == 'ordinary' ? 'selected' : '' }}>Ordinary </option>
                              <option value="official" {{ $player->passport_type == 'official' ? 'selected' : '' }}>Official</option>
                              <option value="diplomatic" {{ $player->passport_type == 'diplomatic' ? 'selected' : '' }}>Diplomatic</option>
                              <option value="special" {{ $player->passport_type == 'special' ? 'selected' : '' }}>Special </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="allergies" class="form-control-label">Allergies</label>
                            <input type="text" id="allergies_input" value="{{ $player->medical_info->allergies }}" name="allergies" placeholder="Enter Type of Allergies" class="form-control">
                           
                        </div>
                        <div class="form-group">
                            <label for="gender" class="form-control-label">Gender</label>
                            <br>
                            {{-- radio --}}
                            <div class="form-check-inline form-check">
                                <label for="inline-radio1" class="form-check-label mr-3 ">
                                    <input type="radio" id="inline-radio1" name="gender" {{ $player->gender == 'male' ? 'checked' :'' }}  value="male" class="form-check-input">Male
                                </label>
                                <label for="inline-radio2" class="form-check-label ">
                                    <input type="radio" id="inline-radio2" name="gender" {{ $player->gender == 'female' ? 'checked' :'' }} value="female" class="form-check-input">Female
                                </label>
                            </div>
                        </div>
                        <div class="form-check">
                            <label for="player_represent1" class="form-check-label mr-3 ">
                                <input type="radio" id="player_represent1" name="player_represent" {{ $player->player_represent == 'Representa on Football Group Player' ? 'checked' :'' }} value="Representa on Football Group Player" class="form-check-input">Representa on Football Group Player
                            </label>
                            <br>
                            <label for="player_represent2" class="form-check-label ">
                                <input type="radio" id="player_represent2" name="player_represent" {{ $player->player_represent == 'Football Group Have Mandate for Player' ? 'checked' :'' }} value="Football Group Have Mandate for Player" class="form-check-input">Football Group Have Mandate for Player
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{-- <div class="form-group">
                            <label for="is_passport_more_then_one" class="form-control-label">Multiple Passports</label>
                            <select class="form-control" name="is_passport_more_then_one" id="is_passport_more_then_one">
                              <option value="">--Select---</option>
                              <option value="yes" {{ $player->is_passport_more_then_one == 'yes' ? 'selected' : '' }}>Yes</option>
                              <option value="no" {{ $player->is_passport_more_then_one == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="current_club" class="form-control-label">Current Club</label>
                            <input type="text" name="current_club" value="{{ $player->current_club }}" placeholder="Enter current club" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="international_appearance" class="form-control-label">International Appearance</label>
                            <select class="form-control" name="international_appearance" id="international_appearance">
                                <option value="">--Select---</option>
                                <option value="full_cup" {{ $player->international_appearance == 'full_cup' ? 'selected' :'' }}>Full Cap</option>
                                <option value="under_21" {{ $player->international_appearance == 'under_21' ? 'selected' :'' }}>Under 21's</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contract_length" class="form-control-label">Contract Length</label>
                            <input type="text" name="contract_length" value="{{ $player->contract_length }}" placeholder="Enter contract length" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="football_group_player" class="form-control-label">Football Group Player</label>
                            <input type="text" name="football_group_player" value="{{ $player->football_group_player }}" placeholder="Enter football group player" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="blood_type" class="form-control-label">Blood Type</label>
                            <select class="form-control" name="blood_type" id="blood_type">
                              <option value="">--Select---</option>
                              <option value="a+" {{ $player->medical_info->blood_type == 'a+' ? 'selected' : '' }}>A+</option>
                              <option value="a-" {{ $player->medical_info->blood_type == 'a-' ? 'selected' : '' }}>A-</option>
                              <option value="b+" {{ $player->medical_info->blood_type == 'b+' ? 'selected' : '' }}>B+</option>
                              <option value="b-" {{ $player->medical_info->blood_type == 'b-' ? 'selected' : '' }}>B-</option>
                              <option value="ab+" {{ $player->medical_info->blood_type == 'ab+' ? 'selected' : '' }}>AB+</option>
                              <option value="ab-" {{ $player->medical_info->blood_type == 'ab-' ? 'selected' : '' }}>AB-</option>
                              <option value="o+" {{ $player->medical_info->blood_type == 'o+' ? 'selected' : '' }}>O+</option>
                              <option value="o-" {{ $player->medical_info->blood_type == 'o-' ? 'selected' : '' }}>O-</option>
                              
                            </select>
                        </div>
                       
                        <div class="form-group">
                            <label for="previous_injuries" class="form-control-label">Previous Injuries</label>
                            <input type="text" name="previous_injuries" value="{{ $player->medical_info->previous_injuries }}" placeholder="Enter previous injuries" class="form-control">
                        </div>
                       
                        <div class="form-group">
                            <label for="other_info" class="form-control-label">Other Information</label>
                            <input name="other_info" value="{{ $player->other_info }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <input type="password" name="password" value="{{ $player->user->password }}"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="photo" class="form-control-label">Photo</label>
                            <input type="file" id="file-input"  name="photo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="video" class="form-control-label">Video</label>
                            <input type="text" value="{{ $player->video }}" name="video" placeholder="https://" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="about_player" class="form-control-label">About Player</label>
                            <textarea name="about_player" cols="10" rows="3"   placeholder="About Player Detail"  class="form-control">{{ $player->medical_info->about_player }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-check-label" for="allergies">Player Have Multiple Passports ? </label>
                        </div>
                        <div class="form-group"  id="show_hide_multi_passport">
                            <textarea cols="10" rows="3"  id="multi_passport_input"  name="is_passport_more_then_one" placeholder="Enter List of Passport" class="form-control">{{ $player->is_passport_more_then_one }}</textarea>
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