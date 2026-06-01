	@include('frontend.index_header')	
	@if(Auth::check())
    	@include('frontend.headerAuth')
	@else
		@include('frontend.header')
	@endif
	@include('frontend.banner')
	@include('frontend.block_one')
	@include('frontend.block_two')
	@include('frontend.block_exam')
	@include('frontend.block_online')
	{{-- @include('frontend.team') --}}
	{{-- @include('frontend.block_three') --}}
	{{-- @include('frontend.block_four') --}}
	{{-- @include('frontend.faq') --}}
	@include('frontend.block_five')
	@include('frontend.aboutus')
	@include('frontend.footer')
	@include('frontend.index_footer')
	
						
		
		
		
		
		
		
		
		
										
										
					
					
					
					
					