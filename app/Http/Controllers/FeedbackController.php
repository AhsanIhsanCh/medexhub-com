<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class FeedbackController extends Controller
{
    function betteranswerdata(){
        $userId = auth()->id();
        // $Baskets = DB::table('baskets')->where('ba_u_id', $userId)->orderBy('ba_createdat', 'desc')->get();
        $History = "a";
        return view('dashboard/conversation/betteranswer', compact('History'));
    }
    function correctiondata(){
        $userId = auth()->id();
        // $Baskets = DB::table('baskets')->where('ba_u_id', $userId)->orderBy('ba_createdat', 'desc')->get();
        $History = "a";
        return view('dashboard/conversation/suggestcorrection', compact('History'));
    }
}
