@extends('user.layout.app')

@section('content')
    <section id="main-container" class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                <h3 class="column-title">Who We Are</h3>
                <p>when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.</p>
                <blockquote><p>Semporibus autem quibusdam et aut officiis debitis aut rerum est aut optio cumque nihil necessitatibus autemn ec tincidunt nunc posuere ut</p></blockquote>
                <p>He lay on his armour-like  back, and if he lifted. ultrices ultrices sapien, nec tincidunt nunc posuere ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn’t anything embarrassing.</p>

                </div>

                <div class="col-lg-6 mt-5 mt-lg-0">

                <div id="page-slider" class="page-slider small-bg">

                    <div class="item" style="background-image:url({{ asset('user/assets/theme/images/slider-pages/slide-page1.jpg') }})">
                        <div class="container">
                            <div class="box-slider-content">
                            <div class="box-slider-text">
                                <h2 class="box-slide-title">Leadership</h2>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="item" style="background-image:url({{ asset('user/assets/theme/images/slider-pages/slide-page2.jpg') }})">
                        <div class="container">
                            <div class="box-slider-content">
                            <div class="box-slider-text">
                                <h2 class="box-slide-title">Relationships</h2>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="item" style="background-image:url({{ asset('user/assets/theme/images/slider-pages/slide-page3.jpg') }})">
                        <div class="container">
                            <div class="box-slider-content">
                            <div class="box-slider-text">
                                <h2 class="box-slide-title">Performance</h2>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>


                </div>
            </div>

        </div>
    </section>
@endsection
