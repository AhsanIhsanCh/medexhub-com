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
        $Users = "s";
        return view('admin/source/users/users',['Users' => $Users]);
    }

    public function adminusersban()
    {
        $Users = "s";
        return view('admin/source/users/users-ban',['Users' => $Users]);
    }

    public function adminuserspending()
    {
        $Users = "s";
        return view('admin/source/users/users-pending',['Users' => $Users]);
    }
}
