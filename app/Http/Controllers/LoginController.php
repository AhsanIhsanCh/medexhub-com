<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class LoginController extends Controller
{
    public function loginRequest(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return view('landing');
            // return redirect()->route('dashboard');
        }
        else {
            echo "<div class='alert alert-danger' role='alert'>Password not Crrect</div>";
            return view('login/login');
        }
    }
    public function registerRequest(Request $request){
        $data = $request->validate([
            'u_fname' => 'required',
            'u_lname' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        $data['u_ut_id'] = '7';
        $data['u_jionip'] = $request->ip();
        $user = User::create($data);
        $Message1 = "Yes, the user account has been successfully created and registered in the system.<br><br>

<strong>Next Steps for the User</strong><br>

<strong>Email Verification:</strong> Check the registered inbox for a confirmation link to activate the account.<br>

<strong>Login Access:</strong> Use the newly created credentials to sign in to the platform.<br>

<strong>Profile Setup:</strong> Complete any remaining personal or security details in the user dashboard.";

$Message = "Account created successfully.\n\nNext Steps for the User\nEmail Verification: Check your inbox.";



        if($user)
            {
                return redirect()->route('login')->with(['success_register1' => $Message]);
            }
        else
            {
                return redirect()->route('register')->with(['error_profile2' => 'The new password must be different from the old password.']);
            }
    }














    

    public function adminRegisterSave(Request $request){
        $data = $request->validate([
            'u_fname' => 'required',
            'u_lname' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        $data['u_jionip'] = $request->ip();
        $user = User::create($data);
        if($user)
            {
                return redirect()->route('loginAdmin');
                // return response()->(['success' => true],200);
            }
        else
            {
                echo "no user added";
            }
    }
    public function adminLoginRequest(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('adminDashboard');
        }
        else {
            echo "<div class='alert alert-danger' role='alert'>Password not Crrect</div>";
            return view('admin/pages/login');
        }
    }
    public function dashboardPage(){
        if (Auth::check()) {
            return view('admin/index');
        } else {
            echo "<div class='alert alert-danger' role='alert'>User is not authenticated</div>";
            return view('admin/pages/login');
        }
    }
    public function logout(){
        Auth::logout();
        //return view('admin/pages/login');
        return view('landing');
    }




}




// $password = 'secretpassword';
        // echo $hashedPassword = Hash::make($password);
        // echo "<br>";
        // echo $username = $request->input('email');
        // echo $Password = $request->input('password');


        // $user = Auth::user(); // Retrieve the authenticated user object
        //     $userId = Auth::id(); // Retrieve the authenticated user's ID