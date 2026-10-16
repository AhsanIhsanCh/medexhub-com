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
    public function adminaccountpayment($year)
    {
        $Payments = DB::table('payments')->select( DB::raw('YEAR(created_at) as year'),DB::raw('MONTH(created_at) as month'),DB::raw('SUM(pay_amount_total) as total_amount'),DB::raw('SUM(pay_amount_discount) as total_discount'),DB::raw('SUM(pay_amount_pay) as total_payment'),DB::raw('COUNT(*) as total_orders'))
        ->whereRaw('YEAR(created_at) = ?', [$year])->groupByRaw('YEAR(created_at), MONTH(created_at)')->orderBy('month', 'desc')->get();
        return view('admin/source/account/payment',['Payments' => $Payments, 'year' => $year]);
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
