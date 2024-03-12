<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\Manager;
use Illuminate\Http\Request;
use App\Mail\StaffStatusUpdated;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendStaffStatusUpdatedEmail;

class ManagerController extends Controller
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
            $managers = Manager::with('user')->orderBy('id', 'desc')->get();
            return view('partials.manager.index', compact('managers','collectionOfRoles'));
        }else{
            $manager = User::where('id',Auth::user()->id)->with('manager')->first();
            return view('partials.manager.index', compact('manager','collectionOfRoles'));
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partials.manager.create');
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
        return redirect()->route('manager.index')->with('message', 'Manager info saved successfully');

        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            return back()->withErrors(['message'=>$e->getMessage()]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manager = Manager::with('user')->findOrFail($id);
        // return $player;
        return view('partials.manager.show', compact('manager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manager = Manager::with('user')->findOrFail($id);
        return view('partials.manager.edit', compact('manager'));
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
            'name' => 'required|string|max:255',
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

        // Find the user
        $user = Manager::with('user')->findOrFail($id);
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
        return redirect()->route('manager.index')->with('message', 'manager updated successfully');

    }
    public function adminApproveStatusOfManager($id, $newStatus)
    {
        $status = Manager::with('user')->findOrFail($id);
        //update status
        $status->status = $newStatus;
        $status->save();
        // Dispatch the job to send the email
        // SendStaffStatusUpdatedEmail::dispatch($status);
        Mail::to($status->user->email)->send(new StaffStatusUpdated($status->status));
        return redirect()->route('manager.index')->with('message', 'Status updated successfully');
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
        $manager = Manager::with('user')->findOrFail($id);
        // Delete old photo if it exists
        if ($manager->user->photo) {
            $oldPhotoPath = public_path('images/' . $manager->user->photo);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }
        // Delete the player
        $manager->user->delete();
        $manager->delete();

        // Redirect back with a success message
        return redirect()->route('manager.index')->with('success', 'Manager deleted successfully');
    }

    //write code for pdf export
    public function exportToPdf($id)
    {
        $user = Auth::user();
        $collectionOfRoles = Role::get();
        if($user->hasAllRoles($collectionOfRoles) || auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner')){
            $manager = Manager::with('user')->findOrFail($id);
            $pdf = PDF::loadView('partials.manager.pdf.admin_view_profile', compact('manager','collectionOfRoles'))->setPaper('a4')->setWarnings(false);
            return $pdf->download('manager_profile.pdf');
            
        }else{
            //Auth user only
            // return 'ok';
            $manager = User::with('manager')->findOrFail(Auth::user()->id);
            // return $player;
            $pdf = PDF::loadView('partials.manager.pdf.profile', compact('manager'))->setPaper('a4')->setWarnings(false);
            return $pdf->download('manager_profile.pdf');

        }
    }

}
