<div class="site-navigation">
            <div class="container">
                <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-dark p-0">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div id="navbar-collapse" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav mr-auto">
                                <li class="nav-item dropdown active">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Home <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="active"><a href="{{ url('/') }}">Home One</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Company <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ route('about.us') }}">About Us</a></li>
                                        <li><a href="{{ route('board.director') }}">Board Of Directors</a></li>
                                        <li><a href="team.html">Management Team</a></li>
                                        <li><a href="testimonials.html">Sister of concern</a></li>
                                        <li><a href="{{ route('faq.us') }}">Faq</a></li>
                                        <li><a href="pricing.html">Pricing</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('online.bo') }}">
                                        ONLINE BO SYSTEM
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">FORM DOWNLOAD <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="projects.html">BO Closing Form</a></li>
                                        <li><a href="projects.html">Demat Form</a></li>
                                        <li><a href="projects-single.html">DSE Mobile Registation</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Services <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="services.html">Fund withdraw request generate</a></li>
                                        <li><a href="service-single.html">Fund deposite request generate</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">MARKET OVERVIEW <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="https://www.dse.com.bd/top_20_share.php" target="_blank">
                                                Top 20 Market Movers
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://dsebd.org/Company_AGM.htm" target="_blank">
                                                Declaration & AGM
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.dse.com.bd/latest_share_price_scroll_l.php" target="_blank">
                                                Historical Price & Volume
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.dse.com.bd/ipo.php" target="_blank">
                                                New Issues (IPO)
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.dsebd.org/latest_PE.php" target="_blank">
                                                EPS/PE
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.cnbc.com/futures-and-commodities/" target="_blank">
                                                World Market
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Others <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            @php
                                                $url = md5('login');
                                            @endphp
                                            <a href="{{ route($url) }}">Login</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('sign.up') }}">Registation</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('gallery.us') }}">
                                                Gallery
                                            </a>
                                        </li>
                                        <li><a href="news-single.html">News Single</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item"><a class="nav-link" href="{{ route('contact.us') }}">Contact</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!--/ Col end -->
                </div>
                <!--/ Row end -->

                <div class="nav-search">
                <span id="search"><i class="fa fa-search"></i></span>
                </div><!-- Search end -->

                <div class="search-block" style="display: none;">
                <label for="search-field" class="w-100 mb-0">
                    <input type="text" class="form-control" id="search-field" placeholder="Type what you want and enter">
                </label>
                <span class="search-close">&times;</span>
                </div><!-- Site search end -->
            </div>
            <!--/ Container end -->

        </div>
