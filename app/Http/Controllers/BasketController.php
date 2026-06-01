<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class BasketController extends Controller
{
    function userbasketdata(){
        $userId = auth()->id();
        // $Baskets = DB::table('baskets')->where('ba_u_id', $userId)->orderBy('ba_createdat', 'desc')->get();
        $Baskets = "a";
        return view('dashboard/subscription/basket', compact('Baskets'));
    }
    
}