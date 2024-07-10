@extends('authuser.layout.app')
@section('content')

    <div class="mdl-grid mdl-grid--no-spacing dashboard">

        <div class="mdl-grid mdl-cell mdl-cell--9-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">

            <!-- Pie chart-->
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                <div class="mdl-card mdl-shadow--2dp pie-chart">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">My Day</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <div class="pie-chart__container">

                        </div>
                    </div>
                </div>
            </div>
            <!-- Weather widget-->
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                <div class="mdl-card mdl-shadow--2dp weather">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Now</h2>

                        <div class="mdl-layout-spacer"></div>
                        <div class="mdl-card__subtitle-text">
                            <i class="material-icons">room</i>
                            Minsk, Belarus
                        </div>
                    </div>
                    <div class="mdl-card__supporting-text mdl-card--expand">
                        <p class="weather-temperature">-11<sup>&deg;</sup></p>

                        <p class="weather-description">
                            Cloudy and snow
                        </p>
                    </div>
                </div>
            </div>
            <!-- Trending widget-->
            <div class="mdl-cell mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--2-col-phone">
                <div class="mdl-card mdl-shadow--2dp trending">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Trending</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <ul class="mdl-list">
                            <li class="mdl-list__item">
                                <span class="mdl-list__item-primary-content list__item-text">UX</span>
                                <span class="mdl-list__item-secondary-content">
                                    <i class="material-icons trending__arrow-up" role="presentation">&#xE5C7</i>
                                </span>
                                <span class="mdl-list__item-secondary-content trending__percent">1 %</span>
                            </li>
                            <li class="mdl-list__item list__item--border-top">
                                <span class="mdl-list__item-primary-content list__item-text">PHP</span>
                                <span class="mdl-list__item-secondary-content">
                                    <i class="material-icons trending__arrow-down" role="presentation">&#xE5C5</i>
                                </span>
                                <span class="mdl-list__item-secondary-content trending__percent">2 %</span>
                            </li>
                            <li class="mdl-list__item list__item--border-top">
                                <span class="mdl-list__item-primary-content list__item-text ">Big Data</span>
                                <span class="mdl-list__item-secondary-content">
                                    <i class="material-icons trending__arrow-up" role="presentation">&#xE5C7</i>
                                </span>
                                <span class="mdl-list__item-secondary-content trending__percent">5 %</span>
                            </li>
                            <li class="mdl-list__item list__item--border-top">
                                <span class="mdl-list__item-primary-content list__item-text">Material Design</span>
                                <span class="mdl-list__item-secondary-content">
                                    <i class="material-icons trending__arrow-up" role="presentation">&#xE5C7</i>
                                </span>
                                <span class="mdl-list__item-secondary-content trending__percent">18 %</span>
                            </li>
                            <li class="mdl-list__item list__item--border-top">
                                <span class="mdl-list__item-primary-content">JavaScript</span>
                                <span class="mdl-list__item-secondary-content">
                                    <i class="material-icons trending__arrow-up" role="presentation">&#xE5C7</i>
                                </span>
                                <span class="mdl-list__item-secondary-content trending__percent">17 %</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Cotoneaster card-->
            <div class="mdl-cell mdl-cell--5-col-desktop mdl-cell--5-col-tablet mdl-cell--2-col-phone">
                <div class="mdl-card mdl-shadow--2dp cotoneaster">
                    <div class="mdl-card__title mdl-card--expand">
                        <h2 class="mdl-card__title-text">Cotoneaster</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <div>
                            Cotoneaster is a genus of flowering plants in the rose family, Roseaceae, netive to the
                            Palaearctic region, with a strong concentration of diversity in the genus in the
                            mountains
                            of southwestern China and the Himalayas.
                        </div>
                        <a href="https://en.wikipedia.org/wiki/Cotoneaster" target="_blank">Wikipedia</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

