<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\subscribe;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ConversationController extends Controller
{
    function conversation(){
        $userId = auth()->id();
        $latestConversations = DB::table('conversation')->select('co_q_id','co_inner_q',DB::raw('MAX(co_id) as latest_co_id'))->where('co_u_id', $userId)->groupBy('co_q_id', 'co_inner_q');
        $Conversations = DB::table('conversation as c')->joinSub($latestConversations, 'latest', function ($join) {$join->on('c.co_id', '=', 'latest.latest_co_id');})->select('c.*')->orderByDesc('c.updated_at')->get();
        return view('dashboard/conversation/conversation_index',['u_id' => $userId, 'Conversations' => $Conversations]);
    }
    public function ajaxconversation($linkdata)
        {
            $u_id = auth()->id();
            $Data1 = explode(',', $linkdata);
            $q_id = $Data1[0];
            $q_inner_id = $Data1[1];
            $qt_id = $Data1[2];
            $Conversations = DB::table('conversation')->where('co_q_id', $q_id)->where('co_inner_q', $q_inner_id)->orderBy('updated_at', 'desc')->get();
            return view('dashboard/conversation/conversation',['q_id' => $q_id,'q_inner_id' => $q_inner_id,'qt_id' => $qt_id, 'u_id' => $u_id, 'Conversations' => $Conversations]);
        }
    function addconversationmessage(Request $request){
        $userId = auth()->id();
        $message = $request->input('TextMessage');
        $q_id = $request->input('TextQID');
        $q_inner_id = $request->input('TextQInnerID');
        $qt_id = $request->input('TextQType');
        DB::table('conversation')->insert([
            'co_u_id' => $userId,
            'co_message' => $message,
            'co_qt_id' => $qt_id,
            'co_q_id' => $q_id,
            'co_inner_q' => $q_inner_id,
            'co_status' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back();        
    }       
}
