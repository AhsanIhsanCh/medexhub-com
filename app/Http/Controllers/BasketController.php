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
        $Baskets = DB::table('baskets')->where('ba_u_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('dashboard/subscription/basket',['u_id' => $userId, 'Baskets' => $Baskets]);
    }


    function buyexam($e_id){
    
        $userId = auth()->id();
        $Exams = DB::table('exams')->select('e_inner_level','e_price1y')->where('e_id', $e_id)->get();
        $JionDate = date("Y-m-d H:i:s" , time());
        $ExpDate = date("Y-m-d H:i:s", strtotime("+12 months"));
        DB::table('baskets')->insert([
            'ba_e_inner_level' => $Exams->first()->e_inner_level,
            'ba_e_id' => $e_id,
            'ba_u_id' => auth()->id(),
            'ba_for' => 12,
            'ba_jiondate' => $JionDate,
            'ba _expdate' => $ExpDate,
            'ba_price' => $Exams->first()->e_price1y,
            'ba_coupon' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            ]);
        $Baskets = DB::table('baskets')->where('ba_u_id', $userId)->orderBy('created_at', 'desc')->get();
        return view('dashboard/subscription/basket',['u_id' => $userId, 'Baskets' => $Baskets]);
    }

    function basketremoveitem($ba_id){
        DB::table('baskets')->where('ba_id', $ba_id)->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    function basketupdateitem(Request $request){
        $for = $request->query('for');
        $ba_Id = $request->query('ba_id');
        DB::table('baskets')->where('ba_id', $ba_Id)->update(['ba_for' => $for]);
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
function basketaddcoupon(Request $request){
        echo $Coupon = $request->input('TextDiscount');
        // $ba_Id = $request->input('ba_id');
        // DB::table('baskets')->where('ba_id', $ba_Id)->update(['ba_coupon' => $for]);
        //return redirect()->back()->with('success', 'User deleted successfully.');
    }
      

    
    
}