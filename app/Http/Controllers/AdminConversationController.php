<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminConversationController extends Controller
{
    public function adminconversation()
    {
        $Accounts = "s";
        $AccountsNew = "s";
        return view('admin/source/conversation/conversation',['data' => $Accounts,'New' => $AccountsNew]);
    }
}
