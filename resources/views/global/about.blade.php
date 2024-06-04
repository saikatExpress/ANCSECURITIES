@extends('user.layout.app')

@section('content')
    <section id="main-container" class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                <h3 class="column-title">Who We Are</h3>
                <p>
                    {{ $about->title }}
                </p>
                <blockquote>
                    <p>
                        {{ $about->block_quote }}
                    </p>
                </blockquote>
                <p>
                    {{ $about->description }}
                </p>

                </div>

                <div class="col-lg-6 mt-5 mt-lg-0">

                <div id="page-slider" class="page-slider small-bg">
                    @php
                        $filenames = explode(',', $about->about_images);
                    @endphp
                    @if ($about)
                        @if (count($filenames) > 0)
                            @foreach ( $filenames as $filename )
                                <div class="item" style="background-image:url({{ asset('storage/about_images/' . $filename) }})">
                                    <div class="container">
                                        <div class="box-slider-content">
                                            <div class="box-slider-text">
                                                <h2 class="box-slide-title">ANC Securities Ltd</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
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
                        @endif
                    @endif
                </div>


                </div>
            </div>

        </div>
    </section>
@endsection
