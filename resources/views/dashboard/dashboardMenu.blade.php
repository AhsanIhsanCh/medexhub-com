<aside class="member-menu" aria-label="MedExHub member navigation">
  <div class="sidebar-user" style="border-radius: var(--radius-xl) var(--radius-xl) 0 0;">
    <div class="avatar">M</div>
    <div>
      <strong>MedExHub Member</strong>
      <span>Premium exam access</span>
    </div>
  </div>      
  <nav class="menu-list">
    <details class="menu-item " name="member-menu">
      <summary>
        <span class="menu-label">
          <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v15H6.5A2.5 2.5 0 0 0 4 20.5v-15Z"/>
            <path d="M4 20.5A2.5 2.5 0 0 0 6.5 23H20"/>
            <path d="M8 8h8"/>
          </svg>
          <span><a href="/dashboard">My Exam</a></span>
        </span>
      </summary>
    </details>
    <details class="menu-item" name="member-menu">
      <summary>
        <span class="menu-label">
          <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M3 12a9 9 0 1 0 3-6.7"/>
            <path d="M3 4v5h5"/>
            <path d="M12 7v5l3 2"/>
          </svg>
          <span>History</span>
        </span>
        <span class="chevron" aria-hidden="true">›</span>
      </summary>
      <div class="submenu">
        <a href="/examhistory">Exam History</a>
        <a href="/loginhistory">Login History</a>
      </div>
    </details>
    <details class="menu-item" name="member-menu">
      <summary>
        <span class="menu-label">
          <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true">
            <rect x="3" y="7" width="18" height="12" rx="2"/>
            <path d="M9 7V5a3 3 0 0 1 6 0v2"/>
          </svg>
          <span>Subscription</span>
        </span>
        <span class="chevron" aria-hidden="true">›</span>
      </summary>
      <div class="submenu">
        <a href="/basket">Basket</a>
        <a href="/subscriptions">Subscriptions</a>
        <a href="/invoice">Invoice</a>
      </div>
    </details>
    <details class="menu-item " name="member-menu">
      <summary>
        <span class="menu-label">
          <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M4 5.5A2.5 2.5 0 0 1 6.5 3H20v15H6.5A2.5 2.5 0 0 0 4 20.5v-15Z"/>
            <path d="M4 20.5A2.5 2.5 0 0 0 6.5 23H20"/>
            <path d="M8 8h8"/>
          </svg>
          <span><a href="/conversation">Conversation</a></span>
        </span>
      </summary>
    </details>
    <details class="menu-item" name="member-menu">
        <summary>
          <span class="menu-label">
            <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true">
              <circle cx="12" cy="8" r="4"/>
              <path d="M4 21c0-4.4 3.6-8 8-8s8 3.6 8 8"/>
          </svg>
            <span><a href="/profile">Profile</a></span>
          </span>
        </summary>
      </details>
    <!-- <details class="menu-item" name="member-menu">
      <summary>
        <span class="menu-label">
          <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M6 2h8l5 5v15H6z"/>
            <path d="M14 2v6h5"/>
            <path d="M9 13h6M9 17h6"/>
          </svg>
          <span><a href="/documents">Documents</a></span>
        </span>
      </summary>
    </details> -->
    @php
      $User = DB::table('users')->select('u_ut_id')->where('id', auth()->id())->get();
      $UserType = $User->first()->u_ut_id ?? 'No User Found';
    @endphp
    @if ($UserType == 1 || $UserType == 2)
      <details class="menu-item" name="member-menu">
        <summary>
          <span class="menu-label">
            <svg class="menu-icon" viewBox="0 0 24 24" aria-hidden="true">
              <circle cx="12" cy="12" r="3"/>
              <path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-2.83 2.83-.06-.06A1.7 1.7 0 0 0 15 19.4a1.7 1.7 0 0 0-1 .6 1.7 1.7 0 0 0-.4 1.1V21h-4v-.09A1.7 1.7 0 0 0 8.55 19.4a1.7 1.7 0 0 0-1.88.34l-.06.06-2.83-2.83.06-.06A1.7 1.7 0 0 0 4.6 15a1.7 1.7 0 0 0-.6-1 1.7 1.7 0 0 0-1.1-.4H3v-4h.09A1.7 1.7 0 0 0 4.6 8.55a1.7 1.7 0 0 0-.34-1.88l-.06-.06 2.83-2.83.06.06A1.7 1.7 0 0 0 9 4.6a1.7 1.7 0 0 0 1-.6 1.7 1.7 0 0 0 .4-1.1V3h4v.09A1.7 1.7 0 0 0 15.45 4.6a1.7 1.7 0 0 0 1.88-.34l.06-.06 2.83 2.83-.06.06A1.7 1.7 0 0 0 19.4 9c.15.39.35.73.6 1 .3.3.69.5 1.1.55H21v4h-.09A1.7 1.7 0 0 0 19.4 15Z"/>
            </svg>
            <span><a href="adminDashboard" target="_blank">Admin Panel</a></span>
          </span>
        </summary>
      </details>
    @endif
  </nav>
  <div class="support-card">
    <strong>Need guidance?</strong>
    <p>Have a question about MedExHub? We’re only a message away.</p>
    <button>Contact support</button>
  </div>
</aside>
<script>
  // JavaScript Logic
  // 1. Select all target elements
  const navItems = document.querySelectorAll('.menu-item');
  // 2. Loop through each item to attach a click event listener
  navItems.forEach(item => {
    item.addEventListener('click', function() {
      // 3. Find the element that currently has the 'active' class and remove it
      const currentActive = document.querySelector('.menu-item.active');
      if (currentActive) {
        currentActive.classList.remove('active');
      }
      // 4. Add the 'active' class to the newly clicked element
      this.classList.add('active');
      });
    });
</script>