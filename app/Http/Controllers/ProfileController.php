<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;
use Image;

class ProfileController extends Controller
{
    function index(){
        return view('profile.index');
    }
    function namechange(Request $request){
        $user_id = Auth::id();
        $old_name = Auth::user()->name;
        $new_name = $request->name;
        User::find($user_id)->update([
            "name" => $new_name
        ]);
        return back()->with('status', 'Name '.$old_name. ' Changed Successfully to '.$new_name. '!');
    }
    function passwordchange(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);

        // strong password validation start
        $strong_value = preg_match('@[A-Z]@', $request->password). preg_match('@[a-z]@', $request->password). preg_match('@[0-9]@', $request->password);
        // strong password validation end
        if($strong_value != "111"){
            return back()->with('error', 'Your Password Is Not Strong! Your password must have 1 capital letter, 1 small letter, 1 number');
        }
        else{
            if (Hash::check($request->old_password, Auth::user()->password)) {
                User::find(Auth::id())->update([
                    'password' => bcrypt($request->password)
                ]);
                return back()->with('status', 'Password Changed Sucessfully!');
            } else {
                return back()->with('error', 'Old Password Does Not Match');
            }
        }
    }
    function photochange(Request $request){
        $request->validate([
            'new_profile_photo' => 'required|image|file|max:5000|dimensions:min_width=100,min_height=200'
        ]);
        $new_profile_photo = $request->file('new_profile_photo');
        $after_explode = explode('.', $new_profile_photo->getClientOriginalName());
        $new_profile_photo_name = $after_explode[0]."-".Auth::id() . "." . $new_profile_photo->getClientOriginalExtension();
        if(Auth::user()->profile_photo != "default.jpg"){
            $path = public_path() . "/uploads/profile_photos/" . Auth::user()->profile_photo;
            unlink($path);
        }
        Image::make($new_profile_photo)->save(base_path('public/uploads/profile_photos/' . $new_profile_photo_name));
        //database update start
        User::find(Auth::id())->update([
            'profile_photo' => $new_profile_photo_name
        ]);
            //database update end
        return back();
    }
}
