<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }
    public function profil_client($id){
        $profile=DB::table('clients')->where('id',$id)->first();
        return view('profile.client-profil',compact('profile'));
    }
    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }
    public function changeImage()
    {   
        
        // $client=Client::find($request->id);
        // $file=$request->myfile;
        // $filename = time().'.png';
        // // $file->move('uploads/profil',$filename);
        // $client->image=$filename;
        // $client->save();
        $filename=$_FILES['file']['name'];
        $location = 'uploads/profil/'.$filename;
        move_uploaded_file($_FILES['file']['tmp_name'],$location);
        return response()->json(['success'=>'Status change successfully.']);
    }
}
