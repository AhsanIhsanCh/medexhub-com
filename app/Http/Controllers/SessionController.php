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
        $Tests = DB::table('tests')->where([['t_u_id', $userId]])->orderBy('t_id', 'desc')->get();
        return view('dashboard/history/examhistory',['u_id' => $userId, 'Tests' => $Tests]);
    }

    function loginhistorydata(){
        $userId = auth()->id();
        $LoginHistory = DB::table('login_history')->where([['lh_u_id', $userId]])->orderBy('lh_id', 'desc')->get();
        return view('dashboard/history/loginhistory',['u_id' => $userId, 'LHistorys' => $LoginHistory]);
    }
}
