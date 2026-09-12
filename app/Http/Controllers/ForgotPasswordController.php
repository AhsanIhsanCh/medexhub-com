<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Support\Facades\Password as PasswordFacade;
use App\Http\Controllers\GoogleMailController;
class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate(
        [
            'email' => 'required|email|exists:users,email',
            'g-recaptcha-response' => 'required|captcha',
        ], 
        [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'This email address in not registered with us..',
            'g-recaptcha-response.required' => 'Please complete the CAPTCHA verification.',
        ]);
        $user = User::where('email', $request->email)->first();
        // Generate Laravel password reset token
        $token = Password::createToken($user);
        // Generate reset password URL
        $resetUrl = url('/reset-password/' . $token . '?email=' . urlencode($user->email));
        $subject = 'Reset Your Password';
        $message = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Reset Your Password</title>
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
                                        <h2 style="margin:0 0 20px;font-size:24px;color:#222222;text-align:center;">Reset Your Password </h2>
                                        <p style="margin:0 0 20px;font-size:16px;line-height:1.7;">Hi '.$user->u_fname.' '.$user->u_lname.',</p>
                                        <p style="margin:0 0 25px;font-size:16px;line-height:1.7;color:#555555;">
                                            We received a request to reset your password.
                                            Please reset your password by clicking the button below.
                                        </p>
                                        <!-- Verify Button -->
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center" style="padding:10px 0 30px;">
                                                    <a href="'.$resetUrl.'" style="display:inline-block;background:#3769ac;color:#ffffff;text-decoration:none;padding:14px 30px;border-radius:6px;font-size:16px;font-weight:bold;">
                                                        Reset Your Password
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                        <p style="margin:0 0 15px;font-size:14px;line-height:1.6;color:#777777;">
                                            If the button above does not work, copy and paste
                                            the following link into your browser:
                                        </p>
                                        <p style="margin:0 0 25px;font-size:13px;line-height:1.6;word-break:break-all;color:#3769ac;">'.$resetUrl.'</p>
                                        <p style="margin:0;font-size:14px;line-height:1.6;color:#777777;">
                                            If you did not request a password reset, you can ignore this email.
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
            $user->email,
            $subject,
            $message
        );
        return back()->with('success5s', 'Password reset link has been send you successfully.');
    }

    public function resetPassword(Request $request)
    {
        $requestData = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
        ],
        [
            'token.required' => 'The reset token is missing go back and try again.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Please enter a new password.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.confirmed' => 'Password and confirm password do not match.',
            
        ]);
        $status = Password::reset($request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );
        if ($status === Password::PASSWORD_RESET) {
            return redirect('/login')->with('success5s', 'Your password reset successfully.');
        }
        return back()->withErrors(['email' => __($status)]);
    }
}
