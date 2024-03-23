<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Mail\StaffStatusUpdated;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendStaffStatusUpdatedEmail;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $user = Auth::user();
        $collectionOfRoles = Role::get();
        if($user->hasAllRoles($collectionOfRoles) || auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner') ){
            $players = Player::with('user')->orderBy('id', 'desc')->get();
            return view('partials.players.index', compact('players','collectionOfRoles'));
        }else{
            $player = User::where('id',Auth::user()->id)->with('player.medical_info')->first();
            return view('partials.players.index', compact('player','collectionOfRoles'));
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partials.players.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'age' => 'required',
            'dob' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'favourite_foot' => 'required',
            'position' => 'required',
            'nationality' => 'required',
            'passport_type' => 'required',
            // 'allergies' => 'required',
            // 'is_passport_more_then_one' => 'required',
            'current_club' => 'required',
            'international_appearance' => 'required',
            'contract_length' => 'required',
            'football_group_player' => 'required',
            'blood_type' => 'required',
            'previous_injuries' => 'required',
            'about_player' => 'required',
            'other_info' => 'required',
            'password' => 'required',
            'video' => 'required',
            'phone' =>'required',
            'address' => 'required',
            'player_represent' => 'required',
            'gender' => 'required'
        ]);

        //handle photo
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $photo = $imageName;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photo,
        ]);

        //assign role
        $user->assignRole('player');
        //store data to players table
        $player = new \App\Models\Player();
        $player->user_id = $user->id;
        $player->name = $request->name;
        $player->phone = $request->phone;
        $player->address = $request->address;
        $player->age = $request->age;
        $player->dob = $request->dob;
        $player->height = $request->height;
        $player->weight = $request->weight;
        $player->favourite_foot = $request->favourite_foot;
        $player->position = $request->position;
        $player->nationality = $request->nationality;
        $player->passport_type = $request->passport_type;
        // $player->is_passport_more_then_one = $request->is_passport_more_then_one;
        //if request has is_passport_more_then_one
        $player->is_passport_more_then_one = $request->has('is_passport_more_then_one') ? $request->is_passport_more_then_one : 'N/A';

        $player->current_club = $request->current_club;
        $player->international_appearance = $request->international_appearance;
        $player->contract_length = $request->contract_length;
        $player->football_group_player = $request->football_group_player;
        $player->other_info = $request->other_info;
        $player->video = $request->video;
        $player->gender = $request->gender;
        $player->player_represent = $request->player_represent;
        $player->save();

        //medical info save
        $medical_info = new \App\Models\MedicalInfo();
        $medical_info->player_id = $player->id;
        $medical_info->blood_type = $request->blood_type;
         //if request has allergies
         if ($request->has('allergies')) {
            $medical_info->allergies = $request->allergies;
        }
        $medical_info->previous_injuries = $request->previous_injuries;
        $medical_info->about_player = $request->about_player;
        $medical_info->save();

        return redirect()->route('player.index')->with('message', 'Player info saved successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $player = Player::with('user', 'medical_info')->findOrFail($id);
        // return $player;
        return view('partials.players.show', compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $player = Player::with('user', 'medical_info')->findOrFail($id);
        return view('partials.players.edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'dob' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'favourite_foot' => 'required',
            'position' => 'required',
            'nationality' => 'required',
            'passport_type' => 'required',
            // 'allergies' => 'required',
            // 'is_passport_more_then_one' => 'required',
            'current_club' => 'required',
            'international_appearance' => 'required',
            'contract_length' => 'required',
            'football_group_player' => 'required',
            'blood_type' => 'required',
            'previous_injuries' => 'required',
            'about_player' => 'required',
            'other_info' => 'required',
            'video' => 'required',
            'gender' => 'required',
            'phone' =>'required',
            'player_represent' =>'required',
            'address' => 'required'
        ]);

        // Find the user
        $user = Player::with('user', 'medical_info')->findOrFail($id);

        // Check if photo exists and delete it
        // Update photo if a new one is uploaded
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Delete old photo if it exists
            if ($user->user->photo) {
                $oldPhotoPath = public_path('images/' . $user->user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Save new photo
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $user->user->photo = $imageName;
            $user->save();
        }

        // Update user password
        if ($request->filled('password')) {
            $user->user->password = Hash::make($request->password);
        }
        $user->user->name = $request->name;
        $user->user->save();

        // Update player data
        $player = $user;
        $player->name = $request->name;
        $player->phone = $request->phone;
        $player->address = $request->address;
        $player->age = $request->age;
        $player->dob = $request->dob;
        $player->height = $request->height;
        $player->weight = $request->weight;
        $player->favourite_foot = $request->favourite_foot;
        $player->position = $request->position;
        $player->nationality = $request->nationality;
        $player->passport_type = $request->passport_type;
        // $player->is_passport_more_then_one = $request->is_passport_more_then_one;
         //if request has is_passport_more_then_one
         $player->is_passport_more_then_one = $request->has('is_passport_more_then_one') ? $request->is_passport_more_then_one : 'N/A';

        $player->current_club = $request->current_club;
        $player->international_appearance = $request->international_appearance;
        $player->contract_length = $request->contract_length;
        $player->football_group_player = $request->football_group_player;
        $player->other_info = $request->other_info;
        $player->video = $request->video;
        $player->gender = $request->gender;
        $player->player_represent = $request->player_represent;
        $player->save();

        // Update medical info
        $medical_info = $player->medical_info;
        $medical_info->blood_type = $request->blood_type;
        //if request has allergies
        if ($request->has('allergies')) {
            $medical_info->allergies = $request->allergies;
        }
        $medical_info->previous_injuries = $request->previous_injuries;
        $medical_info->about_player = $request->about_player;
        $medical_info->save();
        return redirect()->route('player.index')->with('message', 'Player updated successfully');

    }
    public function adminApproveStatus($id, $newStatus)
    {
        $status = Player::with('user')->findOrFail($id);
        //update status
        $status->status = $newStatus;
        $status->save();
        // Dispatch the job to send the email
        // SendStaffStatusUpdatedEmail::dispatch($status);
        Mail::to($status->user->email)->send(new StaffStatusUpdated($status->status));
        return redirect()->route('player.index')->with('message', 'Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the player
        $player = Player::with('user')->findOrFail($id);
        // Delete old photo if it exists
        if ($player->user->photo) {
            $oldPhotoPath = public_path('images/' . $player->user->photo);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }
        // Delete the player
        $player->user->delete();
        $player->delete();

        // Redirect back with a success message
        return redirect()->route('player.index')->with('success', 'Player deleted successfully');
    }

    //write code for pdf export
    public function exportToPdf($id)
    {
        $user = Auth::user();
        $collectionOfRoles = Role::get();
        if($user->hasAllRoles($collectionOfRoles) || auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner')){
            $player = Player::with('user', 'medical_info')->findOrFail($id);
            $pdf = PDF::loadView('partials.players.pdf.admin_view_profile', compact('player','collectionOfRoles'))->setPaper('a4')->setWarnings(false);
            return $pdf->download('player_profile.pdf');
            
        }else{
            //Auth user only
            // return 'ok';
            $player = User::with('player')->findOrFail(Auth::user()->id);
            // return $player;
            $pdf = PDF::loadView('partials.players.pdf.profile', compact('player'))->setPaper('a4')->setWarnings(false);
            return $pdf->download('player_profile.pdf');

        }
    }

}
