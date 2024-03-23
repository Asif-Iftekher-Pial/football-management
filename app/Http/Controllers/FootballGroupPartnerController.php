<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use App\Models\GroupPartner;
use Illuminate\Http\Request;
use App\Mail\StaffStatusUpdated;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendStaffStatusUpdatedEmail;

class FootballGroupPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $collectionOfRoles = Role::get();
        $football_group_staffs =GroupPartner::with('user')->orderBy('id','desc')->get();
        
        // return $football_group_staffs;
        return view('partials.group_partner.index',compact('collectionOfRoles','football_group_staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partials.group_partner.create');
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
            'agent_number' => $request->agent_number,
        ]);
        return redirect()->route('group-partner.index')->with('message', 'Football Group Partner created successfully');
        
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
        $football_group_partner = GroupPartner::find($id);
        // return $football_group_staff;
        return view('partials.group_partner.edit',compact('football_group_partner')); 
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
            'address' => 'required',
            'country' => 'required',
            'telephone' => 'required',
            'contact' => 'required',
            'website' => 'required',
        ]);
    
        $partner = GroupPartner::with('user')->findOrFail($id);
        // return $staff;
        // Update user data if email is changed
        $user = $partner->user;
        if($request->password){
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->save();
        }
        
    
        // Update photo if a new one is uploaded
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Delete old photo if it exists
            if ($user->photo) {
                $oldPhotoPath = public_path('images/' . $user->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
    
            // Save new photo
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $user->photo = $imageName;
            $user->save();
        }
    
        // Update staff data
        $partner->update([
            'name' => $request->name,
            'address' => $request->address,
            'country' => $request->country,
            'telephone' => $request->telephone,
            'contact' => $request->contact,
            'website' => $request->website,
            'agent_number' => $request->agent_number,
        ]);
    
        return redirect()->route('group-partner.index')->with('message', 'Football Group partner updated successfully');
    }

    public function adminApproveStatus($id,$newStatus)
    {
        $status = GroupPartner::with('user')->findOrFail($id);
        //update status
        $status->status = $newStatus;
        $status->save();
        // Dispatch the job to send the email
        // SendStaffStatusUpdatedEmail::dispatch($status);
        Mail::to($status->user->email)->send(new StaffStatusUpdated($status->status));
        return redirect()->route('group-partner.index')->with('message', 'Football Group partner status updated successfully');
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

    public function exportToPdf($id)
    {
        $football_group = GroupPartner::with('user')->findOrFail($id);
        $pdf = PDF::loadView('partials.group_partner.pdf.profile', compact('football_group'))->setPaper('a4')->setWarnings(false);
        return $pdf->download('football_group.pdf');
    }
}
