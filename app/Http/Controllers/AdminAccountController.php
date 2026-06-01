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
    public function show()
    {
        $Accounts = DB::table('payments')->latest('pay_date')->take(5000)->get()->reverse();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $AccountsNew = DB::table('payments')->whereYear('pay_date', $currentYear)->whereMonth('pay_date', $currentMonth)->get();
        return view('admin/source/account/account',['data' => $Accounts,'New' => $AccountsNew]);
    }
}
