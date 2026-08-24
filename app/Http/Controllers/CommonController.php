<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class CommonController extends Controller
{
    function SendContactMessage(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required'],
            'category' => ['required'],
            'reference' => ['required'],
            'subject' => ['required'],
            'message' => ['required'],
            ]);

            dump($credentials);
            die;
        // $Name = $request->input('name');
        // $Email = $request->input('email');
        // $Category = $request->input('category');
        // $Reference = $request->input('reference');
        // $Subject = $request->input('subject');
        // $Message = $request->input('message');
    }
}
