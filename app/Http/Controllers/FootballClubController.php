<?php

namespace App\Http\Controllers;

use App\Jobs\SendPaymentLinkJob;
use App\Models\User;
use App\Models\FootballClub;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendStaffStatusUpdatedEmail;
use PDF;
class FootballClubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $user = Auth::user();
        $collectionOfRoles = Role::get();
        if($user->hasAllRoles($collectionOfRoles) || auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner')  ){
            $all_football_clubs = FootballClub::with('user')->orderBy('id', 'desc')->get();
            return view('partials.football_club.index', compact('all_football_clubs','collectionOfRoles'));
        }else{
            $football_club = User::where('id',Auth::user()->id)->with('football_club')->first();
            return view('partials.football_club.index', compact('football_club','collectionOfRoles'));
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partials.football_club.create');
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
        return  redirect()->route('football-club.index')->with('message','Club created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $club = FootballClub::with('user')->findOrFail($id);
        // return $player;
        return view('partials.football_club.show', compact('club'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $club = FootballClub::with('user')->findOrFail($id);
        return view('partials.football_club.edit', compact('club'));
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
            "name" => 'required',
            "contact" => 'required',
            "address" => 'required',
            "website" => 'required',
            "phone" => 'required',
            "country" => 'required',
        ]);

        // Find the user
        $user = FootballClub::with('user')->findOrFail($id);
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

        // Update manager data
        $manager = $user;
        $manager->name = $request->name;
        $manager->phone = $request->phone;
        $manager->contact = $request->contact;
        $manager->address = $request->address;
        $manager->country = $request->country;
        $manager->website = $request->website;
        $manager->save();
        return redirect()->route('football-club.index')->with('message', 'Club updated successfully');

    }
    public function adminApproveStatusOfFootballClub($id, $newStatus)
    {
        $status = FootballClub::with('user')->findOrFail($id);
        //update status
        $status->status = $newStatus;
        $status->save();
        // Dispatch the job to send the email
        SendStaffStatusUpdatedEmail::dispatch($status);
        return redirect()->route('football-club.index')->with('message', 'Status updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     // Find the player
    //     $manager = Manager::with('user')->findOrFail($id);
    //     // Delete old photo if it exists
    //     if ($manager->user->photo) {
    //         $oldPhotoPath = public_path('images/' . $manager->user->photo);
    //         if (file_exists($oldPhotoPath)) {
    //             unlink($oldPhotoPath);
    //         }
    //     }
    //     // Delete the player
    //     $manager->user->delete();
    //     $manager->delete();

    //     // Redirect back with a success message
    //     return redirect()->route('manager.index')->with('success', 'Manager deleted successfully');
    // }

    //write code for pdf export
    public function exportToPdf($id)
    {
        $user = Auth::user();
        $collectionOfRoles = Role::get();
        if($user->hasAllRoles($collectionOfRoles) || auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner')){
            $club = FootballClub::with('user')->findOrFail($id);
            $pdf = PDF::loadView('partials.football_club.pdf.admin_view_profile', compact('club','collectionOfRoles'))->setPaper('a4')->setWarnings(false);
            return $pdf->download('club_profile.pdf');
            
        }else{
            //Auth user only
            // return 'ok';
            $club = User::with('football_club')->findOrFail(Auth::user()->id);
            // return $club;
            $pdf = PDF::loadView('partials.football_club.pdf.profile', compact('club'))->setPaper('a4')->setWarnings(false);
            return $pdf->download('clubr_profile.pdf');

        }
    }


    public function sendPaypalPaymentLink($id)
    {
        $user = User::where('id',$id)->first();
        $user_email = $user->email;
        $user_name = $user->name;
        
        SendPaymentLinkJob::dispatch($user_email,$user_name);
        return redirect()->back()->with('message','Payment request has been sent to this user');
    }

}

