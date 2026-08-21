@php
use Carbon\Carbon;
$In = "0";
@endphp
<style>
:root {
    --ink: #173047;
    --primary: #147d70;
    --danger: #bc3f4b;
    --danger-dark: #9a353f;
}
.mainDataBox{font-size: 12px;position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%) scale(1);border-radius: 10px;background-color: white;width: 800px;min-height: 100px;max-height:600px;overflow-x: hidden;overflow-y: auto;z-index: 9900;max-width: 80%;padding: 20px;border: none;box-shadow: rgba(22, 31, 39, 0.42) 0px 60px 123px -25px, rgba(19, 26, 32, 0.08) 0px 35px 75px -35px;}
.patch-1290{width: 1200px;height:900px;}
.patch-1270{width: 1200px;height:700px;}
.patch-1165{width: 1100px;height:650px;}
.patch-1075{width: 1000px;height:750px;}
.patch-635{width: 600px;height:350px;}
.btn{border: 0;border-radius: 12px;min-height: 44px;padding: 0 18px;display: inline-flex;align-items: center;justify-content: center;gap: 9px;font-weight: 750;font-size: 14px;cursor: pointer;transition: transform .2s ease, box-shadow .2s ease, background .2s ease;}
.btn:hover{transform: translateY(-1px);}
.btn-sm{min-height: 38px; padding: 0 14px;}
.btn-logout{background: var(--danger);color: #fff;box-shadow: 0 8px 18px rgba(20,125,112,.22);}
.btn-logout:hover{background: var(--danger-dark); box-shadow: 0 12px 25px rgba(20,125,112,.28);}
.title-kicker{display: inline-flex;align-items: center;gap: 8px;color: var(--primary-dark);background: rgba(255,255,255,.78);border: 1px solid #cfeae5;padding: 7px 11px;border-radius: 999px;font-size: 12px;font-weight: 850;margin-bottom: 12px;}
.title-kicker::before{content: ""; width: 8px; height: 8px; background: var(--primary); border-radius: 50%; box-shadow: 0 0 0 4px rgba(20,125,112,.14);}
.title-subtitle{margin: 8px 0 0; color: var(--ink-soft); font-size: 14px; line-height: 1.55;}
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
.chat-input-area input {flex: 1;padding: 10px 16px;border: 1px solid #e0e0e0;border-radius: 20px;outline: none;font-size: 14px;height: 58px;}
.chat-input-area input:focus {border-color: #007aff;}
/* Send icon button */
.send-btn {background: #007aff;border: none;width: 38px;height: 38px;border-radius: 50%;display: flex;align-items: center;justify-content: center;cursor: pointer;transition: background 0.2s;margin-top: 10px;}
.send-btn:hover {background: #0063cc;}
.send-btn svg {width: 28px;height: 28px;fill: #ffffff;margin-left: 2px; /* Centers the paper airplane visual weight */}
h1{margin: 0;
      color: #153347;
      font-size: clamp(25px, 2.45vw, 34px);
      font-weight: 850;
      letter-spacing: -0.04em;
      line-height: 1.1;}
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
                <input name="TextQID" type="hidden" value="{{$q_id}}"  />
                <input name="TextQInnerID" type="hidden" value="{{$q_inner_id}}"  />
                <input name="TextQType" type="hidden" value="{{$qt_id}}"  />
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
                    $userId = auth()->id();
                    $MessageData = $Conversation->co_message ?? 'No Question Found';
                    $UserCoID = $Conversation->co_u_id ?? 'No User Found';
                    $CoUser = DB::table('users')->select('id','u_fname','u_lname','u_name_safety')->where('id', $UserCoID)->get();
                    if($CoUser->first()->u_name_safety == 1)
                        {
                            if($CoUser->first()->id == $userId)
                                {
                                    $CoUserName = "<svg width='10px' style='margin-top:-5px;' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><!--!Font Awesome Free v5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d='M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z'/></svg> &nbsp;".$CoUser->first()->u_fname . ' ' . $CoUser->first()->u_lname ?? 'No User Found';
                                }
                            else
                                {
                                    $first_fname = mb_substr($CoUser->first()->u_fname, 0, 1);
                                    $first_lname = mb_substr($CoUser->first()->u_lname, 0, 1);
                                    $CoUserName = "<svg width='10px' style='margin-top:-3px;' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><!--!Font Awesome Free v5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d='M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z'/></svg> &nbsp;".$first_fname . ' ' . $first_lname ?? 'No User Found';
                                }
                            
                        }
                    else
                        {
                            $CoUserName = "<svg width='10px' style='margin-top:-5px;' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512'><!--!Font Awesome Free v5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d='M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z'/></svg> &nbsp;".$CoUser->first()->u_fname . ' ' . $CoUser->first()->u_lname ?? 'No User Found';
                        }
                    
                    $created_at = $Conversation->created_at ?? 'No Date Found';
                    $CreatedAt = "<svg width='10px' style='margin-top:-3px;' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512'><!--!Font Awesome Free v5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d='M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z'/></svg> &nbsp;".Carbon::parse($created_at)->format('d M Y, h:i A');
                    if($Conversation->co_u_id == $u_id)
                        {
                            echo "<div class='message outgoing'>";
                                echo "<div class='bubble'>";
                                    echo "";
                                    echo "<span class='username'>".$CreatedAt."</span>";
                                    echo "<p>".$MessageData."</p>";
                                    echo "<span class='time'>".$CoUserName."</span>";
                                echo "</div>";
                            echo "</div>";
                        }
                    else
                        {
                            echo "<div class='message incoming'>";
                                echo "<div class='bubble'>";
                                    echo "<span class='username'>".$CreatedAt."</span>";
                                    echo "<p>".$MessageData."</p>";
                                    echo "<span class='time'>".$CoUserName."</span>";
                                echo "</div>";
                            echo "</div>";
                        }
                }
        echo "</div>";
?>
</div>
