@include('../index_page.index_header')
@include('../index_page.header')  
<button onclick="topFunction()" id="backTop" title="Go to top"><i class="fa fa-arrow-up"></i></button>
     <!-- content -->
    <div class="main-content-wrapper">

        <div class="section page-contact-us">
            <div class="container">
                <div class="row" data-aos="fade-right" data-aos-duration="3000">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="contact-info-card v2">
                            <div class="icon-box">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <h3>Office Location</h3>
                            <p>1234, New Winston Road, New York, NY01234</p>
                            <a href="#">Find Us On Map</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="contact-info-card v2">
                            <div class="icon-box">
                                <i class="fa fa-clock-o"></i>
                            </div>
                            <h3>Office Hour</h3>
                            <p class="mb-1">Mon - Fri: 09:00am to 07:00pm </p>
                            <p class="theme-color-v1 mb-3">Sat - Sun: Off Day</p>
                            <a href="#">Get Directions</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="contact-info-card v2">
                            <div class="icon-box">
                                <i class="fa fa-phone"></i>
                            </div>
                            <h3>Phone Number</h3>
                            <p class="mb-1">+123-456-7890</p>
                            <p class="mb-1">+789-123-4567</p>
                            <a href="#">Call Now</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="contact-info-card v2">
                            <div class="icon-box">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <h3>Email Address</h3>
                            <p class="mb-1">sample@example.com</p>
                            <p class="mb-1">info@example.com</p>
                            <a href="#">Mail Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section contactus-form v2">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-7 col-lg-7">
                        <div class="contactus-form-wrapper" data-aos="fade-left"
                        data-aos-duration="3000">
                            <h3 class="contactus-form-heading">Contact Form</h3>
                            <form>
                                <div class="row" >
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="cf-input-container">
                                            <label>Your name *</label>
                                            <input class="" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="cf-input-container">
                                            <label>Your e-mail *</label>
                                            <input class="" id="txtcontact" type="text">

                                            <div class="error-msg-contact" id="error">
                                                <p>Invalid email address</p>
                                            </div>
        
                                        </div>
                                    </div>
                                    <div class="success-msg-contact" id="success">
                                        <p><span class="check-success-icon"><i class="fa fa-check"></i></span>Message Sent Successfully!</p>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="cf-input-container">
                                            <label>Your phone number *</label>
                                            <input class="" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="cf-input-container">
                                            <label>Message</label>
                                            <textarea class="text-white" rows="3" cols="33"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="form-submit-block">
                                            <button class="theme-btn btn-main" type="button" id="demoContact">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('index_page.footer')
@include('index_page.index_footer')