<?php

namespace App\Http\Controllers;

use App\Models\FootballGroupStaff;
use App\Models\GroupPartner;
use App\Models\Manager;
use App\Models\OtherFootballJobs;
use App\Models\Player;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
