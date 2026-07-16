<div class="sidebar-user">
              <div class="avatar">M</div>
              <div>
                <strong>MedExHub Member</strong>
                <span>Premium exam access</span>
              </div>
            </div>

            <ul class="side-menu">
              <li>
                <a class="side-link active" href="/dashboard">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5V6.75A2.75 2.75 0 0 1 6.75 4H20v13H6.75A2.75 2.75 0 0 0 4 19.5Zm0 0A2.5 2.5 0 0 0 6.5 22H20"/><path d="M8 8h8"/></svg>
                  My Exam
                  <span class="chev">›</span>
                </a>
              </li>
              <li>
                <a class="side-link" href="#">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12a9 9 0 1 0 3-6.7"/><path d="M3 4v5h5"/><path d="M12 7v5l3 2"/></svg>
                  History
                  <span class="chev">›</span>
                </a>
              </li>





              
              <li>
                <a class="side-link" href="#">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 7H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z"/><path d="M17 12h.01"/><path d="M7 7V5a3 3 0 0 1 6 0v2"/></svg>
                  Subscription
                  <span class="chev">›</span>
                </a>
              </li>
              <li>
                <a class="side-link" href="#">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a4 4 0 0 1-4 4H7l-4 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z"/></svg>
                  Conversation
                  <span class="chev">›</span>
                </a>
              </li>
              <li>
                <a class="side-link" href="#">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"/><path d="M14 2v6h6"/><path d="M16 13H8"/><path d="M16 17H8"/></svg>
                  Documents
                  <span class="chev">›</span>
                </a>
              </li>
              @php
                $User = DB::table('users')->select('u_ut_id')->where('id', auth()->id())->get();
                $UserType = $User->first()->u_ut_id ?? 'No User Found';
            @endphp
            @if ($UserType == 1 || $UserType == 2)
            

            <li>
                <a class="side-link" href="adminDashboard" target="_blank">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06A1.65 1.65 0 0 0 15 19.4a1.65 1.65 0 0 0-1 .6 1.65 1.65 0 0 0-.33 1.82V22a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 20.4a1.65 1.65 0 0 0-1.82-.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.6 15a1.65 1.65 0 0 0-.6-1 1.65 1.65 0 0 0-1.82-.33H2a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 3.6 9a1.65 1.65 0 0 0 .33-1.82l-.06-.06A2 2 0 1 1 6.7 4.29l.06.06A1.65 1.65 0 0 0 9 4.6a1.65 1.65 0 0 0 1-.6 1.65 1.65 0 0 0 .33-1.82V2a2 2 0 1 1 4 0v.09A1.65 1.65 0 0 0 15 3.6a1.65 1.65 0 0 0 1.82.33l.06-.06A2 2 0 1 1 19.71 6.7l-.06.06A1.65 1.65 0 0 0 19.4 9c.31.28.52.66.6 1h.09a2 2 0 1 1 0 4H20a1.65 1.65 0 0 0-.6 1Z"/></svg>
                  Admin Panel
                  <span class="chev">›</span>
                </a>
              </li>

        @endif
              
              
            </ul>

            <div class="support-card">
              <strong>Need guidance?</strong>
              <p>Have a question about MedExHub? We’re only a message away.</p>
              <button>Contact support</button>
            </div>
      
      
      
      
      
            
        
