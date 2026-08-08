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
        $latestConversations = DB::table('conversation')->select('co_q_id',DB::raw('MAX(co_id) as latest_co_id'))->where('co_u_id', $userId)->groupBy('co_q_id');
        $Conversations = DB::table('conversation as c')->joinSub($latestConversations, 'latest', function ($join) {$join->on('c.co_id', '=', 'latest.latest_co_id');})->select('c.*')->orderByDesc('c.updated_at')->get();
        return view('dashboard/conversation/conversation_index',['u_id' => $userId, 'Conversations' => $Conversations]);
    }
    public function ajaxconversation($co_id)
        {
            $u_id = auth()->id();
            $co_id = $co_id;
            $ConversationA = DB::table('conversation')->where('co_id', $co_id)->get();
            $co_q_id = $ConversationA->first()->co_q_id;
            $Conversations = DB::table('conversation')->where('co_q_id', $co_q_id)->orderBy('updated_at', 'desc')->get();    
            return view('dashboard/conversation/conversation',['co_id' => $co_id, 'u_id' => $u_id, 'Conversations' => $Conversations]);
        }
    function addconversationmessage(Request $request){
        echo $userId = auth()->id();
        echo $message = $request->input('TextMessage');
        echo $co_id = $request->input('TextCoID');
        $ConversationA = DB::table('conversation')->where('co_id', $co_id)->get();
        $co_q_id = $ConversationA->first()->co_q_id;
        DB::table('conversation')->insert([
            'co_u_id' => $userId,
            'co_message' => $message,
            'co_qt_id' => $ConversationA->first()->co_qt_id,
            'co_q_id' => $ConversationA->first()->co_q_id,
            'co_inner_q' => $ConversationA->first()->co_inner_q,
            'co_status' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return redirect()->back();
    }       
}
