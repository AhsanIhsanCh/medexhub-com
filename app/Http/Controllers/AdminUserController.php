<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUserController extends Controller
{
   public function adminusers()
    {
        
        $Users = DB::table('users')->limit(50)->orderBy('id', 'desc')->get();
        return view('admin/source/users/users',['Users' => $Users]);
    }

    public function adminusertype($ut_id)
    {
        if($ut_id == 99) {
            $Users = DB::table('users')->get();
        } else {
            $Users = DB::table('users')->where('u_ut_id', $ut_id)->orderBy('id', 'desc')->get();
        }
        return view('admin/source/users/users',['Users' => $Users]);
    }
  
}
