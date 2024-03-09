<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Player;
use App\Models\Manager;
use App\Models\FootballClub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickUserController extends Controller
{
    public function playerList()
    {
        $players = Player::with('user')->get();
        return view('partials.pick_user.player_index',compact('players'));
    }

     public function managerList()
    {
        $managers = Manager::with('user')->get();
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
            return redirect()->back()->withErrors( 'Player already selected by your club.');
        }
    
        $club->players()->attach($id, ['user_id' => 1]);


        //send mail


        return redirect()->back()->with('message', 'Player selected for your club successfully.');
    }
}
