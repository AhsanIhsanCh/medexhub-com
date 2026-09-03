<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\GoogleMailController;






class ForgotPasswordController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email',], 
        [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'This email address is not registered.',
        ]);
        $user = User::where('email', $request->email)->first();
        // Generate Laravel password reset token
        $token = Password::createToken($user);
        // Generate reset password URL
        $resetUrl = url('/reset-password/' . $token . '?email=' . urlencode($user->email));
        $subject = 'Reset Your Password';
        $message = '
            <h2>Reset Your Password</h2>
            <p>Hello ' . e($user->u_fname ?? $user->u_lname) . ',</p>
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
            MedExHub</p>
        ';
        $googleMail = new GoogleMailController();
        $result = $googleMail->sendGmail(
            $user->email,
            $subject,
            $message
        );
        return back()->with('success_fotgotpass', 'Password reset link has been sent to your email.');
    }

    public function resetPassword(Request $request)
    {
        $requestData = $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        //dd($requestData);

        $status = Password::reset(
            $request->only(
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
            return redirect('/login')
                ->with('success', 'Your password has been reset successfully.');
        }

        return back()->withErrors([
            'email' => __($status)
        ]);
    }
}
