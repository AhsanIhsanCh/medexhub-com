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
   

    public function maintenancesession()
    {
        $Exams = "2";
        return view('admin/source/maintenance/maintenance-session',['Exams' => $Exams]);
    }
    public function maintenancelogin()
    {
        $Exams = "2";
        return view('admin/source/maintenance/maintenance-login',['Exams' => $Exams]);
    }
}
