<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\GoogleMailController;

class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        
        
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate Laravel password reset token
        $token = Password::createToken($user);

        // Generate reset password URL
        $resetUrl = url('/reset-password/' . $token . '?email=' . urlencode($user->email));

        $subject = 'Reset Your Password';
echo "test2";
        die;
        $message = '
            <h2>Reset Your Password</h2>

            <p>Hello ' . e($user->name ?? $user->email) . ',</p>

            <p>We received a request to reset your password.</p>

            <p>
                <a href="' . $resetUrl . '"
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
            MedexTech</p>
        ';

        dd($resetUrl);
        die;


        $googleMail = new GoogleMailController();

        $result = $googleMail->sendGmail(
            $user->email,
            $subject,
            $message
        );

        return back()->with(
            'success',
            'Password reset link has been sent to your email.'
        );
    }
}
