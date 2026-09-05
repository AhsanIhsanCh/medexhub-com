<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Mail\welcomeemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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
    
    // public function testMailRequest(){
    //     $toEmail = "ahsanihsan@gmail.com";
    //     $message = "Hello! This is a simple plain text email sent via PHP script.";
    //     $subject = "Test PHP Mail";
    //     $returnmailmessage = Mail::to($toEmail)->send(new welcomeemail($message,$subject));
    //     dd($returnmailmessage);
    // }
    //'email' => 'required|email|unique:users,email',
    
    public function registerRequest(Request $request){
        $requestData = $request->validate([
            'u_fname' => 'required',
            'u_lname' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ],
        [
            'u_fname.required' => 'First name is required.',
            'u_lname.required' => 'Last name is required.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter a new password.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password and confirm password do not match.',
        ]);
        $user = User::create([
            'u_fname' => $request->u_fname,
            'u_lname' => $request->u_lname,
            'u_ut_id' => 7,
            'u_jionip' => $request->ip(),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            ]);
        $verificationUrl = URL::temporarySignedRoute('verification.verify',now()->addMinutes(60),[
        'id' => $user->getKey(),
        'hash' => sha1($user->getEmailForVerification()),
        ]);




        
        $subject = 'New Registration';
        $message = '
            <h2>New Registration</h2>
            
            <p>We received a request to reset your password.</p>
            <p>
                <a href="' . $verificationUrl . '"
                   style="
                        background:#3769ac;
                        color:#ffffff;
                        padding:12px 20px;
                        text-decoration:none;
                        border-radius:5px;
                        display:inline-block;
                   ">
                    Reset Password
                </a>
            </p>
            <p>If you did not request a password reset, you can ignore this email.</p>
            <p>Regards,<br>
            MedExHub</p>
        ';
        $googleMail = new GoogleMailController();
        $result = $googleMail->sendGmail(
            $user->email,
            $subject,
            $message
        );
        return back()->with('success_fotgotpass', 'Password reset link has been sent to your email.');
    
    
        
    
    
        // $to = "ahsanihsan@gmail.com";
        // $subject = "Test PHP Mail";
        // $message = "Hello! This is a simple plain text email sent via PHP script.";

        // // Mandatory header: Defines the sender email
        // $headers = "From: webmaster@yourdomain.com" . "\r\n" .
        //         "Reply-To: support@yourdomain.com" . "\r\n" .
        //         "X-Mailer: PHP/" . phpversion();

        // if(mail($to, $subject, $message, $headers)) {
        //     echo "Email sent successfully!";
        // } else {
        //     echo "Email delivery failed.";
    
        // $toEmail = 'ahsanihsan@gmail.com';
        // Mail::raw('Your account has been successfully created.', function ($message) use ($toEmail) {
        //     $message->to($toEmail)->subject('Account Created Successfully');
        // });
        // return back()->with('success', 'Email sent successfully.');
        

        //         $data = $request->validate([
        //             'u_fname' => 'required',
        //             'u_lname' => 'required',
        //             'email' => 'required|email',
        //             'password' => 'required|confirmed',
        //             'updated_at' => Carbon::now(),
        //             'created_at' => Carbon::now(),
        //         ]);
        //         $data['u_ut_id'] = '7';
        //         $data['u_jionip'] = $request->ip();
        //         $user = User::create($data);
        //         $Message1 = "Yes, the user account has been successfully created and registered in the system.<br><br>

        // <strong>Next Steps for the User</strong><br>

        // <strong>Email Verification:</strong> Check the registered inbox for a confirmation link to activate the account.<br>

        // <strong>Login Access:</strong> Use the newly created credentials to sign in to the platform.<br>

        // <strong>Profile Setup:</strong> Complete any remaining personal or security details in the user dashboard.";

        // $Message = "Account created successfully.\n\nNext Steps for the User\nEmail Verification: Check your inbox.";



        //         if($user)
        //             {
        //                 return redirect()->route('login')->with(['success_register1' => $Message]);
        //             }
        //         else
        //             {
        //                 return redirect()->route('register')->with(['error_profile2' => 'The new password must be different from the old password.']);
        //             }
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