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
                            <li class="breadcrumb-item"><a href="#">News</a></li>
                            <li class="breadcrumb-item active" aria-current="page">News Right sidebar</li>
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
                        </div><!-- header end -->

                        <div class="entry-content">
                            <p>
                                {{ implode(' ', array_slice(str_word_count($news->description, 1), 0, 200)) }}
                            </p>

                            <blockquote>
                                <p>
                                    {{ $news->quotes }}
                                <cite>
                                    - Admin
                                </cite>
                                </p>

                            </blockquote>

                            <p>
                                {{ implode(' ', array_slice(str_word_count($news->description, 1), 200, 400)) }}
                            </p>

                            <p>
                                {{ implode(' ', array_slice(str_word_count($news->description, 1), 400, 600)) }}
                            </p>
                        </div>

                        <div class="tags-area d-flex align-items-center justify-content-between">
                        <div class="post-tags">
                            <a href="#">Construction</a>
                            <a href="#">Safety</a>
                            <a href="#">Planning</a>
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
                        <img loading="lazy" src="images/news/avator1.png" alt="author">
                    </div>
                    <div class="author-info">
                        <h3>Elton Themen<span>Site Engineer</span></h3>
                        <p class="mb-2">Lisicing elit, sed do eiusmod tempor ut labore et dolore magna aliqua. Ut enim ad vene minim
                        veniam, quis nostrud exercitation nisi ex ea commodo.</p>
                        <p class="author-url mb-0">Website: <span><a href="#">http://www.example.com</a></span></p>

                    </div>
                    </div> <!-- Author box end -->

                    <!-- Post comment start -->
                    <div id="comments" class="comments-area">
                    <h3 class="comments-heading">07 Comments</h3>

                    <ul class="comments-list">
                        <li>
                        <div class="comment d-flex">
                            <img loading="lazy" class="comment-avatar" alt="author" src="images/news/avator1.png">
                            <div class="comment-body">
                            <div class="meta-data">
                                <span class="comment-author mr-3">Michelle Aimber</span>
                                <span class="comment-date float-right">January 17, 2016 at 1:38 pm</span>
                            </div>
                            <div class="comment-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehen.</p>
                            </div>
                            <div class="text-left">
                                <a class="comment-reply font-weight-bold" href="#">Reply</a>
                            </div>
                            </div>
                        </div><!-- Comments end -->

                        <ul class="comments-reply">
                            <li>
                            <div class="comment d-flex">
                                <img loading="lazy" class="comment-avatar" alt="author" src="images/news/avator2.png">
                                <div class="comment-body">
                                <div class="meta-data">
                                    <span class="comment-author mr-3">Tom Harnandez</span>
                                    <span class="comment-date float-right">January 17, 2016 at 1:38 pm</span>
                                </div>
                                <div class="comment-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                    labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehen.</p>
                                </div>
                                <div class="text-left">
                                    <a class="comment-reply font-weight-bold" href="#">Reply</a>
                                </div>
                                </div>
                            </div><!-- Comments end -->
                            </li>
                        </ul><!-- comments-reply end -->
                        <div class="comment d-flex last">
                            <img loading="lazy" class="comment-avatar" alt="author" src="images/news/avator3.png">
                            <div class="comment-body">
                            <div class="meta-data">
                                <span class="comment-author mr-3">Genelia Dusteen</span>
                                <span class="comment-date float-right">January 17, 2016 at 1:38 pm</span>
                            </div>
                            <div class="comment-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehen.</p>
                            </div>
                            <div class="text-left">
                                <a class="comment-reply font-weight-bold" href="#">Reply</a>
                            </div>
                            </div>
                        </div><!-- Comments end -->
                        </li><!-- Comments-list li end -->
                    </ul><!-- Comments-list ul end -->
                    </div><!-- Post comment end -->

                    <div class="comments-form border-box">
                    <h3 class="title-normal">Add a comment</h3>

                    <form role="form">
                        <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <label for="message"><textarea class="form-control required-field" id="message" placeholder="Your Comment" rows="10" required></textarea></label>
                            </div>
                        </div><!-- Col 12 end -->

                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="name"><input class="form-control" name="name" id="name" placeholder="Your Name" type="text" required></label>
                            </div>
                        </div><!-- Col 4 end -->

                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="email"><input class="form-control" name="email" id="email" placeholder="Your Email" type="email" required></label>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="website"><input class="form-control" id="website" placeholder="Your Website" type="text" required></label>
                            </div>
                        </div>

                        </div><!-- Form row end -->
                        <div class="clearfix">
                        <button class="btn btn-primary" type="submit" aria-label="post-comment">Post Comment</button>
                        </div>
                    </form><!-- Form end -->
                    </div><!-- Comments form end -->
                </div>

            <div class="col-lg-4">

                <div class="sidebar sidebar-right">
                    <div class="widget recent-posts">
                        <h3 class="widget-title">Recent Posts</h3>
                        <ul class="list-unstyled">
                        <li class="d-flex align-items-center">
                            <div class="posts-thumb">
                            <a href="#"><img loading="lazy" alt="img" src="images/news/news1.jpg"></a>
                            </div>
                            <div class="post-info">
                            <h4 class="entry-title">
                                <a href="#">We Just Completes $17.6 Million Medical Clinic In Mid-missouri</a>
                            </h4>
                            </div>
                        </li><!-- 1st post end-->

                        <li class="d-flex align-items-center">
                            <div class="posts-thumb">
                            <a href="#"><img loading="lazy" alt="img" src="images/news/news2.jpg"></a>
                            </div>
                            <div class="post-info">
                            <h4 class="entry-title">
                                <a href="#">Thandler Airport Water Reclamation Facility Expansion Project Named</a>
                            </h4>
                            </div>
                        </li><!-- 2nd post end-->

                        <li class="d-flex align-items-center">
                            <div class="posts-thumb">
                            <a href="#"><img loading="lazy" alt="img" src="images/news/news3.jpg"></a>
                            </div>
                            <div class="post-info">
                            <h4 class="entry-title">
                                <a href="#">Silicon Bench And Cornike Begin Construction Solar Facilities</a>
                            </h4>
                            </div>
                        </li><!-- 3rd post end-->

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
            </div><!-- Sidebar Col end -->

            </div><!-- Main row end -->

        </div>
    </section>
@endsection
