<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\StaffStatusUpdated;
use App\Models\OtherFootballJobs;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendStaffStatusUpdatedEmail;

class OtherFootballJobsController extends Controller
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
            $otherFootballJobs = OtherFootballJobs::with('user')->orderBy('id', 'desc')->get();
            return view('partials.other_football_jobs.index', compact('otherFootballJobs','collectionOfRoles'));
        }else{
            $other_football_job = User::where('id',Auth::user()->id)->with('other_football_job')->first();
            return view('partials.other_football_jobs.index', compact('other_football_job','collectionOfRoles'));
        }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partials.other_football_jobs.create');
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
        return redirect()->route('other-football-job.index')->with('message', 'Footbal job info saved successfully');

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
        $football_job = OtherFootballJobs::with('user')->findOrFail($id);
        // return $player;
        return view('partials.other_football_jobs.show', compact('football_job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $football_job = OtherFootballJobs::with('user')->findOrFail($id);
        return view('partials.other_football_jobs.edit', compact('football_job'));
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
            'about_you' => 'required',
            'dob' => 'required|date',
            'position' => 'required|string|max:255',
            'experience' => 'required',
        ]);

        // Find the user
        $user = OtherFootballJobs::with('user')->findOrFail($id);
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
        $football_job = $user;
        $football_job->name = $request->name;
        $football_job->phone = $request->phone;
        $football_job->address = $request->address;
        $football_job->dob = $request->dob;
        $football_job->position = $request->position;
        $football_job->about_you = $request->about_you;
        $football_job->experience = $request->experience;
        $football_job->save();
        return redirect()->route('other-football-job.index')->with('message', 'Football job updated successfully');

    }
    public function adminApproveStatusOfOtherFootballJob($id, $newStatus)
    {
        $status = OtherFootballJobs::with('user')->findOrFail($id);
        //update status
        $status->status = $newStatus;
        $status->save();
        // Dispatch the job to send the email
        // SendStaffStatusUpdatedEmail::dispatch($status);
        Mail::to($status->user->email)->send(new StaffStatusUpdated($status->status));
        return redirect()->route('other-football-job.index')->with('message', 'Status updated successfully');
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
        $football_job = OtherFootballJobs::with('user')->findOrFail($id);
        // Delete old photo if it exists
        if ($football_job->user->photo) {
            $oldPhotoPath = public_path('images/' . $football_job->user->photo);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }
        // Delete the player
        $football_job->user->delete();
        $football_job->delete();

        // Redirect back with a success message
        return redirect()->route('other-football-job.index')->with('success', 'Football job deleted successfully');
    }

    //write code for pdf export
    public function exportToPdf($id)
    {
        $user = Auth::user();
        $collectionOfRoles = Role::get();
        if($user->hasAllRoles($collectionOfRoles) || auth()->user()->hasRole('football_group_staff') || auth()->user()->hasRole('partner')){
            $football_job = OtherFootballJobs::with('user')->findOrFail($id);
            $pdf = PDF::loadView('partials.other_football_jobs.pdf.admin_view_profile', compact('football_job','collectionOfRoles'))->setPaper('a4')->setWarnings(false);
            return $pdf->download('football_job_profile.pdf');
            
        }else{
            //Auth user only
            // return 'ok';
            $other_football_job = User::with('other_football_job')->findOrFail(Auth::user()->id);
            // return $player;
            $pdf = PDF::loadView('partials.other_football_jobs.pdf.profile', compact('other_football_job'))->setPaper('a4')->setWarnings(false);
            return $pdf->download('football_job_profile.pdf');

        }
    }

}