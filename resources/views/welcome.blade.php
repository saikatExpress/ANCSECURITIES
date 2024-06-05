@extends('user.layout.app')
    @section('content')

        {{-- For banner block --}}
        <x-banner-component/>
        {{-- For banner block --}}

        <section class="call-to-action-box no-padding">
            <div class="container">
                <div class="action-style-box">
                    <div class="row align-items-center">
                        <div class="col-md-8 text-center text-md-left">
                            <div class="call-to-action-text">
                                <h3 class="action-title">Ready to enhance your investment portfolio?</h3>
                            </div>
                        </div>
                        <div class="col-md-4 text-center text-md-right mt-3 mt-md-0">
                            <div class="call-to-action-btn">
                                <a class="btn btn-dark" href="{{ route('contact.us') }}">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Action end -->

        <section id="ts-features" class="ts-features">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ts-intro">
                            <h2 class="into-title">About Us</h2>
                            <h3 class="into-sub-title">Your Trusted Brokerage Partner</h3>
                            <p>At ANC Securities Ltd, we pride ourselves on delivering exceptional brokerage services. Our mission is to provide our clients with the highest level of financial expertise and personalized service. With a commitment to transparency and integrity, we help investors navigate the complexities of the financial markets, ensuring they achieve their investment goals.</p>
                        </div>


                        <div class="gap-20"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="ts-service-box">
                                    <span class="ts-service-icon">
                                        <i class="fas fa-chart-line"></i>
                                    </span>
                                    <div class="ts-service-box-content">
                                        <h3 class="service-box-title">Expert Financial Guidance</h3>
                                        {{-- <p>We provide expert financial advice and market insights to help you make informed investment decisions.</p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="ts-service-box">
                                    <span class="ts-service-icon">
                                        <i class="fas fa-handshake"></i>
                                    </span>
                                    <div class="ts-service-box-content">
                                        <h3 class="service-box-title">Building Trust with Clients</h3>
                                        {{-- <p>Our success is built on trust and long-term relationships with our clients, ensuring their financial growth.</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="ts-service-box">
                                    <span class="ts-service-icon">
                                        <i class="fas fa-bullseye"></i>
                                    </span>
                                    <div class="ts-service-box-content">
                                        <h3 class="service-box-title">Committed to Your Goals</h3>
                                        {{-- <p>We are committed to helping you achieve your financial goals with tailored investment strategies.</p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="ts-service-box">
                                    <span class="ts-service-icon">
                                        <i class="fas fa-briefcase"></i>
                                    </span>
                                    <div class="ts-service-box-content">
                                        <h3 class="service-box-title">Professional Expertise</h3>
                                        {{-- <p>Our team of experienced professionals brings a wealth of knowledge and expertise to manage your investments effectively.</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <h3 class="into-sub-title">Our Values</h3>
                        <p>
                            At ANC Securities Ltd., we are driven by a set of core values that guide our actions and decisions. These values form the foundation of our commitment to our clients and the financial markets.
                        </p>

                        <div class="accordion accordion-group" id="our-values-accordion">
                            <div class="card">
                                <div class="card-header p-0 bg-transparent" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Client-Centric Approach
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#our-values-accordion">
                                    <div class="card-body">
                                        Our clients' success is our top priority. We focus on understanding their needs and providing personalized solutions to help them achieve their financial goals.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header p-0 bg-transparent" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Integrity and Transparency
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#our-values-accordion">
                                    <div class="card-body">
                                        We operate with the highest level of integrity and transparency, ensuring that our clients have complete confidence in our services and advice.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header p-0 bg-transparent" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Innovation and Excellence
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#our-values-accordion">
                                    <div class="card-body">
                                        We strive for excellence in everything we do and constantly seek innovative solutions to meet the evolving needs of our clients and the market.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header p-0 bg-transparent" id="headingFour">
                                    <h2 class="mb-0">
                                        <button class="btn btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Professionalism and Expertise
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#our-values-accordion">
                                    <div class="card-body">
                                        Our team of professionals brings extensive expertise and experience to provide the highest quality of service and advice to our clients.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="facts" class="facts-area dark-bg">
            <div class="container">
                <div class="facts-wrapper">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 ts-facts">
                            <div class="ts-facts-img">
                                <img loading="lazy" src="{{ asset('user/assets/theme/images/icon-image/fact1.png') }}" alt="facts-img">
                            </div>
                            <div class="ts-facts-content">
                                <h2 class="ts-facts-num"><span class="counterUp" data-count="1500">0</span>+</h2>
                                <h3 class="ts-facts-title">Successful Trades</h3>
                            </div>
                        </div><!-- Col end -->

                        <div class="col-md-3 col-sm-6 ts-facts mt-5 mt-sm-0">
                            <div class="ts-facts-img">
                                <img loading="lazy" src="{{ asset('user/assets/theme/images/icon-image/fact2.png') }}" alt="facts-img">
                            </div>
                            <div class="ts-facts-content">
                                <h2 class="ts-facts-num"><span class="counterUp" data-count="800">0</span>+</h2>
                                <h3 class="ts-facts-title">Satisfied Clients</h3>
                            </div>
                        </div><!-- Col end -->

                        <div class="col-md-3 col-sm-6 ts-facts mt-5 mt-md-0">
                            <div class="ts-facts-img">
                                <img loading="lazy" src="{{ asset('user/assets/theme/images/icon-image/fact3.png') }}" alt="facts-img">
                            </div>
                            <div class="ts-facts-content">
                                <h2 class="ts-facts-num"><span class="counterUp" data-count="20">0</span>+</h2>
                                <h3 class="ts-facts-title">Years of Experience</h3>
                            </div>
                        </div><!-- Col end -->

                        <div class="col-md-3 col-sm-6 ts-facts mt-5 mt-md-0">
                            <div class="ts-facts-img">
                                <img loading="lazy" src="{{ asset('user/assets/theme/images/icon-image/fact4.png') }}" alt="facts-img">
                            </div>
                            <div class="ts-facts-content">
                                <h2 class="ts-facts-num"><span class="counterUp" data-count="100">0</span>%</h2>
                                <h3 class="ts-facts-title">Client Retention Rate</h3>
                            </div>
                        </div><!-- Col end -->
                    </div> <!-- Facts end -->
                </div>
                <!--/ Content row end -->
            </div>
        </section>

        <!-- Facts end -->

        <section id="project-area" class="project-area solid-bg">
            <div class="container">
                <div class="row text-center">
                    <div class="col-lg-12">
                        <h2 class="section-title">Our Achievements</h2>
                        <h3 class="section-sub-title">Recent Success Stories</h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="shuffle-btn-group">
                            <label class="active" for="all">
                                <input type="radio" name="shuffle-filter" id="all" value="all" checked="checked">Show All
                            </label>
                            <label for="ipo">
                                <input type="radio" name="shuffle-filter" id="ipo" value="ipo">IPOs
                            </label>
                            <label for="investment">
                                <input type="radio" name="shuffle-filter" id="investment" value="investment">Investment Management
                            </label>
                            <label for="trading">
                                <input type="radio" name="shuffle-filter" id="trading" value="trading">Trading
                            </label>
                            <label for="advisory">
                                <input type="radio" name="shuffle-filter" id="advisory" value="advisory">Advisory
                            </label>
                        </div>

                        <div class="row shuffle-wrapper">
                            <div class="col-1 shuffle-sizer"></div>

                            <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;ipo&quot;,&quot;investment&quot;]">
                                <div class="project-img-container">
                                    <a class="gallery-popup" href="{{ asset('user/assets/logos/360_F_97169694_MmpHAfV4KZF5mcSJVMsjcVw1Q4Vd7tQK.jpg') }}" aria-label="project-img">
                                        <img class="img-fluid" src="{{ asset('user/assets/logos/360_F_97169694_MmpHAfV4KZF5mcSJVMsjcVw1Q4Vd7tQK.jpg') }}" alt="project-img">
                                        <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                    </a>
                                    <div class="project-item-info">
                                        <div class="project-item-info-content">
                                            <h3 class="project-item-title">
                                                <a href="projects-single.html">Successful IPO for TechCorp</a>
                                            </h3>
                                            <p class="project-cat">IPOs, Investment Management</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;advisory&quot;]">
                                <div class="project-img-container">
                                    <a class="gallery-popup" href="{{ asset('user/assets/logos/investement.jpg') }}" aria-label="project-img">
                                        <img class="img-fluid" src="{{ asset('user/assets/logos/investement.jpg') }}" alt="project-img">
                                        <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                    </a>
                                    <div class="project-item-info">
                                        <div class="project-item-info-content">
                                            <h3 class="project-item-title">
                                                <a href="projects-single.html">Strategic Advisory for FinTech Innovations</a>
                                            </h3>
                                            <p class="project-cat">Advisory</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;trading&quot;,&quot;investment&quot;]">
                                <div class="project-img-container">
                                    <a class="gallery-popup" href="{{ asset('user/assets/logos/investing1.jpg') }}" aria-label="project-img">
                                        <img class="img-fluid" src="{{ asset('user/assets/logos/investing1.jpg') }}" alt="project-img">
                                        <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                    </a>
                                    <div class="project-item-info">
                                        <div class="project-item-info-content">
                                            <h3 class="project-item-title">
                                                <a href="projects-single.html">High-Frequency Trading Platform</a>
                                            </h3>
                                            <p class="project-cat">Trading, Investment Management</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;advisory&quot;,&quot;investment&quot;]">
                                <div class="project-img-container">
                                    <a class="gallery-popup" href="{{ asset('user/assets/logos/invest3.jpg') }}" aria-label="project-img">
                                        <img class="img-fluid" src="{{ asset('user/assets/logos/invest3.jpg') }}" alt="project-img">
                                        <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                    </a>
                                    <div class="project-item-info">
                                        <div class="project-item-info-content">
                                            <h3 class="project-item-title">
                                                <a href="projects-single.html">Comprehensive Investment Portfolio Management</a>
                                            </h3>
                                            <p class="project-cat">Investment Management</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;investment&quot;,&quot;trading&quot;]">
                                <div class="project-img-container">
                                    <a class="gallery-popup" href="{{ asset('user/assets/logos/photo-1634704784915-aacf363b021f.avif') }}" aria-label="project-img">
                                        <img class="img-fluid" src="{{ asset('user/assets/logos/photo-1634704784915-aacf363b021f.avif') }}" alt="project-img">
                                        <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                    </a>
                                    <div class="project-item-info">
                                        <div class="project-item-info-content">
                                            <h3 class="project-item-title">
                                                <a href="projects-single.html">Innovative Trading Strategies</a>
                                            </h3>
                                            <p class="project-cat">Trading</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 shuffle-item" data-groups="[&quot;advisory&quot;]">
                                <div class="project-img-container">
                                    <a class="gallery-popup" href="{{ asset('user/assets/logos/HD-wallpaper-parental-advisory.jpg') }}" aria-label="project-img">
                                        <img class="img-fluid" src="{{ asset('user/assets/logos/HD-wallpaper-parental-advisory.jpg') }}" alt="project-img">
                                        <span class="gallery-icon"><i class="fa fa-plus"></i></span>
                                    </a>
                                    <div class="project-item-info">
                                        <div class="project-item-info-content">
                                            <h3 class="project-item-title">
                                                <a href="projects-single.html">Financial Planning and Advisory Services</a>
                                            </h3>
                                            <p class="project-cat">Advisory</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="general-btn text-center">
                            <a class="btn btn-primary" href="projects.html">View All Success Stories</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="ts-service-area" class="ts-service-area pb-0">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <h2 class="section-title">We Are Specialists In</h2>
                        <h3 class="section-sub-title">What We Do</h3>
                    </div>
                </div>
                <!--/ Title row end -->

                <div class="row">
                    <div class="col-lg-4">
                        <div class="ts-service-box d-flex">
                            <div class="ts-service-box-img">
                                <i class="fas fa-chart-line fa-3x"></i>
                            </div>
                            <div class="ts-service-box-info">
                                <h3 class="service-box-title"><a href="#">Equity Trading</a></h3>
                                <p>Our equity trading services provide clients with the tools and insights needed to make informed investment decisions in the stock market.</p>
                            </div>
                        </div><!-- Service 1 end -->

                        <div class="ts-service-box d-flex">
                            <div class="ts-service-box-img">
                                <i class="fas fa-user-tie fa-3x"></i>
                            </div>
                            <div class="ts-service-box-info">
                                <h3 class="service-box-title"><a href="#">Investment Advisory</a></h3>
                                <p>We offer personalized investment advisory services to help you build a robust financial portfolio.</p>
                            </div>
                        </div><!-- Service 2 end -->

                        <div class="ts-service-box d-flex">
                            <div class="ts-service-box-img">
                                <i class="fas fa-wallet fa-3x"></i>
                            </div>
                            <div class="ts-service-box-info">
                                <h3 class="service-box-title"><a href="#">Portfolio Management</a></h3>
                                <p>Our portfolio management services ensure your investments are optimized for growth and security.</p>
                            </div>
                        </div><!-- Service 3 end -->

                    </div>

                    <div class="col-lg-4 text-center">
                        <img loading="lazy" style="height: 435px !important;" class="img-fluid" src="https://prowess.org.uk/wp-content/uploads/2024/02/towfiqu-barbhuiya-joqWSI9u_XM-unsplash-scaled.jpg" alt="service-avatar-image">
                    </div>

                    <div class="col-lg-4 mt-5 mt-lg-0 mb-4 mb-lg-0">
                        <div class="ts-service-box d-flex">
                            <div class="ts-service-box-img">
                                <i class="fas fa-search-dollar fa-3x"></i>
                            </div>
                            <div class="ts-service-box-info">
                                <h3 class="service-box-title"><a href="#">Research Analysis</a></h3>
                                <p>We provide in-depth market research and analysis to guide your investment strategies.</p>
                            </div>
                        </div><!-- Service 4 end -->

                        <div class="ts-service-box d-flex">
                            <div class="ts-service-box-img">
                                <i class="fas fa-coins fa-3x"></i>
                            </div>
                            <div class="ts-service-box-info">
                                <h3 class="service-box-title"><a href="#">Wealth Management</a></h3>
                                <p>Our wealth management services are designed to help you grow and protect your financial assets.</p>
                            </div>
                        </div><!-- Service 5 end -->

                        <div class="ts-service-box d-flex">
                            <div class="ts-service-box-img">
                                <i class="fas fa-shield-alt fa-3x"></i>
                            </div>
                            <div class="ts-service-box-info">
                                <h3 class="service-box-title"><a href="#">Risk Management</a></h3>
                                <p>We offer comprehensive risk management services to safeguard your investments against market volatility.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Project area end -->

        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <h3 class="column-title">Testimonials</h3>

                        <div id="testimonial-slide" class="testimonial-slide">
                            <div class="item">
                                <div class="quote-item">
                                    <span class="quote-text">
                                        ANC Securities Ltd. has been a pivotal part of my investment strategy. Their insights and support have consistently helped me achieve my financial goals.
                                    </span>

                                    <div class="quote-item-footer">
                                        <img loading="lazy" class="testimonial-thumb" height="75" src="{{ asset('user/assets/logos/images.jpg') }}" alt="testimonial">
                                        <div class="quote-item-info">
                                            <h3 class="quote-author">DR. Farhana Monem</h3>
                                            <span class="quote-subtext">Chairman, ANC</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="quote-item">
                                    <span class="quote-text">
                                        The professional advice and services provided by ANC Securities Ltd. have been invaluable in navigating the stock market effectively.
                                    </span>

                                    <div class="quote-item-footer">
                                        <img loading="lazy" height="75" class="testimonial-thumb" src="{{ asset('user/assets/logos/chowdhury-hasan-mahmud.avif') }}" alt="testimonial">
                                        <div class="quote-item-info">
                                            <h3 class="quote-author">DR. CHOWDHURY HASAN MAHMUD</h3>
                                            <span class="quote-subtext">Managing Director</span>
                                            <span class="quote-subtext">(1969-2021)</span>
                                        </div>
                                    </div>
                                </div><!-- Quote item end -->
                            </div>
                            <!--/ Item 2 end -->

                            {{-- <div class="item">
                                <div class="quote-item">
                                    <span class="quote-text">
                                        ANC Securities Ltd. offers exceptional customer service and personalized financial advice. They have been an excellent partner in my investment journey.
                                    </span>

                                    <div class="quote-item-footer">
                                        <img loading="lazy" class="testimonial-thumb" src="{{ asset('user/assets/theme/images/clients/testimonial3.png') }}" alt="testimonial">
                                        <div class="quote-item-info">
                                            <h3 class="quote-author">Minter Puchan</h3>
                                            <span class="quote-subtext">Director, AKT</span>
                                        </div>
                                    </div>
                                </div><!-- Quote item end -->
                            </div> --}}
                            <!--/ Item 3 end -->

                        </div>
                        <!--/ Testimonial carousel end-->
                    </div><!-- Col end -->

                    <div class="col-lg-6 mt-5 mt-lg-0">
                        <h3 class="column-title">Happy Clients</h3>

                        <div class="row all-clients">
                            <div class="col-sm-4 col-6">
                                <figure class="clients-logo">
                                    <a href="#!"><img loading="lazy" class="img-fluid" src="{{ asset('user/assets/theme/images/clients/client1.png') }}" alt="clients-logo" /></a>
                                </figure>
                            </div><!-- Client 1 end -->

                            <div class="col-sm-4 col-6">
                                <figure class="clients-logo">
                                    <a href="#!"><img loading="lazy" class="img-fluid" src="{{ asset('user/assets/theme/images/clients/client2.png') }}" alt="clients-logo" /></a>
                                </figure>
                            </div><!-- Client 2 end -->

                            <div class="col-sm-4 col-6">
                                <figure class="clients-logo">
                                    <a href="#!"><img loading="lazy" class="img-fluid" src="{{ asset('user/assets/theme/images/clients/client3.png') }}" alt="clients-logo" /></a>
                                </figure>
                            </div><!-- Client 3 end -->

                            <div class="col-sm-4 col-6">
                                <figure class="clients-logo">
                                    <a href="#!"><img loading="lazy" class="img-fluid" src="{{ asset('user/assets/theme/images/clients/client4.png') }}" alt="clients-logo" /></a>
                                </figure>
                            </div><!-- Client 4 end -->

                            <div class="col-sm-4 col-6">
                                <figure class="clients-logo">
                                    <a href="#!"><img loading="lazy" class="img-fluid" src="{{ asset('user/assets/theme/images/clients/client5.png') }}" alt="clients-logo" /></a>
                                </figure>
                            </div><!-- Client 5 end -->

                            <div class="col-sm-4 col-6">
                                <figure class="clients-logo">
                                    <a href="#!"><img loading="lazy" class="img-fluid" src="{{ asset('user/assets/theme/images/clients/client6.png') }}" alt="clients-logo" /></a>
                                </figure>
                            </div><!-- Client 6 end -->

                        </div><!-- Clients row end -->

                    </div><!-- Col end -->

                </div>
                <!--/ Content row end -->
            </div>
        </section>

        <!-- Content end -->

        <section class="subscribe no-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                    <div class="subscribe-call-to-acton">
                        <h3>Can We Help?</h3>
                        <h4>(+88) 01844-547916</h4>
                    </div>
                    </div><!-- Col end -->

                    <div class="col-lg-8">
                    <div class="ts-newsletter row align-items-center">
                        <div class="col-md-5 newsletter-introtext">
                            <h4 class="text-white mb-0">Newsletter Sign-up</h4>
                            <p class="text-white">Latest updates and news</p>
                        </div>

                        <div class="col-md-7 newsletter-form">
                            <form action="#" method="post">
                                <div class="form-group">
                                <label for="newsletter-email" class="content-hidden">Newsletter Email</label>
                                <input type="email" name="email" id="newsletter-email" class="form-control form-control-lg" placeholder="Your your email and hit enter" autocomplete="off">
                                </div>
                            </form>
                        </div>
                    </div><!-- Newsletter end -->
                    </div><!-- Col end -->

                </div><!-- Content row end -->
            </div>
        </section>
        <!--/ subscribe end -->

        <section id="news" class="news">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <h2 class="section-title">Latest Financial News</h2>
                        <h3 class="section-sub-title">Stay Updated with ANC Securities Ltd.</h3>
                    </div>
                </div>
                <!--/ Title row end -->

                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                <a href="news-single.html" class="latest-post-img">
                                    <img loading="lazy" class="img-fluid" src="{{ asset('user/assets/logos/chart-trading-courses-forex.jpg') }}" alt="img">
                                </a>
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="news-single.html" class="d-inline-block">Stock Market Analysis: Trends and Insights</a>
                                </h4>
                                <div class="latest-post-meta">
                                    <span class="post-item-date">
                                        <i class="fa fa-clock-o"></i> July 20, 2024
                                    </span>
                                </div>
                            </div>
                        </div><!-- Latest post end -->
                    </div><!-- 1st post col end -->

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                <a href="news-single.html" class="latest-post-img">
                                    <img loading="lazy" class="img-fluid" src="{{ asset('user/assets/logos/sd-eu-retail-investment-strategy-v1-page-10-temporay.jpg') }}" alt="img">
                                </a>
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="news-single.html" class="d-inline-block">Investment Strategies for Volatile Markets</a>
                                </h4>
                                <div class="latest-post-meta">
                                    <span class="post-item-date">
                                        <i class="fa fa-clock-o"></i> June 17, 2024
                                    </span>
                                </div>
                            </div>
                        </div><!-- Latest post end -->
                    </div><!-- 2nd post col end -->

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="latest-post">
                            <div class="latest-post-media">
                                <a href="news-single.html" class="latest-post-img">
                                    <img loading="lazy" class="img-fluid" src="{{ asset('user/assets/logos/1702981193757.jpg') }}" alt="img">
                                </a>
                            </div>
                            <div class="post-body">
                                <h4 class="post-title">
                                    <a href="news-single.html" class="d-inline-block">Economic Outlook: Prospects for Growth in Q3</a>
                                </h4>
                                <div class="latest-post-meta">
                                    <span class="post-item-date">
                                        <i class="fa fa-clock-o"></i> Aug 13, 2024
                                    </span>
                                </div>
                            </div>
                        </div><!-- Latest post end -->
                    </div><!-- 3rd post col end -->
                </div>
                <!--/ Content row end -->

                <div class="general-btn text-center mt-4">
                    <a class="btn btn-primary" href="news-left-sidebar.html">See All News</a>
                </div>

            </div>
        </section>

        <!--/ News end -->

    @endsection
