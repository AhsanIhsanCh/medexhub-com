<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\ConversationSupport;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
class CommonController extends Controller
{
    function SendContactMessage(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'category' => ['required'],
            'reference' => ['sometimes'],
            'subject' => ['required'],
            'message' => ['required'],
            ]);
        try {
            $ConversationSupport = ConversationSupport::create([
            'cos_name' => $request->input('name'),
            'cos_email' => $request->input('email'),
            'cos_category' => $request->input('category'),
            'cos_reference' => $request->input('reference'),
            'cos_subject' => $request->input('subject'),
            'cos_message' => $request->input('message'),
            ]);
            return back()->with('success5s', 'Your message sent successfully our team responds you as soon as possible.');
            } catch (\Exception $e) 
            {                
                return back()->with('error5s', 'Your message could not be sent please try again.');
            }
    }
}
