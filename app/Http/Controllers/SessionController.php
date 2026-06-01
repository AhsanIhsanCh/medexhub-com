<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class SessionController extends Controller
{
    function examhistorydata(){
        $userId = auth()->id();
        // $Baskets = DB::table('baskets')->where('ba_u_id', $userId)->orderBy('ba_createdat', 'desc')->get();
        $History = "a";
        return view('dashboard/history/examhistory', compact('History'));
    }
    function loginhistorydata(){
        $userId = auth()->id();
        // $Baskets = DB::table('baskets')->where('ba_u_id', $userId)->orderBy('ba_createdat', 'desc')->get();
        $History = "a";
        return view('dashboard/history/loginhistory', compact('History'));
    }
}
