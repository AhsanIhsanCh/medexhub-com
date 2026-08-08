@php
use Carbon\Carbon;
$In = "0";
@endphp
<style>
.chat-container {display: flex;flex-direction: column;gap: 12px;width: 98%;margin: 0 auto;padding: 16px;background-color: #f2f2f2;border-radius: 12px;box-sizing: border-box;}
.message {display: flex;width: 100%;}
.bubble {max-width: 75%;padding: 10px 14px;font-family: sans-serif;font-size: 15px;line-height: 1.4;position: relative;box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);}
.bubble p {margin: 0;padding-bottom: 4px;}
.time {display: block;font-size: 11px;text-align: right;opacity: 0.6;}
.username {display: block;font-size: 11px;text-align: left;opacity: 0.6;}
.incoming {justify-content: flex-start;}
.incoming .bubble {background-color: #ffffff;color: #333333;border-radius: 0px 12px 12px 12px;}
.outgoing {justify-content: flex-end;}
.outgoing .bubble {background-color: #007aff;color: #ffffff;border-radius: 12px 12px 0px 12px;}
/* Input layout bar */
.chat-input-area {display: flex;padding: 12px;gap: 8px;}
.chat-input-area input {flex: 1;padding: 10px 16px;border: 1px solid #e0e0e0;border-radius: 20px;outline: none;font-size: 28px;height: 58px;}
.chat-input-area input:focus {border-color: #007aff;}
/* Send icon button */
.send-btn {background: #007aff;border: none;width: 38px;height: 38px;border-radius: 50%;display: flex;align-items: center;justify-content: center;cursor: pointer;transition: background 0.2s;margin-top: 10px;}
.send-btn:hover {background: #0063cc;}
.send-btn svg {width: 28px;height: 28px;fill: #ffffff;margin-left: 2px; /* Centers the paper airplane visual weight */}
</style>
<div class='mainDataBox patch-1270'>
    <div class='text-right' style="position: absolute;top: 20px;right: 20px;">
        <a class="btn btn-logout btn-sm" href="" onClick='return closedatadiv();'>Close</a>
    </div>
    <div style="margin-left:30px;margin-top:20px;margin-bottom:20px;">
        <span class="title-kicker">Conversation</span>
        <h1>Conversation's</h1>
        <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
    </div>
    <div class="chat-container" style="margin-top:10px;margin-bottom:10px;">
        <form name='conversationForm' action="{{ route('addconversationmessage') }}" method="post" >
            @csrf
            <div class="chat-input-area">
                <input name="TextMessage" type="text" placeholder="Type a message..." />
                <input name="TextCoID" type="hidden" value="{{$co_id}}"  />
                <button class="send-btn">
                    <svg viewBox="0 0 24 24">
                        <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
   <?php
        echo "<div class='chat-container'>";
            foreach ($Conversations as $Conversation)
                {
                    $MessageData = $Conversation->co_message ?? 'No Question Found';
                    $UserCoID = $Conversation->co_u_id ?? 'No User Found';
                    $CoUser = DB::table('users')->select('u_fname','u_lname')->where('id', $UserCoID)->get();
                    $CoUserName = $CoUser->first()->u_fname . ' ' . $CoUser->first()->u_lname ?? 'No User Found';
                    $created_at = $Conversation->created_at ?? 'No Date Found';
                    $CreatedAt = Carbon::parse($created_at)->format('d M Y, h:i A');
                    if($Conversation->co_u_id == $u_id)
                        {
                            echo "<div class='message outgoing'>";
                                echo "<div class='bubble'>";
                                    echo "<span class='username'>--".$CoUserName."</span>";
                                    echo "<p>".$MessageData."</p>";
                                    echo "<span class='time'>".$CreatedAt."</span>";
                                echo "</div>";
                            echo "</div>";
                        }
                    else
                        {
                            echo "<div class='message incoming'>";
                                echo "<div class='bubble'>";
                                    echo "<span class='username'>--".$CoUserName."</span>";
                                    echo "<p>".$MessageData."</p>";
                                    echo "<span class='time'>".$CreatedAt."</span>";
                                echo "</div>";
                            echo "</div>";
                        }
                }
        echo "</div>";
?>
</div>