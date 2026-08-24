<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class ProfileController extends Controller
{
    function profile(){
        $userId = auth()->id();
        return view('dashboard/other/profile',['u_id' => $userId]);
    }
    function SaveAccountDetails(Request $request){
        $userId = auth()->id();
        $FName = $request->input('TextFname');
        $Lname = $request->input('TextLname');
        $Gender = $request->input('TextGender');
        $Dob = $request->input('TextDob');
        DB::table('users')->where('id', $userId)->update(['u_fname' => $FName,'u_lname' => $Lname,'u_gender' => $Gender,'u_dob' => $Dob, 'updated_at' => Carbon::now()]);
        return redirect()->back()->with('success_profile1', 'Account details changed successfully .');
    }
    function UpdatePassword(Request $request){
        $userId = auth()->id();
        $User = DB::table('users')->select('password')->where('id', $userId)->get();
        if ($request->password !== $request->password_confirmation)
            {
                return redirect()->back()->with('error_profile3', 'New password and confirm password do not match.')->withInput();
            }
        $request->validate([
            'old_password' => ['required'],
            'password' => ['required','string','min:8','confirmed'],
            ]);
        // Check old password
        if (!Hash::check($request->old_password, $User->first()->password))
            {
               return redirect()->back()->with('error_profile1', 'The old password is incorrect .');
            }
        // Prevent using the same password
        if (Hash::check($request->password, $User->first()->password)) 
            {
                return redirect()->back()->with(['error_profile2' => 'The new password must be different from the old password.']);
            }
        $NewPass = Hash::make($request->password);
        DB::table('users')->where('id', $userId)->update(['password' => $NewPass, 'updated_at' => Carbon::now()]);
        return redirect()->back()->with('success_profile2', 'Password changed successfully.');
    }
    function UpdateSettings(Request $request){
        $userId = auth()->id();
        $NameSafety = $request->input('TextNameSafety');
        DB::table('users')->where('id', $userId)->update(['u_name_safety' => $NameSafety,'updated_at' => Carbon::now()]);
        return redirect()->back()->with('success_profile3', 'Settings changed successfully .');
    }
}
