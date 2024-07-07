@extends('user.layout.app')
<style>
    .container1 {
        max-width: 1110px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        padding: 20px;
        border: 1px solid #ddd;
    }

    .container1 h1 {
        text-align: center;
    }
    .section1 {
        margin-bottom: 20px;
    }
    .section1 h2 {
        font-size: 18px;
    }
    .section1 p {
        margin-bottom: 5px;
    }
    .list1 {
        list-style: none;
        padding: 0;
    }
    .list-item {
        margin-bottom: 5px;
    }
    .list-item::before {
        content: "►";
        margin-right: 10px; /* Adjust margin for spacing */
    }
</style>
@section('content')
    <section id="main-container" class="main-container">
        <div class="container1">
            <div class="row">
                <div class="col-md-12">
                    <h1>OPENING ACCOUNT WITH ANC SECURITIES LIMITED</h1>
                    <div class="section1">
                        <h2>BO Account Opening Requirements</h2>
                    </div>
                    <div class="section">
                        <h2>Bangladeshi National (Single Account)</h2>
                        <p>Proprietorship Account</p>
                        <ul class="list1">
                            <li class="list-item">A complete set of account opening form</li>
                            <li class="list-item">Two copy of passport size photograph of the account holder</li>
                            <li class="list-item">National ID card/Passport of account holder and nominee</li>
                            <li class="list-item">Copy of valid Trade License</li>
                            <li class="list-item">Two copy of photograph of nominee/authorized/PDA (If needed)</li>
                            <li class="list-item">Bank Statement/Photocopy of Cheque Leaf</li>
                        </ul>
                    </div>
                    <div class="section1">
                        <h2>Bangladeshi National(Joint Account)</h2>
                        <p>List Of Required Document For Association/Trust/Society/Provident Fund</p>
                        <ul class="list1">
                            <li class="list-item">A complete set of account opening form</li>
                            <li class="list-item">Copy of constitution/By law/Rules</li>
                            <li class="list-item">Two copy of passport size photograph of the first account holder (Trust Deed Applicable for Trust account only)</li>
                            <li class="list-item">Two copy of passport size photograph of the second account holder</li>
                            <li class="list-item">National ID card/Passport of first & second account holder and nominee</li>
                            <li class="list-item">List of member of the governing body to open the account and authorization for operation</li>
                            <li class="list-item">Two copy of photograph of nominee/authorized/PDA (if needed)</li>
                            <li class="list-item">List of Authorized signatories along with address</li>
                            <li class="list-item">Bank Statement/Photocopy of Cheque Leaf (letter from NBR (Applicable for Provident Fund only))</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                <img style="width: 100px;margin-left: auto;margin-right: auto;display: block;height: 100px;" src="{{ asset('auth/ANCSECURITIES.png') }}" alt="">
                            </div>
                            <div class="mt-3 mb-3">
                                <h2 class="text-danger text-center">পুজিবাজার ঝুকিপূর্ণ । জেনে ও বুঝে বিনিয়োগ করবেন।</h2>
                                <br>
                                <h4 class="text-center" style="color: #000; font-weight:600;">Click here to open below</h4>
                            </div>
                            <div class="bo_menu">
                                <div class="row">
                                    <div class="col-6 col-md-3 my-2">
                                        <a href="{{ route('new.bo') }}">
                                            <div class="bocard">
                                                <i class="fas fa-plus-circle fa-3x"></i>
                                                <p class="text-center mt-3">
                                                    New BO Application
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-3 my-2">
                                        <a href="">
                                            <div class="bocard">
                                                <i class="fas fa-play-circle fa-3x"></i>
                                                <p class="text-center mt-3">
                                                    Continue Incomplete BO Application
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-3 my-2">
                                        <a href="">
                                            <div class="bocard">
                                                <i class="fas fa-dollar-sign fa-3x"></i>
                                                <p class="text-center mt-3">
                                                    Check status and payment
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-3 my-2">
                                        <a href="">
                                            <div class="bocard">
                                                <i class="fas fa-pen fa-3x"></i>
                                                <p class="text-center mt-3">
                                                    Application for BO update
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-3 my-2">
                                        <a href="">
                                            <div class="bocard">
                                                <i class="fas fa-times-circle fa-3x"></i>
                                                <p class="text-center mt-3">
                                                    Application for BO closure
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-3 my-2">
                                        <a href="">
                                            <div class="bocard">
                                                <i class="fas fa-comment-dots fa-3x"></i>
                                                <p class="text-center mt-3">
                                                    Submit Query
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-6 col-md-3 my-2">
                                        <a href="{{ route('faq.us') }}">
                                            <div class="bocard">
                                                <i class="fas fa-question fa-3x"></i>
                                                <p class="text-center mt-3">
                                                    Help/FAQ
                                                </p>
                                            </div>
                                        </a>
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
