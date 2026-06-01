	@include('frontend.index_header')	
	@include('frontend.header')
	<section class="breadcrumb_part blog_grid_bg" style="max-height: 200px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 ">
                    <div class="breadcrumb_iner">
                        <h2>Register</h2>
                        <div class="breadcrumb_iner_link">
                            <a href="index.html">Home</a>
                            <i class="arrow_carrot-right"></i>
                            <span>Register</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="review_form contact_form section_padding">
        <div class="container">
            <h3 data-aos="fade-up" data-aos-duration="1200">Register</h3>
            <form data-aos="fade-up" data-aos-duration="1600" method="post">
                <div class="row justify-content-center" >
                    <div class="col-lg-4">
                        <div class="form_single_item">
                            <input type="text" name="fname" placeholder="First Name" required>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                    <div class="col-lg-4">
                        <div class="form_single_item">
                            <input type="text" name="lname" placeholder="Last Name" required>
                        </div>
                    </div>
                </div>   
                <div class="row justify-content-center" >
                    <div class="col-lg-4">
                        <div class="form_single_item">
                            <input type="text" name="email" placeholder="Email (User Name)" required>
                        </div>
                    </div>
                </div>       
                <div class="row justify-content-center" >    
                    <div class="col-lg-4">
                        <div class="form_single_item">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" >    
                    <div class="col-lg-4">
                        <div class="form_single_item">
                            <input type="password" name="password2" placeholder="Confirm Password" required>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" > 
                    <input type="submit" class="btn_3" value="Register">
                </div>
            </form>
        </div>
    </div>   
	@include('frontend.footer')
	@include('frontend.index_footer')