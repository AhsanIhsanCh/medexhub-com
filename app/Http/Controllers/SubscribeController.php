<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class SubscribeController extends Controller
{
    function subscriptions(){
        $userId = auth()->id();
        $Subscribes = DB::table('subscribes')->where('su_u_id', $userId)->orderBy('su_expdate', 'desc')->get();
        return view('dashboard/subscription/subscription',['u_id' => $userId, 'Subscribes' => $Subscribes]);
    }
    function invoiceindex(){
        $userId = auth()->id();
        $Invoices = DB::table('invoice')->where('in_u_id', $userId)->orderBy('in_date', 'desc')->get();
        return view('dashboard/subscription/invoice_index',['u_id' => $userId, 'Invoices' => $Invoices]);
    }
    public function ajaxinvoice($in_id)
        {
            $u_id = auth()->id();
            $in_id = $in_id;
            $Invoices = DB::table('invoice')->where('in_id', $in_id)->get();
            $Users = DB::table('users')->where('id', $u_id)->get();
            $InvoicesDatas = DB::table('invoice_data')->where('ind_in_id', $in_id)->get();
            return view('dashboard/subscription/invoice',['Invoices' => $Invoices, 'Users' => $Users, 'InvoicesDatas' => $InvoicesDatas]);
        }
}
            
            
            