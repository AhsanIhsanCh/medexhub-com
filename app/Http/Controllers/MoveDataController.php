<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MoveDataController extends Controller
{
    public function movedata()
    {
        ini_set('max_execution_time', 2100);
        set_time_limit(2100);
        $Users = DB::table('users_db')->orderBy('id', 'asc')->get();
        foreach ($Users as $User) {
            $Newpassword = Hash::make($User->passward_old);
            DB::table('users_db')->where('id', $User->id)->update(['password' => $Newpassword]);       
        }
        echo "Data moved successfully!";
    }
}

