@include('../index_page.index_header')
@include('../index_page.header')  
<button onclick="topFunction()" id="backTop" title="Go to top"><i class="fa fa-arrow-up"></i></button>
    <!-- content -->
    <div class="main-content-wrapper">
        <!-- page banner -->
        <div class="page-banner-container">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="page-banner-wrapper">
                            <h1 class="page-banner-heading">Every Company Is A Content Company</h1>
                            <ul>
                                <li><a href="../index.html">Home</a></li>
                                <li class="divider-bredacrumb">/</li>
                                <li><a href="../pages/pricing.html">Pricing</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- pricing -->
        <div class="section pricing">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-12 col-md-8 col-lg-8">
                        <div class="section-heading-wrapper">
                            <span class="section-small-hading">PLANS & PRICING</span>
                            <h2 class="section-heading">Plans that best suit your business requirements</h2>
                            <p class="section-description text-center">Affordable plans for growth, support, and ongoing engagement.</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-4" data-aos="fade-up"
                data-aos-duration="3000">
                    <div class="col-12 col-md-4 col-lg-4 mb-4">
                        <div class="pricing-card bronze">
                            <div class="pricing-top">
                                <h4>Silver </h4>
                                <h1>$19 <span>/Month</span></h1>
                                <a class="theme-btn btn-light" href="#">Start free trial today</a>
                            </div>
                            <div class="pricing-list">
                                <ul>
                                    <li><i class="fa fa-check"></i>Unlimited audio transcription</li>
                                    <li><i class="fa fa-check"></i>10 templates; SOAP/HPI/MSE</li>
                                    <li><i class="fa fa-check"></i>Advanced editor; export to letters</li>
                                    <li><i class="fa fa-check"></i>Secure encryption; consent & audit trails</li>
                                </ul>
                            </div>
                            <div class="banner-btns" style="padding-top: 30px;">
                                <a href="#" class="theme-btn btn-main">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4 mb-4">
                        <div class="pricing-card silver">
                            <div class="pricing-top">
                                <h4>Bronze </h4>
                                <h1>$29 <span>/Month</span></h1>
                                <a class="theme-btn btn-secondary" href="#">Start free trial today</a>
                            </div>
                            <div class="pricing-list">
                                <ul>
                                    <li><i class="fa fa-check"></i>Unlimited audio transcription</li>
                                    <li><i class="fa fa-check"></i>30 templates; coding hints</li>
                                    <li><i class="fa fa-check"></i>Telehealth-ready</li>
                                    <li><i class="fa fa-check"></i>Priority support</li>
                                </ul>
                            </div>
                            <div class="banner-btns" style="padding-top: 30px;">
                                <a href="#" class="theme-btn btn-main">Buy Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4 mb-4">
                        <div class="pricing-card diamond">
                            <div class="pricing-top">
                                <h4>Group Practice</h4>
                                <h1>$99 <span>/Month</span> <span style="font-size: 10px;"> (For five login)</span></h1>
                                <h3></h3>
                                <a class="theme-btn btn-light" href="#">Start free trial today</a>
                            </div>
                            <div class="pricing-list">
                                <ul>
                                    <li><i class="fa fa-check"></i>Unlimited audio transcription</li>
                                    <li><i class="fa fa-check"></i>Specialty packs; team admin;</li>
                                    <li><i class="fa fa-check"></i>EHR-friendly export; custom templates</li>
                                    <li><i class="fa fa-check"></i>Dedicated Support</li>
                                </ul>
                            </div>
                            <div class="banner-btns" style="padding-top: 30px;">
                                <a href="#" class="theme-btn btn-main">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('index_page.faq')
        @include('index_page.block_get_start')
    </div>
@include('index_page.footer')
@include('index_page.index_footer')