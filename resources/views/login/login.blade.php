	@include('frontend.index_header')	
	@include('frontend.header')
	<section class="breadcrumb_part blog_grid_bg" style="max-height: 200px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 ">
                    <div class="breadcrumb_iner">
                        <h2>Sign In</h2>
                        <div class="breadcrumb_iner_link">
                            <a href="index.html">Home</a>
                            <i class="arrow_carrot-right"></i>
                            <span>Sign In</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="review_form contact_form section_padding">
        <div class="container">
            <h3 data-aos="fade-up" data-aos-duration="1200">Sign In</h3>
            <form  action="{{ route('loginRequest') }}" method="post">
            @csrf
                <div class="row justify-content-center" >
                    <div class="col-lg-4">
                        <div class="form_single_item">
                           <input type="email" name="email" value="{{ old('username') }}" placeholder="name@example.com" />
                        </div>
                    </div>
                </div>    
                <div class="row justify-content-center" >    
                    <div class="col-lg-4">
                        <div class="form_single_item">
                            <input  type="password" name="password" placeholder="Password" />
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" > 
                    <input type="submit" class="btn_3" value="Sign In">
                </div>
            </form>
        </div>
    </div>   
	@include('frontend.footer')
	@include('frontend.index_footer')