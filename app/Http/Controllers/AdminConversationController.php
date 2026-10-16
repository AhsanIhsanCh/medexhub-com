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
    public function adminconversation($limitShow)
    {
        $userId = auth()->id();
        $latestConversations = DB::table('conversation')->select('co_q_id','co_inner_q',DB::raw('MAX(co_id) as latest_co_id'))->groupBy('co_q_id', 'co_inner_q');
        $Conversations = DB::table('conversation as c')->joinSub($latestConversations, 'latest', function ($join) {$join->on('c.co_id', '=', 'latest.latest_co_id');})->select('c.*')->orderByDesc('c.updated_at')->limit($limitShow)->get();
        return view('admin/source/conversation/conversation',['u_id' => $userId, 'Conversations' => $Conversations]);
    }
}
