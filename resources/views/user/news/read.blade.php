@extends('user.layout.app')

@section('content')
    <div id="banner-area" class="banner-area" style="background-image:url({{ asset('user/assets/theme/images/banner/banner1.jpg') }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                <div class="col-lg-12">
                    <div class="banner-heading">
                        <h1 class="banner-title">News</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('all.news') }}">News</a></li>
                            <li class="breadcrumb-item active" aria-current="page">News bar</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <section id="main-container" class="main-container">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 mb-5 mb-lg-0">

                    <div class="post-content post-single">
                        <div class="post-media post-image">
                            <img loading="lazy" src="{{ asset('storage/'. $news->news_image) }}" class="img-fluid" alt="post-image">
                        </div>

                        <div class="post-body">
                            <div class="entry-header">
                                <div class="post-meta">
                                    <span class="post-author">
                                    <i class="far fa-user"></i><a href="#"> Admin</a>
                                    </span>
                                    <span class="post-cat">
                                    <i class="far fa-folder-open"></i><a href="#"> News</a>
                                    </span>
                                    <span class="post-meta-date"><i class="far fa-calendar"></i> {{ $news->created_at->format('F j, Y') }}</span>
                                    <span class="post-comment"><i class="far fa-comment"></i> 03<a href="#"
                                        class="comments-link">Comments</a></span>
                                </div>
                                <h2 class="entry-title">
                                    {{ $news->news_title }}
                                </h2>
                            </div>

                            <div class="entry-content">
                                <p>
                                    {{ $news->description }}
                                </p>

                                <blockquote>
                                    <p>
                                        {{ $news->quotes }}
                                    <cite>
                                        - Admin
                                    </cite>
                                    </p>

                                </blockquote>
                            </div>

                            <div class="tags-area d-flex align-items-center justify-content-between">
                                <div class="post-tags">
                                    <a href="#">IPO</a>
                                    <a href="#">Investment</a>
                                    <a href="#">Portfolio</a>
                                </div>
                                <div class="share-items">
                                    <ul class="post-social-icons list-unstyled">
                                        <li class="social-icons-head">Share:</li>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="author-box d-nlock d-sm-flex">
                        <div class="author-img mb-4 mb-md-0">
                            <img loading="lazy" src="{{ asset('auth/ANCSECURITIES.png') }}" alt="author">
                        </div>
                        <div class="author-info">
                            <h3>Admin Panel<span>Chairman/MD/CEO</span></h3>
                            <p class="mb-2">
                                Provide breakthrough technologies with quality solutions, in a competent manner to create the perfect healthcare eco-system in Bangladesh.
                            </p>
                            <p class="author-url mb-0">
                                Website:
                                <span>
                                    <a href="https://gmegroup.net/" target="_blank">
                                        GME GROUP
                                    </a>
                                </span>
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">

                    <div class="sidebar sidebar-right">
                        <div class="widget recent-posts">
                            <h3 class="widget-title">Recent Posts</h3>
                            <ul class="list-unstyled">
                                @if (count($recentPosts) > 0)
                                    @foreach ($recentPosts as $recentpost)
                                        <li class="d-flex align-items-center">
                                            <div class="posts-thumb">
                                                <a href="{{ route('news.read', ['id' => $recentpost->id]) }}">
                                                    <img loading="lazy" alt="img" src="{{ asset('storage/'.$recentpost->news_image) }}">
                                                </a>
                                            </div>
                                            <div class="post-info">
                                                <h4 class="entry-title">
                                                    <a href="{{ route('news.read', ['id' => $recentpost->id]) }}">
                                                        {!! $recentpost->news_title !!}
                                                    </a>
                                                </h4>
                                            </div>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="d-flex align-items-center">
                                        <div class="posts-thumb">
                                        <a href="#"><img loading="lazy" alt="img" src="{{ asset('user/assets/theme/images/news/news1.jpg') }}"></a>
                                        </div>
                                        <div class="post-info">
                                        <h4 class="entry-title">
                                            <a href="#">We Just Completes $17.6 Million Medical Clinic In Mid-missouri</a>
                                        </h4>
                                        </div>
                                    </li>

                                    <li class="d-flex align-items-center">
                                        <div class="posts-thumb">
                                        <a href="#"><img loading="lazy" alt="img" src="images/news/news2.jpg"></a>
                                        </div>
                                        <div class="post-info">
                                        <h4 class="entry-title">
                                            <a href="#">Thandler Airport Water Reclamation Facility Expansion Project Named</a>
                                        </h4>
                                        </div>
                                    </li>

                                    <li class="d-flex align-items-center">
                                        <div class="posts-thumb">
                                        <a href="#"><img loading="lazy" alt="img" src="images/news/news3.jpg"></a>
                                        </div>
                                        <div class="post-info">
                                        <h4 class="entry-title">
                                            <a href="#">Silicon Bench And Cornike Begin Construction Solar Facilities</a>
                                        </h4>
                                        </div>
                                    </li>
                                @endif
                            </ul>

                        </div>

                        <div class="widget">
                            <h3 class="widget-title">Categories</h3>
                            <ul class="arrow nav nav-tabs">
                            <li><a href="#">Construction</a></li>
                            <li><a href="#">Commercial</a></li>
                            <li><a href="#">Building</a></li>
                            <li><a href="#">Safety</a></li>
                            <li><a href="#">Structure</a></li>
                            </ul>
                        </div>

                        <div class="widget">
                            <h3 class="widget-title">Archives </h3>
                            <ul class="arrow nav nav-tabs">
                                <li><a href="#">Feburay 2016</a></li>
                                <li><a href="#">January 2016</a></li>
                                <li><a href="#">December 2015</a></li>
                                <li><a href="#">November 2015</a></li>
                                <li><a href="#">October 2015</a></li>
                            </ul>
                        </div>

                    <div class="widget widget-tags">
                        <h3 class="widget-title">Tags </h3>

                        <ul class="list-unstyled">
                            @if (count($tags) > 0)
                                @foreach ($tags as $tag)
                                    <li style="text-transform: uppercase;"><a href="#">{{ $tag }}</a></li>
                                @endforeach
                            @else
                                <li><a href="#">IPO</a></li>
                                <li><a href="#">Protfolio</a></li>
                                <li><a href="#">Investment</a></li>
                                <li><a href="#">Stock Market</a></li>
                                <li><a href="#">Risk Management</a></li>
                                <li><a href="#">Planning</a></li>
                            @endif
                        </ul>
                    </div>


                    </div><!-- Sidebar end -->
                </div>

            </div>
        </div>
    </section>
@endsection
