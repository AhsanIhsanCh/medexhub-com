<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminAccountController extends Controller
{
    public function adminaccountpayment()
    {
        // $Accounts = DB::table('payments')->latest('pay_date')->take(5000)->get()->reverse();
        // $currentMonth = Carbon::now()->month;
        // $currentYear = Carbon::now()->year;
        // $AccountsNew = DB::table('payments')->whereYear('pay_date', $currentYear)->whereMonth('pay_date', $currentMonth)->get();

        $Accounts = "s";
        $AccountsNew = "s";
        return view('admin/source/account/payment',['data' => $Accounts,'New' => $AccountsNew]);
    }

    public function adminaccountreturnpayment()
    {
        $Accounts = "s";
        $AccountsNew = "s";
        return view('admin/source/account/payment-return',['data' => $Accounts,'New' => $AccountsNew]);
    }
    public function adminaccountmiscellaneouspayment()
    {
        $Accounts = "s";
        $AccountsNew = "s";
        return view('admin/source/account/payment-miscellaneous',['data' => $Accounts,'New' => $AccountsNew]);
    }

}
