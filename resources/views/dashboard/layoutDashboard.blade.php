	@include('frontend.index_header')	
	@include('frontend.headerAuth')















    <!-- breadcrumb part -->
    <div style="background-color: #000;">a</div>
    
    {{-- <section class="breadcrumb_part blog_grid_bg" style="max-height: 10px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 ">
                    <div class="breadcrumb_iner">
                        <h2>Dashboard</h2>
                        <div class="breadcrumb_iner_link">
                            <a href="index.html">Home</a>
                            <i class="arrow_carrot-right"></i>
                            <span>Contact</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- breadcrumb part end -->
    
    <!-- my profile part here -->
    <div id="primary" class="content-area section_padding" bis_skin_checked="1">
        <main id="main" class="site-main">
            <div class="container" bis_skin_checked="1">            
                <article id="post-47" class="post-47 page type-page status-publish hentry">
                    <div class="entry-content" bis_skin_checked="1">
                        <div class="learnpress" bis_skin_checked="1">
                            <div id="learn-press-profile" class="lp-user-profile current-user" bis_skin_checked="1"> 
                                <div class="main-content-area" bis_skin_checked="1">
                                    <aside id="profile-sidebar" style="margin-bottom: 30px;">
                                        @include('dashboard.dashboardMenu')
                                    </aside>
                                    <article id="profile-content" class="lp-profile-content" style="padding-top: 0px;">
                                        {{-- <div id="profile-content-courses" bis_skin_checked="1">    
                                            <div class="learn-press-subtab-content" bis_skin_checked="1">
                                                <div class="learn-press-profile-course__statistic" data-ajax="{&quot;userID&quot;:3}" bis_skin_checked="1">
                                            <div id="dashboard-general-statistic" bis_skin_checked="1">
                                                <div class="dashboard-general-statistic__row" bis_skin_checked="1">
                                                    <div class="statistic-box" bis_skin_checked="1">
                                                        <p class="statistic-box__text">Enrolled Courses</p>
                                                        <span class="statistic-box__number">0</span>
                                                    </div>
                                                    <div class="statistic-box" bis_skin_checked="1">
                                                        <p class="statistic-box__text">Active Courses</p>
                                                        <span class="statistic-box__number">0</span>
                                                    </div>
                                                    <div class="statistic-box" bis_skin_checked="1">
                                                        <p class="statistic-box__text">Completed Courses</p>
                                                        <span class="statistic-box__number">0</span>
                                                    </div>
                                                </div>
                                                <div class="dashboard-general-statistic__row" bis_skin_checked="1">

                                                    <div class="statistic-box" bis_skin_checked="1">
                                                        <p class="statistic-box__text">Total Courses</p>
                                                        <span class="statistic-box__number">5</span>
                                                    </div>
                                                    <div class="statistic-box" bis_skin_checked="1">
                                                        <p class="statistic-box__text">Total Students</p>
                                                        <span class="statistic-box__number">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        @yield('exam')
                                        @yield('showtest')
                                        @yield('createnew')
                                        @yield('viewexam')
                                        @yield('message')
                                        @yield('workboard')
                                        {{-- @yield('result') --}}
                                        @yield('subsection')
                                        @yield('basket')
                                        @yield('subscriptions')
                                        @yield('invoice')
                                        @yield('invoice')
                                        @yield('examhistory')
                                        @yield('loginhistory')
                                        @yield('betteranswer')
                                        @yield('correction')
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div><!-- .entry-content -->
                </article>
            </div>
        </main><!-- #main -->
    </div>
    <!-- my profile part end -->
@include('frontend.footer')
@include('frontend.index_footer')