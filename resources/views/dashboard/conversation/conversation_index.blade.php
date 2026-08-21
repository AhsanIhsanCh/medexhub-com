@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('conversation')
<section class="content-panel">
    <div class="title-row">
        <div>
        <span class="title-kicker">Conversation</span>
        <h1>Conversation's</h1>
        <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
        </div>
        <div class="db-actions"></div>
    </div>
    <div class="quick-row" aria-label="Quick stats">
        <div class="quick-card">
        <div class="quick-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5V5a2 2 0 0 1 2-2h13v18H6a2 2 0 0 1-2-1.5Z"/><path d="M8 7h7"/></svg>
        </div>
        <div><strong>8</strong><span>Exam collections</span></div>
        </div>
        <div class="quick-card">
        <div class="quick-icon green">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
        </div>
        <div><strong>1,240</strong><span>Questions completed</span></div>
        </div>
        <div class="quick-card">
        <div class="quick-icon pink">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="9"/></svg>
        </div>
        <div><strong>15</strong><span>Days left</span></div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-wrap">
            <table id="dataTable" >
                <thead>
                    <tr>
                        <th  style="width: 10%;">Sr # <span class="sort"></span></th>
                        <th  style="width: 90%;">Conversations <span class="sort"></span></th>
                        <th  style="width: 15%;">Action <span class="sort"></span></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th >Sr #</th>
                        <th>Conversations</th>
                        <th >Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($Conversations as $Conversation)
                        @php
                            if ($Conversation->co_qt_id == 1) 
                                {
                                    $StyleClass = "type-pill exam";
                                    $QuestionIDNo =  "MCQ ID : ".$Conversation->co_q_id;
                                    $QuestionInner = "0";
                                }
                            if ($Conversation->co_qt_id == 2) 
                                {
                                    $StyleClass = "type-pill revision";
                                    $QuestionIDNo =  "EMQ ID : ".$Conversation->co_q_id;
                                    $QuestionInner =  "Question No : ".$Conversation->co_inner_q;
                                }
                            $Co_Q_ID = $Conversation->co_q_id;
                            $ConversationsInner = DB::table('conversation')->where('co_q_id', $Conversation->co_q_id)->where('co_inner_q', $Conversation->co_inner_q)->orderBy('updated_at', 'desc')->get();
                            $Co_ID = $ConversationsInner->first()->co_id;
                            $Q_ID = $ConversationsInner->first()->co_q_id;
                            $Q_Inner_ID = $ConversationsInner->first()->co_inner_q;
                            $QT_ID = $ConversationsInner->first()->co_qt_id;
                            $LinkData = array($Q_ID,$Q_Inner_ID,$QT_ID);
                            $stringLinkData = implode(",",$LinkData);
                        @endphp
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td style="padding-top: 10px;">{{ $ConversationsInner->first()->co_message }}<br>
                                <p class="{{ $StyleClass }}" style="font-size:11px;max-height:20px;background-color: var(--surface-soft);"> {{ $QuestionIDNo }}</p>
                                @if($QuestionInner != 0)
                                    <p class="{{ $StyleClass }}" style="font-size:11px;max-height:20px;background-color: var(--surface-soft);"> {{ $QuestionInner }}</p>
                                @endif
                            </td>
                            <td  style="text-align: center;">
                                <button type="button" class="open-conversation btn btn-primary btn-sm"
                                data-url="{{ route('ajaxconversation', ['linkdata' => $stringLinkData]) }}"
                                >Open</button>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</section>
<script>
    function closedatadiv() {
    const dataDiv = document.getElementById('datadiv');
    dataDiv.style.display = 'none';
    dataDiv.innerHTML = '';
    }
    document.addEventListener('click', function (event) {
        const button = event.target.closest('.open-conversation');
            if (!button) {
                return;
                }
        const dataDiv = document.getElementById('datadiv');
        const urlPath = button.dataset.url;
        dataDiv.style.display = 'block';
        dataDiv.innerHTML = 'Loading...';
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            if (this.status >= 200 && this.status < 300) {
                dataDiv.innerHTML = this.responseText;
                } else {
                dataDiv.innerHTML = 'Unable to load conversation.';
                }
        };
        xhttp.onerror = function () {
            dataDiv.innerHTML = 'Network error.';
            };
        xhttp.open('GET', urlPath, true);
        xhttp.send();
    });
</script>
<div id="datadiv"></div>
@endsection