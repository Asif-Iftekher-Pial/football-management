<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Player;
use App\Models\Manager;
use App\Mail\AdminNotify;
use App\Jobs\AdminAlertJob;
use App\Models\FootballClub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Jobs\AdminAlertJobForManager;
use App\Mail\AdminAlertForManagerMail;

class PickUserController extends Controller
{
    public function playerList()
    {
        $players = Player::with('user')->where('status','approved')->get();
        return view('partials.pick_user.player_index',compact('players'));
    }

     public function managerList()
    {
        $managers = Manager::with('user')->where('status','approved')->get();
        return view('partials.pick_user.pick_manager.manager_index',compact('managers'));
    }



    public function show($id)
    {
        $player = Player::with('user','medical_info')->findOrFail($id);
        return view('partials.pick_user.show',compact('player'));
    }

    public function manager_show($id)
    {
        $manager = Manager::with('user')->findOrFail($id);
        return view('partials.pick_user.pick_manager.show',compact('manager'));
    }


    public function exportToPdf($id)
    {
        $user = Auth::user();
       
        //Auth user only
        // return 'ok';
        $player = Player::with('user','medical_info')->findOrFail($id);
        // return $player;
        $pdf = PDF::loadView('partials.pick_user.pdf.profile', compact('player','user'))->setPaper('a4')->setWarnings(false);
        return $pdf->download('player_profile.pdf');

    }
    public function manager_exportToPdf($id)
    {
        $user = Auth::user();
       
        //Auth user only
        // return 'ok';
        $manager = Manager::with('user')->findOrFail($id);
        // return $player;
        $pdf = PDF::loadView('partials.pick_user.pick_manager.pdf.profile', compact('manager','user'))->setPaper('a4')->setWarnings(false);
        return $pdf->download('manager_profile.pdf');

    }


    //select player
    public function player_pick($id)
    {
         // Assuming you're passing $playerId from your player list
        $player = Player::find($id);
        if (!$player) {
            // Handle case where player with the given ID doesn't exist
            return redirect()->back()->withErrors( 'Player not found.');
        }

        // Get the authenticated user's club ID
        $clubId = Auth::user()->football_club->id;
        // Create a new record in the club_player pivot table
        $club = FootballClub::find($clubId);
        if ($club->players()->wherePivot('player_id', $id)->exists()) {
            return redirect()->back()->withErrors( 'This Player is already selected by your club.Wait for admin review');
        }
    
        $club->players()->attach($id, ['user_id' => 1]);
        $admin = User::where('id',1)->first();

        

        //send mail
        // AdminAlertJob::dispatch($club,$admin,$player);
        Mail::to($admin->email)->send(new AdminNotify($club,$player));
        return redirect()->back()->with('message', 'Player selected for your club successfully.Wait for admin nagotiation with player');
    }



     //select Manager
     public function manager_pick($id)
    {
        // Assuming you're passing $playerId from your player list
        $manager = Manager::find($id);

        if (!$manager) {
            // Handle case where player with the given ID doesn't exist
            return redirect()->back()->withErrors( 'Manager not found.');
        }

        // Get the authenticated user's club ID
        $clubId = Auth::user()->football_club->id;
        // Create a new record in the club_player pivot table
        $club = FootballClub::find($clubId);
        if ($club->managers()->wherePivot('manager_id', $id)->exists()) {
            return redirect()->back()->withErrors( 'This Manager is already selected by your club.Wait for admin review');
        }
    
        $club->managers()->attach($id, ['user_id' => 1]);
        $admin = User::where('id',1)->first();

        //send mail
        // AdminAlertJobForManager::dispatch($manager,$club,$admin);

        Mail::to($admin->email)->send(new AdminAlertForManagerMail($club,$manager));

        return redirect()->back()->with('message', 'Manager selected for your club successfully.Wait for admin negotiation with manager');
    }

    public function selectedPlayerListByClubs()
    {
        $players = Player::get();
        return view('partials.selected_players_by_clubs.players',compact('players'));
    }


    //managers
    public function selectedManagerListByClubs()
    {
        $managers = Manager::get();
        return view('partials.selected_managers_by_clubs.managers',compact('managers'));
    }

    public function selectedPlayerByClubs($id)
    {
        $all_clubs_of_player = Player::with('clubs.user')->findOrFail($id);
        return view('partials.selected_players_by_clubs.club_list',compact('all_clubs_of_player'));
    }

    public function selectedManagerByClubs($id)
    {
        $all_clubs_of_manager = Manager::with('clubs.user')->findOrFail($id);
        return view('partials.selected_managers_by_clubs.club_list',compact('all_clubs_of_manager'));
    }





    public function removeCLubFromPlayer($player_id,$club_id)
    {
        $player = Player::findOrFail($player_id);
        // Detach the player from the club with the specified club ID
        $player->clubs()->detach($club_id);
        return redirect()->back()->with('message', 'Club removed from player successfully.');

    }

    public function removeCLubFromManager($manager_id,$club_id)
    {
        $manager = Manager::findOrFail($manager_id);
        // Detach the player from the club with the specified club ID
        $manager->clubs()->detach($club_id);
        return redirect()->back()->with('message', 'Club removed from manager successfully.');

    }



}
