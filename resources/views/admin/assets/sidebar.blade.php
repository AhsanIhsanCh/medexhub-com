<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="adminDashboard">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-tachometer-alt-slowest"></i>
            </div>
            <div class="sidebar-brand-text mx-3"></div>
            <div class="sidebar-brand-text mx-3">Medexhub</div>
        </a>
        <hr class="sidebar-divider my-0">
        {{-- <li class="nav-item active"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fw fa-tachometer-alt"></i><span>&nbsp;&nbsp;Dashboard</span></a></li> --}}
        <hr class="sidebar-divider">
        <!-- Single Item -->
        <li class="nav-item">
            <a class="nav-link" href="/adminAccount"><i class="fad fa-money-check-alt"></i><span>&nbsp;&nbsp;Accounts</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/adminUsers"><i class="fas fa-users"></i><span>&nbsp;&nbsp;User</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-vacuum"></i><span>&nbsp;&nbsp;Maintenance</span></a>
        </li>
        @php
            $BlockID = "BlockID_1";
        @endphp
        <li class='nav-item'>
            <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#{{$BlockID}}' aria-expanded='true' aria-controls='{{$BlockID}}'>
                <i class="fas fa-user-headset"></i><span>&nbsp;&nbsp;Question</span>
            </a>
            <div id='{{$BlockID}}' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
                <div class='bg-white py-2 collapse-inner rounded'>
                    <a class='collapse-item' href='/adminExams'><i class="fas fa-comment-dots"></i>&nbsp;&nbsp;Exam's</a>
                    <a class='collapse-item' href='/adminQuestion/1'><i class="fas fa-comment-dots"></i>&nbsp;&nbsp;MCQ</a>
                    <a class='collapse-item' href='/adminQuestion/2'><i class="fas fa-comments"></i>&nbsp;&nbsp;EMQ</a>
                    <a class='collapse-item' href='/adminQuestion/3'><i class="fas fa-comments"></i>&nbsp;&nbsp;Flash Card</a>
                    <a class='collapse-item' href='/adminQuestion/5'><i class="fas fa-comments"></i>&nbsp;&nbsp;Select the Options<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(KFP 1)</a>
                    <a class='collapse-item' href='/adminQuestion/6'><i class="fas fa-comments"></i>&nbsp;&nbsp;Free Text Questions<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(KFP 2)</a>
                </div>
            </div>
        </li>
        
        
        
        @php
            $BlockID = "BlockID_2";
        @endphp
        <li class='nav-item'>
            <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#{{$BlockID}}' aria-expanded='true' aria-controls='{{$BlockID}}'>
                <i class="fas fa-user-headset"></i><span>&nbsp;&nbsp;Conversation</span>
            </a>
            <div id='{{$BlockID}}' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
                <div class='bg-white py-2 collapse-inner rounded'>
                    <a class='collapse-item' href='main.php?ab=4&p=13'><i class="fas fa-comment-dots"></i>&nbsp;&nbsp;Feedback</a>
                    <a class='collapse-item' href='main.php?ab=4&p=13'><i class="fas fa-comments"></i>&nbsp;&nbsp;Suggest A Correction</a>
                </div>
            </div>
        </li>
        @php
            $BlockID = "BlockID_3";
        @endphp
        <li class='nav-item'>
            <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#{{$BlockID}}' aria-expanded='true' aria-controls='{{$BlockID}}'>
                <i class="fas fa-user-headset"></i><span>&nbsp;&nbsp;Add On</span>
            </a>
            <div id='{{$BlockID}}' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
                <div class='bg-white py-2 collapse-inner rounded'>
                    <a class='collapse-item' href='main.php?ab=4&p=13'><i class="fas fa-comment-dots"></i>&nbsp;&nbsp;Feedback</a>
                    <a class='collapse-item' href='main.php?ab=4&p=13'><i class="fas fa-comments"></i>&nbsp;&nbsp;Suggest A Correction</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-vacuum"></i><span>&nbsp;&nbsp;Question</span></a>
        </li>




        @php
            // $AdminButton = DB::table('admin_buttons')->get();
            // $Index = "1";
        @endphp
        {{-- @foreach($AdminButton as $n)
            @if ($n->ab_type == 1)
                <!-- Single Item -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route($n->ab_route) }}"><i class='{{$n->ab_icon}}'></i><span>&nbsp;&nbsp;{{ $n->ab_name }}</span></a>
                </li>
            @endif
            @if ($n->ab_type == 2)
            @php
                $BlockID = "BlockID_".$Index;
            @endphp
                <li class='nav-item'>
                <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#{{$BlockID}}' aria-expanded='true' aria-controls='{{$BlockID}}'>
                    <i class='{{ $n->ab_icon }}'></i><span>&nbsp;&nbsp;{{$n->ab_name}}</span></a>
                    <div id='{{$BlockID}}' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
                        <div class='bg-white py-2 collapse-inner rounded'>
                            @php
                            $AdminButtonSub = DB::table('admin_sub_buttons')->where('asb_ab_id', '=' , $n->ab_id)->get();    
                            @endphp    
                            @foreach($AdminButtonSub as $m)
                                <a class='collapse-item' href='main.php?ab=4&p=13'><i class='{{ $m->asb_icon }}'></i>&nbsp;&nbsp;{{$m->asb_name}}</a>
                            @endforeach
                        </div>
                    </div>
                </li>
                @php
                $Index++;
                @endphp
            @endif
            
        @endforeach --}}
</ul>
<!-- End of Sidebar -->