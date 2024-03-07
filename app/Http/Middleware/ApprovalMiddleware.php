<?php

namespace App\Http\Middleware;

use App\Models\FootballGroupStaff;
use App\Models\GroupPartner;
use App\Models\Manager;
use App\Models\OtherFootballJobs;
use App\Models\Player;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //get auth user
        $user = Auth::user();
        // dd($user);
        // get the FootballGroupStaff info of auth user
        $status_of_football_group = FootballGroupStaff::where('user_id', $user->id)->first();
        $status_of_football_group_partner = GroupPartner::where('user_id', $user->id)->first();
        //same for Player
        $status_of_player = Player::where('user_id', $user->id)->first();
        $status_of_manager = Manager::where('user_id', $user->id)->first();
        $status_of_football_job = OtherFootballJobs::where('user_id', $user->id)->first();

        if ($status_of_football_group !== null) {
            if ($status_of_football_group->status == 'approved') {
                return $next($request);
            }
            return redirect()->route('blockMessage');
        } elseif ($status_of_football_group_partner !== null) {
            if ($status_of_football_group_partner->status == 'approved') {
                return $next($request);
            }
            return redirect()->route('blockMessage');
        } elseif ($status_of_player !== null) {
            if ($status_of_player->status == 'approved') {
                return $next($request);
            }
            return redirect()->route('blockMessage');
        } elseif ($status_of_manager !== null) {
            if ($status_of_manager->status == 'approved') {
                return $next($request);
            }
            return redirect()->route('blockMessage');
        }
         elseif ($status_of_football_job !== null) {
            if ($status_of_football_job->status == 'approved') {
                return $next($request);
            }
            return redirect()->route('blockMessage');
        }


    }
}
