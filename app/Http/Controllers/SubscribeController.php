<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class SubscribeController extends Controller
{
    function usersubscribedata(){
        $userId = auth()->id();
        $Subscribes = DB::table('subscribes')->where('su_u_id', $userId)->orderBy('su_expdatetime', 'desc')->get();
        return view('dashboard/subscription/subscription', compact('Subscribes'));
    }
    function userinvoicedata(){
        $userId = auth()->id();
        $Subscribes = DB::table('subscribes')->where('su_u_id', $userId)->orderBy('su_expdatetime', 'desc')->get();
        return view('dashboard/subscription/invoice', compact('Subscribes'));
    }
}
