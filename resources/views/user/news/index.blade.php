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
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">News</a></li>
                            <li class="breadcrumb-item active" aria-current="page">News Bar</li>
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

            <div class="col-lg-4 order-1 order-lg-0">

                <div class="sidebar sidebar-left">
                    <div class="widget recent-posts">
                        <h3 class="widget-title">Recent Posts</h3>
                        <ul class="list-unstyled">
                            @if (count($recentPosts) > 0)
                                @foreach ($recentPosts as $recentPost)
                                    <li class="d-flex align-items-center">
                                        <div class="posts-thumb">
                                        <a href="{{ route('news.read', ['id' => $recentPost->id]) }}">
                                            <img loading="lazy" alt="img" src="{{ asset('storage/'.$recentPost->news_image) }}">
                                        </a>
                                        </div>
                                        <div class="post-info">
                                        <h4 class="entry-title">
                                            <a href="{{ route('news.read', ['id' => $recentPost->id]) }}">
                                                {!! $recentPost->news_title !!}
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
                                    <a href="#"><img loading="lazy" alt="img" src="{{ asset('user/assets/theme/images/news/news2.jpg') }}"></a>
                                    </div>
                                    <div class="post-info">
                                    <h4 class="entry-title">
                                        <a href="#">Thandler Airport Water Reclamation Facility Expansion Project Named</a>
                                    </h4>
                                    </div>
                                </li>

                                <li class="d-flex align-items-center">
                                    <div class="posts-thumb">
                                    <a href="#"><img loading="lazy" alt="img" src="{{ asset('user/assets/theme/images/news/news3.jpg') }}"></a>
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
                    <!-- Recent post end -->

                    <div class="widget">
                        <h3 class="widget-title">Categories</h3>
                        <ul class="arrow nav nav-tabs">
                        <li><a href="#">IPO</a></li>
                        <li><a href="#">BUSINESS</a></li>
                        <li><a href="#">INVESTEMNT</a></li>
                        <li><a href="#">PROTFOLIO</a></li>
                        </ul>
                    </div>
                    <!-- Categories end -->

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
                    <!-- Archives end -->

                    <div class="widget widget-tags">
                        <h3 class="widget-title">Tags </h3>

                        <ul class="list-unstyled">
                            @if (count($allPosts) > 0)
                                @foreach ($uniqueTags as $tag)
                                    <li style="text-transform: uppercase;">
                                        <a href="#">{{ $tag }}</a>
                                    </li>
                                @endforeach
                            @else
                                <li><a href="#">News</a></li>
                                <li><a href="#">Share</a></li>
                                <li><a href="#">IPO</a></li>
                                <li><a href="#">Market</a></li>
                                <li><a href="#">Exchange</a></li>
                                <li><a href="#">Safety</a></li>
                                <li><a href="#">Portfolio</a></li>
                                <li><a href="#">Planning</a></li>
                            @endif

                        </ul>
                    </div>
                    <!-- Tags end -->
                </div>
            </div>

            <div class="col-lg-8 mb-5 mb-lg-0 order-0 order-lg-1">
                @if (count($allPosts) > 0)
                    @foreach ($allPosts as $post)
                        <div class="post">
                            <div class="post-media post-image">
                                <img loading="lazy" src="{{ asset('storage/'.$post->news_image) }}" class="img-fluid" alt="post-image">
                            </div>

                            <div class="post-body">
                                <div class="entry-header">
                                    <div class="post-meta">
                                        <span class="post-author">
                                            <i class="far fa-user"></i>
                                            <a href="{{ url('/') }}">
                                                Admin
                                            </a>
                                        </span>
                                        <span class="post-cat">
                                            <i class="far fa-folder-open"></i>
                                            <a href="#">
                                                News
                                            </a>
                                        </span>
                                        <span class="post-meta-date">
                                            <i class="far fa-calendar"></i>
                                            {{ $post->created_at->format('F j, Y') }}
                                        </span>
                                        <span class="post-comment">
                                            <i class="far fa-comment"></i>
                                            03
                                            <a href="#" class="comments-link">
                                                Comments
                                            </a>
                                        </span>
                                    </div>
                                    <h2 class="entry-title">
                                        <a href="{{ route('news.read', ['id' => $post->id]) }}">
                                            {!! $post->news_title !!}
                                        </a>
                                    </h2>
                                </div>

                                <div class="entry-content">
                                    <p>
                                        {{ implode(' ', array_slice(str_word_count($post->description, 1), 0, 100)) }} ...
                                    </p>
                                </div>

                                <div class="post-footer">
                                    <a href="{{ route('news.read', ['id' => $post->id]) }}" class="btn btn-primary">Continue Reading</a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="post">
                        <div class="post-media post-image">
                            <img loading="lazy" src="{{ asset('user/assets/theme/images/news/news1.jpg') }}" class="img-fluid" alt="post-image">
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
                                <span class="post-meta-date"><i class="far fa-calendar"></i> June 14, 2016</span>
                                <span class="post-comment"><i class="far fa-comment"></i> 03<a href="#"
                                    class="comments-link">Comments</a></span>
                            </div>
                            <h2 class="entry-title">
                                <a href="news-single.html">We Just Completes $17.6 million Medical Clinic in Mid-Missouri</a>
                            </h2>
                            </div><!-- header end -->

                            <div class="entry-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                fugiat nulla pariatur. Excepteur ...</p>
                            </div>

                            <div class="post-footer">
                            <a href="news-single.html" class="btn btn-primary">Continue Reading</a>
                            </div>

                        </div>
                    </div>

                    <div class="post">
                        <div class="post-media post-video">
                            <div class="embed-responsive embed-responsive-16by9">
                            <!-- Change the url -->
                            <iframe class="embed-responsive-item" src="//player.vimeo.com/video/153089270?title=0&amp;byline=0&amp;portrait=0&amp;color=8aba56" allowfullscreen></iframe>
                            </div>
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
                                <span class="post-meta-date"><i class="far fa-calendar"></i> June 14, 2016</span>
                                <span class="post-comment"><i class="far fa-comment"></i> 03<a href="#"
                                    class="comments-link">Comments</a></span>
                            </div>
                            <h2 class="entry-title">
                                <a href="news-single.html">Thandler Airport Water Reclamation Facility Expansion Project Named</a>
                            </h2>
                            </div><!-- header end -->

                            <div class="entry-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                fugiat nulla pariatur. Excepteur ...</p>
                            </div>

                            <div class="post-footer">
                            <a href="news-single.html" class="btn btn-primary">Continue Reading</a>
                            </div>

                        </div>
                    </div>
                    <div class="post">
                        <div class="post-media post-image">
                            <img loading="lazy" src="images/news/news3.jpg" class="img-fluid" alt="post-image">
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
                                <span class="post-meta-date"><i class="far fa-calendar"></i> June 14, 2016</span>
                                <span class="post-comment"><i class="far fa-comment"></i> 03<a href="#"
                                    class="comments-link">Comments</a></span>
                            </div>
                            <h2 class="entry-title">
                                <a href="news-single.html">Silicon Bench and Cornike Begin Construction of Large-Scale Solar Facilities
                                for Trade</a>
                            </h2>
                            </div><!-- header end -->

                            <div class="entry-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                fugiat nulla pariatur. Excepteur ...</p>
                            </div>

                            <div class="post-footer">
                            <a href="news-single.html" class="btn btn-primary">Continue Reading</a>
                            </div>

                        </div>
                    </div>
                @endif
                <nav class="paging" aria-label="Page navigation example">
                    {{ $allPosts->links('pagination::bootstrap-4') }}
                </nav>

            </div>

            </div>

        </div>
    </section>
@endsection
