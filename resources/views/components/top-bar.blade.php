<div class="bg-white">
    <div class="container">
    <div class="logo-area">
        <div class="row align-items-center">
            <div class="logo col-lg-3 text-center text-lg-left mb-3 mb-md-5 mb-lg-0">
                <a class="d-block" href="{{ url('/') }}">
                <img loading="lazy" src="{{ asset('storage/' . $setting->project_logo) }}" alt="Constra">
                </a>
            </div>

            <div class="col-lg-9 header-right">
                <ul class="top-info-box">
                    <li>
                        <div class="info-box">
                        <div class="info-box-content">
                            <p class="info-box-title">Call Us</p>
                            <p class="info-box-subtitle">(+88) {{ $setting->project_phone }}</p>
                        </div>
                        </div>
                    </li>
                    <li>
                        <div class="info-box">
                        <div class="info-box-content">
                            <p class="info-box-title">Email Us</p>
                            <p class="info-box-subtitle">{{ $setting->project_email }}</p>
                        </div>
                        </div>
                    </li>
                    <li class="last">
                        <div class="info-box last">
                        <div class="info-box-content">
                            <p class="info-box-title">GOVT Certificate</p>
                            <p class="info-box-subtitle">TIN 554802850784</p>
                        </div>
                        </div>
                    </li>
                    <li class="header-get-a-quote">
                        <a class="btn btn-primary" href="{{ route('limit.request') }}">Limit Request</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div>
</div>
