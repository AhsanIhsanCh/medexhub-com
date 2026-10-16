<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminMaintenanceController extends Controller
{
    public function maintenancesession($limitShow)
    {
        $Tests = DB::table('tests')->select('t_u_id', DB::raw('count(*) as total_tests'))->groupBy('t_u_id')->orderBy('t_u_id', 'desc')->limit($limitShow)->get();
        return view('admin/source/maintenance/maintenance-session',['Tests' => $Tests]);
    }
    public function maintenancelogin($limitShow)
    {
        $LoginHistorys = DB::table('login_history')->select('lh_u_id', DB::raw('count(*) as total_loghistory'))->groupBy('lh_u_id')->orderBy('lh_u_id', 'desc')->limit($limitShow)->get();
        return view('admin/source/maintenance/maintenance-login',['LoginHistorys' => $LoginHistorys]);
    }
}
    