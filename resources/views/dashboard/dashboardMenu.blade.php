<div id="profile-nav" bis_skin_checked="1">
    <ul class="lp-profile-nav-tabs">
        <li class="courses active">
            <a href="/myexam"><i class="fas fa-book-open"></i>My Exam</a>
        </li>
        <li class="settings has-child">
            <a href="#" data-slug="#"><i class="fas fa-cog"></i>History</a>
            <ul class="profile-tab-sections">
                <li class="basic-information"><a href="/examhistory">Exam History</a></li>
                <li class="avatar"><a href="/loginhistory">Login History</a></li>
            </ul>
        </li>
        <li class="settings has-child">
            <a href="#" data-slug="#"><i class="fas fa-cog"></i>Subscription</a>
            <ul class="profile-tab-sections">
                <li class="basic-information"><a href="/basket">Basket</a></li>
                <li class="avatar"><a href="/subscriptions">Subscription</a></li>
                <li class="change-password"><a href="/invoice">Invoice</a></li>
            </ul>
        </li>
        <li class="settings has-child">
            <a href="#" data-slug="#"><i class="fas fa-cog"></i>Conversation</a>
            <ul class="profile-tab-sections">
                <li class="basic-information"><a href="/betteranswer"> Better answer</a></li>
                <li class="avatar" style="width: 210px;"><a href="/correction">Suggest a correction</a></li>
            </ul>
        </li>
        <li class="quizzes">
            <a href="#"> <i class="fas fa-puzzle-piece"></i>Document</a>
        </li>
        @php
            $User = DB::table('users')->select('u_ut_id')->where('id', auth()->id())->get();
            $UserType = $User->first()->u_ut_id ?? 'No User Found';
        @endphp
        @if ($UserType == 1 || $UserType == 2)
            <li class="quizzes">
                <a href="adminDashboard" target="_blank"> <i class="fas fa-puzzle-piece"></i>Admin Panel</a>
            </li>
        @endif
    </ul>   
</div>