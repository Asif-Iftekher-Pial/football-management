<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Player;
use App\Models\Manager;
use App\Models\FootballClub;
use App\Models\GroupPartner;
use Illuminate\Http\Request;
use App\Models\OtherFootballJobs;
use App\Models\FootballGroupStaff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function dashboard()
    {
        $labels = [];
        $data = [];
        $test = User::get()
        ->groupBy(function($Item){
            return  Carbon::parse($Item->created_at)->format('F'); // grouping
        });

        // Loop through the months and populate labels and data arrays
        foreach ($test as $month => $items) {
            $labels[] = $month;
            $data[] = $items->count();
        }
        
        $chart_data = [
            'labels' => $labels,
            'data' => $data
        ];

        $total_users = User::count();
        $active_players = Player::where('status', 'approved')->count();
        $inactive_players = Player::where('status', 'not_approved')->count();
        $active_partners = GroupPartner::where('status', 'approved')->count();
        $inactive_partners = GroupPartner::where('status', 'not_approved')->count();
        $active_managers = Manager::where('status', 'approved')->count();
        $inactive_managers = GroupPartner::where('status', 'not_approved')->count();
        $active_football_staff = FootballGroupStaff::where('status', 'approved')->count();
        $inactive_football_staff = FootballGroupStaff::where('status', 'not_approved')->count();
        $jobs = OtherFootballJobs::where('status','approved')->count();
        $inactive_jobs = OtherFootballJobs::where('status','not_approved')->count();
        return view('partials.home.home',compact('active_players','inactive_players',
        'active_partners','inactive_partners','active_managers','inactive_managers',
        'active_football_staff','inactive_football_staff','chart_data','total_users',
        'jobs','inactive_jobs'
        ));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('partials.Auth.login');
    }

    public function job_registration(){
        return view('partials.Auth.registration_pages.jobs');
    }
    public function manager_registration(){
        return view('partials.Auth.registration_pages.manager');
    }
    public function partner_registration(){
        return view('partials.Auth.registration_pages.partner');
    }

    public function player_registration(){
        return view('partials.Auth.registration_pages.player');
    }
    public function staff_registration(){
        return view('partials.Auth.registration_pages.staff');
    }
    public function club_registration(){
        return view('partials.Auth.registration_pages.club');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function job_registration_submit(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'about_you' => 'required',
            'dob' => 'required|date',
            'position' => 'required|string|max:255',
            'experience' => 'required',
            'password' => 'required',
        ]);
        try {
            //handle photo
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $photo = $imageName;
        }
        DB::beginTransaction();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photo,
        ]);
        //assign role
        $user->assignRole('other_football_job');
        $football_job = new \App\Models\OtherFootballJobs();
        $football_job->user_id = $user->id;
        $football_job->name = $request->name;
        $football_job->phone = $request->phone;
        $football_job->address = $request->address;
        $football_job->dob = $request->dob;
        $football_job->position = $request->position;
        $football_job->about_you = $request->about_you;
        $football_job->experience = $request->experience;
        $football_job->save();
        
        
        DB::commit();
        return redirect()->route('login')->with('message', 'Registration successfull');

        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            return back()->withErrors(['message'=>$e->getMessage()]);
        }
        
    }
    public function manager_registration_submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'age' => 'required|numeric',
            'dob' => 'required',
            'nationality' => 'required|string|max:255',
            'football_club_manage' => 'required',
            'coaching_badges' => 'required',
            'qualification' => 'required',
            'honours' => 'required',
            'international_team_managed' => 'required',
            'video' => 'required',
        ]);

        try {
            //handle photo
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $photo = $imageName;
        }
        DB::beginTransaction();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $photo,
        ]);

        //assign role
        $user->assignRole('manager');
        //store data to players table
        $manager = new \App\Models\Manager();
        $manager->user_id = $user->id;
        $manager->name = $request->name;
        $manager->phone = $request->phone;
        $manager->address = $request->address;
        $manager->age = $request->age;
        $manager->dob = $request->dob;
        $manager->nationality = $request->nationality;
        $manager->football_club_manage = $request->football_club_manage;
        $manager->coaching_badges = $request->coaching_badges;
        $manager->qualification = $request->qualification;
        $manager->honours = $request->honours;
        $manager->international_team_managed = $request->international_team_managed;
        $manager->video = $request->video;
        $manager->save();
        
        DB::commit();
        return redirect()->route('login')->with('message', 'Registration successfully');

        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            return back()->withErrors(['message'=>$e->getMessage()]);
        }
        
    }
    public function player_registration_submit(Request $request)
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
            'gender' => 'required'
        ]);
        // return $request->all();
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
        //if request has is_passport_more_then_one
        $player->is_passport_more_then_one = $request->has('is_passport_more_then_one') ? $request->is_passport_more_then_one : 'N/A';

        
        $player->current_club = $request->current_club;
        $player->international_appearance = $request->international_appearance;
        $player->contract_length = $request->contract_length;
        $player->football_group_player = $request->football_group_player;
        $player->other_info = $request->other_info;
        $player->video = $request->video;
        $player->gender = $request->gender;
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

        return redirect()->route('login')->with('message', 'Player registration successfull');

    }
    public function partner_registration_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'country' => 'required',
            'telephone' => 'required',
            'contact' => 'required',
            'website' => 'required',

        ]);

        // store photo
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
        $user->assignRole('partner');
        GroupPartner::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'address' => $request->address,
            'country' => $request->country,
            'telephone' => $request->telephone,
            'contact' => $request->contact,
            'website' => $request->website,
        ]);
        return redirect()->route('login')->with('message', 'Football Group Partner registration successfull');
        
    }
    public function staff_registration_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'country' => 'required',
            'telephone' => 'required',
            'contact' => 'required',
            'website' => 'required',

        ]);

        // store photo
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
        $user->assignRole('football_group_staff');
        FootballGroupStaff::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'address' => $request->address,
            'country' => $request->country,
            'telephone' => $request->telephone,
            'contact' => $request->contact,
            'website' => $request->website,
        ]);
        return redirect()->route('login')->with('message', 'Football Group Staff registration successfull');
        
    }
    public function club_registration_submit(Request $request)
    { 
        $request->validate([
            "name" => 'required',
            "email" => 'required|email|unique:users,email',
            "contact" => 'required',
            "address" => 'required',
            "website" => 'required',
            "phone" => 'required',
            "country" => 'required',
        ]);
        // store photo
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
            'photo' => $photo
        ]);
        //assign role
        $user->assignRole('registered_football_club');
        FootballClub::create([
            'user_id'   => $user->id,
            'name'      => $request->name,
            'contact'   => $request->contact,
            'address'   => $request->address,
            'website'   => $request->website,
            'phone'     => $request->phone,
            'country'   => $request->country,
        ]);
        return  redirect()->route('login')->with('message','Club registration successfull');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials  = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) { //login attempt
            $request->session()->regenerate();

            if ($request->has('rememberMe')) {
                Cookie::queue('backendcookieNameEmail', $request->email, 1440); /* 1440 means cookie will clear after 24 hours*/
                Cookie::queue('backendcookieNamePassword', $request->password, 1440);
            }

            return redirect()->route('dashboard')->with('message', 'Login successful!');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('message', 'Logout successful!');

    }
}
