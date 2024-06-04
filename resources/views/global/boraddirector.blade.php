@extends('user.layout.app')

@section('content')

    <section id="main-container" class="main-container pb-4">
        <div class="container">
            <div class="row text-center">
            <div class="col-lg-12">
                <h3 class="section-sub-title">Our Leaderships</h3>
            </div>
            </div>
            <!--/ Title row end -->

            <div class="row justify-content-center">
                <div class="col-lg-3 col-sm-6 mb-5">
                    <div class="ts-team-wrapper">
                    <div class="team-img-wrapper">
                        <img loading="lazy" src="{{ asset('user/assets/logos/images.jpg') }}" class="img-fluid" alt="team-img">
                    </div>
                    <div class="ts-team-content-classic">
                        <h3 class="ts-name">DR. Farhana Monem</h3>
                        <p class="ts-designation">Chairman</p>
                        <p class="ts-description">
                            GME Group is chaired by
                            Dr. Farhana Monem, who is the
                            daughter of the legendary
                            business icon of Bangladesh,
                            Mr. Abdul Monem.
                        </p>
                        <div class="team-social-icons">
                        <a target="_blank" href="#"><i class="fab fa-facebook-f"></i></a>
                        <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                        <a target="_blank" href="#"><i class="fab fa-linkedin"></i></a>
                        </div>
                        <!--/ social-icons-->
                    </div>
                    </div>
                    <!--/ Team wrapper 1 end -->

                </div>

                <div class="col-lg-3 col-sm-6 mb-5">
                    <div class="ts-team-wrapper">
                        <div class="team-img-wrapper">
                            <img loading="lazy" style="height: 170px;" src="{{ asset('user/assets/logos/dr-chowdhury-hasan-mahmud.webp') }}" class="img-fluid" alt="Hasan Mahmud">
                        </div>
                        <div class="ts-team-content-classic">
                            <h3 class="ts-name">DR. CHOWDHURY HASAN MAHMUD</h3>
                            <p class="ts-designation">Managing Director</p>
                            <p class="ts-description">
                                Dr. Chowdhury Hasan Mahmud
                                is the Managing Director of
                                GME Group,
                                who diversified the business
                                established by his father,
                                Mr. M.R. Chowdhury in 1966.
                            </p>
                            <div class="team-social-icons">
                            <a target="_blank" href="#"><i class="fab fa-twitter"></i></a>
                            <a target="_blank" href="#"><i class="fab fa-google-plus"></i></a>
                            <a target="_blank" href="#"><i class="fab fa-linkedin"></i></a>
                            </div>
                            <!--/ social-icons-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
