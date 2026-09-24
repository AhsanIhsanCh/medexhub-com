@include('admin.pages.index_header')
	<!-- Main Wrapper -->
	<div class="main-wrapper">		
		@include('admin.pages.topbar')
		@include('admin.pages.sidebar')
        @yield('dashboard')
		@yield('payment')
		@yield('paymentreturn')
		@yield('paymentmiscellaneous')
		@yield('users')
		@yield('users-ban')
		@yield('users-pending')
		@yield('conversation')
		@yield('exams')
		@yield('mcq')
		@yield('emq')
		@yield('flashcard')
		@yield('kfp1')
		@yield('kfp2')
		@yield('examyear')
		@yield('coupons')
		@yield('maintenance-session')
		@yield('maintenance-login')

		
      	
		
		
		
		
	</div>
	<!-- /Main Wrapper -->
	 @include('admin.popup.addstock')
@include('admin.pages.index_footer')