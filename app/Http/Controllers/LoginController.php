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
use App\Http\Controllers\GoogleMailController;
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
        }
        else {
            return redirect()->back()->with('error3s', 'Password not Crrect.');
        }
    }

    public function registerRequest(Request $request)
    {
        $requestData = $request->validate([
            'u_fname' => 'required',
            'u_lname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'g-recaptcha-response' => 'required|captcha',
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
        $Email = $request->input('email');
        $FName = $request->input('u_fname');
        $LName = $request->input('u_lname');
        //Register Email Design
        $subject = 'New Registration';
        $message = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Verify Your Email</title>
            </head>
            <body style="margin:0; padding:0; background:#f4f6f9; font-family:Arial, Helvetica, sans-serif;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f4f6f9; padding:40px 15px;">
                    <tr>
                        <td align="center">
                            <table width="600" cellpadding="0" cellspacing="0" border="0" style="width:100%;max-width:600px;background:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 4px 18px rgba(0,0,0,0.08);">
                                <!-- Header -->
                                <tr>
                                    <td align="center" style="padding:30px 20px;background: radial-gradient(circle at 88% 8%, rgba(255, 255, 255, .17), transparent 25%), radial-gradient(circle at 12% 110%, rgba(255, 255, 255, .10), transparent 35%), linear-gradient(135deg, #103f48 0%, #147d70 52%, #3778c2 100%);">
                                        <h1 style="margin:0;color:#ffffff;font-size:26px;font-weight:600;"><img src="https://medextech.com.au/theme_files/images/logo_image.png" width="100" alt="MedExHub"><br>MedExHub</h1>
                                    </td>
                                </tr>
                                <!-- Content -->
                                <tr>
                                    <td style="padding:40px 35px; color:#333333;">
                                        <h2 style="margin:0 0 20px;font-size:24px;color:#222222;text-align:center;">Verify Your Email Address </h2>
                                        <p style="margin:0 0 20px;font-size:16px;line-height:1.7;">Hi '.$FName.' '.$LName.',</p>
                                        <p style="margin:0 0 25px;font-size:16px;line-height:1.7;color:#555555;">
                                            Thank you for creating an account with MedExHub.
                                            Please verify your email address by clicking the button below.
                                        </p>
                                        <!-- Verify Button -->
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" style="padding:10px 0 30px;">
                                                    <a href="'.$verificationUrl.'" style="display:inline-block;background:#3769ac;color:#ffffff;text-decoration:none;padding:14px 30px;border-radius:6px;font-size:16px;font-weight:bold;">
                                                        Verify Email Address
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        <p style="margin:0 0 15px;font-size:14px;line-height:1.6;color:#777777;">
                                            If the button above does not work, copy and paste
                                            the following link into your browser:
                                        </p>
                                        <p style="margin:0 0 25px;font-size:13px;line-height:1.6;word-break:break-all;color:#3769ac;">'.$verificationUrl.'</p>
                                        <p style="margin:0;font-size:14px;line-height:1.6;color:#777777;">
                                            If you did not create this account, you can safely ignore this email.
                                            <br><br><br>Regards,
                                            <br>MedExHub
                                        </p>
                                    </td>
                                </tr>
                                <!-- Footer -->
                                <tr>
                                    <td align="center" style="background: #0d3037;padding:25px 20px;border-top:1px solid #eeeeee;">
                                        <p style="margin:0 0 8px;font-size:13px;color:#888888;">© '.date('Y').' MedExMed. All rights reserved.</p>
                                        <p style="margin:0;font-size:12px;color:#aaaaaa;">This is an automated email. Please do not reply.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            </html>
        ';
        $googleMail = new GoogleMailController();
        $result = $googleMail->sendGmail(
            $Email,
            $subject,
            $message
        );
        return back()->with('success_fotgotpass', 'Password reset link has been sent to your email.');
    }
    // public function adminRegisterSave(Request $request)
    // {
    //     $data = $request->validate([
    //         'u_fname' => 'required',
    //         'u_lname' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|confirmed',
    //         'updated_at' => Carbon::now(),
    //         'created_at' => Carbon::now(),
    //     ]);
    //     $data['u_jionip'] = $request->ip();
    //     $user = User::create($data);
    //     if($user)
    //         {
    //             return redirect()->route('loginAdmin');
    //             // return response()->(['success' => true],200);
    //         }
    //     else
    //         {
    //             echo "no user added";
    //         }
    // }
    // public function adminLoginRequest(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);
    //     if(Auth::attempt($credentials)){
    //         $request->session()->regenerate();
    //         return redirect()->route('adminDashboard');
    //     }
    //     else {
    //         echo "<div class='alert alert-danger' role='alert'>Password not Crrect</div>";
    //         return view('admin/pages/login');
    //     }
    // }

    public function dashboardPage()
    {
        if (Auth::check()) {
            return view('admin/index');
        } else {
            echo "<div class='alert alert-danger' role='alert'>User is not authenticated</div>";
            return view('admin/pages/login');
        }
    }
    
    public function logout()
    {
        Auth::logout();
        //return view('admin/pages/login');
        return view('landing');
    }
}