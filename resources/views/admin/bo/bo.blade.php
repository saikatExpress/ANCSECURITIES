<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BO Account Form | ANC Securities Ltd</title>
    <link rel="shortcut icon" href="{{ asset('user/assets/logos/8022322.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bo.css') }}">
    <style>
        .error-message {
            color: red;
            margin-bottom: 10px;
            font-size: 10px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">

        <header class="header">
            <div class="navbar">
                <div class="logo">
                    <img src="{{ asset('auth/logo.png') }}" alt="Logo">
                </div>
                <ul class="menu">
                    <li class="menu-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                    <li class="menu-item"><a href="{{ route('bo.list') }}"><i class="fas fa-info-circle"></i> BO Form</a></li>
                    <li class="menu-item"><a href="{{ url('manual/request') }}"><i class="fas fa-concierge-bell"></i> Request</a></li>
                    <li class="menu-item"><a href="#" data-bs-toggle="modal" data-bs-target="#contactModal"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
                <div class="search-bar">
                    <input type="text" placeholder="Search...">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </header>

        <div class="row justify-content-center mt-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Account Holder</div>
                    <div class="card-body">
                        <!-- Step wizard -->
                        <div id="step-wizard">
                            <!-- Step 1 Content -->
                            <div id="step-1" class="step-content active">
                                <form id="step-1-form" action="{{ route('boaccount.store') }}" method="POST">
                                    @csrf
                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <label for="field1">BO Type: <span class="text-danger">*</span></label> <br>
                                            <input type="radio" id="new_bo" class="required" name="bo_type" value="newBo" checked> New BO
                                            <input type="radio" id="link_bo" name="bo_type" value="link"> Link BO
                                        </div>
                                        <div class="form-group" style="display: none;" id="form_bo_id">
                                            <label for="">BOID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="link_bo_id">
                                        </div>
                                    </div>
                                    <div class="card mt-4">
                                        <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header rounded-0">
                                            <h4 class="card-title mb-0">First A/C Holder</h4>
                                        </div>
                                        <div class="row p-3">
                                            <div class="col-md-3 mb-2">
                                                <p>
                                                    <b>Type of Client <span class="text-danger">*</span></b>
                                                </p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input required" name="type_of_client" value="individual" type="radio" id="type_of_client_individual" checked="checked">
                                                    <label for="type_of_client_individual" class="form-check-label">Individual</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" name="type_of_client" id="type_of_client_joint" value="joint" type="radio">
                                                    <label for="type_of_client_joint" class="form-check-label">Joint</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="first_acc_courtesy_title" class="form-label">
                                                    Courtesy Title <span class="text-danger">*</span>
                                                </label>
                                                <select name="courtesy_title" id="courtesy_title" class="form-control required">
                                                    <option selected="selected" value="">Select</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Dr">Dr</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="100" placeholder="Enter First Name" name="firstname" type="text" id="firstname">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="30" placeholder="Enter Last Name" name="lastname" type="text" id="lastname">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="occupation" class="form-label">Occupation <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="30" placeholder="Enter Occupation" name="occupation" type="text" id="occupation">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                                <div class="flatpickr">
                                                    <input class="form-control required" id="date_of_birth" name="date_of_birth" type="date">
                                                    <span class="error-message" style="color: red; display: none;"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="father_name" class="form-label">Father&#039;s Name <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="30" placeholder="Enter Father Name" name="father_name" type="text" id="father_name">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="mother_name" class="form-label">Mother&#039;s Name <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="30" placeholder="Enter Mother Name" name="mother_name" type="text" id="mother_name">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-12 mb-2">
                                                <label for="address_line_1" class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="50" placeholder="Enter Address Line 1" name="address_line_1" type="text" id="address_line_1">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="address_line_2" class="form-label">Address Line 2</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 2" name="address_line_2" type="text" id="address_line_2">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label for="address_line_3" class="form-label">Address Line 3</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 3" name="address_line_3" type="text" id="address_line_3">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="25" placeholder="Enter City" name="city" type="text" id="city">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="post_code" class="form-label">Post Code <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="10" placeholder="Enter Post Code" name="post_code" type="text" id="post_code">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="division" class="form-label">District <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="25" placeholder="Enter District" name="division" type="text" id="division">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="fisrt_acc_country" class="form-label">Country <span class="text-danger">*</span></label>
                                                <select class="form-control required select2" id="fisrt_acc_country" maxlength="25" name="country">
                                                    <option selected="selected" value="">Select Country</option>
                                                    <option value="ban">Bangladesh</option>
                                                </select>
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="20" placeholder="Enter Mobile" name="mobile" type="text" id="mobile">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="80" placeholder="Enter Email Address" name="email" type="email" id="email">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="telephone" class="form-label">Telephone</label>
                                                <input class="form-control" maxlength="20" placeholder="Enter Telephone Number" name="telephone" type="text" id="telephone">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="fax" class="form-label">Fax</label>
                                                <input class="form-control" maxlength="20" placeholder="Enter FAX Number" name="fax" type="text" id="fax">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="nationality" class="form-label">Nationality <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="50" placeholder="Enter Nationality" name="nationality" type="text" value="Bangladeshi" id="nationality">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="nid" class="form-label">National ID <span class="text-danger">*</span></label>
                                                <input class="form-control required" minlength="10" maxlength="20" placeholder="Enter National Identity Card Number" name="nid" type="text" id="nid">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="tin" class="form-label">Tax Identification Number (TIN)</label>
                                                <input class="form-control" placeholder="Enter Tax Identification Number (TIN)" name="tin" type="text" id="tin">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="branch" class="form-label">Broker Branch <span class="text-danger">*</span></label>
                                                <select class="form-control required select2" id="branch" name="branch">
                                                    <option value=""> Select </option>
                                                    <option value="Head Office" selected="selected">Head Office</option>
                                                    <option value="MJL">Motijheel</option>
                                                </select>
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="col-md-4 my-3">
                                                <p><b>Residential Status <span class="text-danger">*</span></b></p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input required" id="residency_Resident" checked="checked" name="residency" type="radio" value="Resident">
                                                    <label for="residency_Resident" class="form-check-label">Resident</label>
                                                    <span class="error-message" style="color: red; display: none;"></span>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="residency_Non_Resident" name="residency" type="radio" value="Non Resident">
                                                    <label for="residency_Non_Resident" class="form-check-label">Non Resident</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="residency_Foreigner" name="residency" type="radio" value="Foreigner">
                                                    <label for="residency_Foreigner" class="form-check-label">Foreigner</label>
                                                </div>
                                            </div>

                                            <div class="col-md-4 my-3">
                                                <p><b>Gender <span class="text-danger">*</span></b></p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input required" id="gender_Male" checked="checked" name="gender" type="radio" value="Male">
                                                    <label for="gender_Male" class="form-check-label">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="gender_Female" name="gender" type="radio" value="Female">
                                                    <label for="gender_Female" class="form-check-label">Female</label>
                                                </div>
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <div class="view-profile-card-header p-3 rounded-2" role="alert">
                                                        Whether the applicant is an officer or Director or Authorized
                                                        Representative of any Stock Exchange/Listed Company/Brokerage
                                                        <label class="switch">
                                                            <input name="is_director" type="checkbox" id="is_director">
                                                            <div class="slider round"></div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2 director_company" style="display:none">
                                                    <label for="director_company" class="form-label">If yes, Name of The Stock Exchange/Listed Company/Brokerage Firm:</label>
                                                    <input class="form-control" maxlength="255" placeholder="Write here" name="director_company" type="text" id="director_company">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Joint Applicant Form --}}
                                    <div class="card mt-4 joint_applicant" style="display:none">
                                        <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                            <h4 class="card-title mb-0">Joint Applicant(2nd Account Holder)</h4>
                                        </div>

                                        <div class="row p-3">
                                            <div class="col-md-3 mb-2">
                                                <label for="joint_courtesy_title" class="form-label">Courtesy Title <span class="text-danger">*</span></label>
                                                <select class="form-control required select2" maxlength="10" id="joint_courtesy_title" name="joint_courtesy_title">
                                                    <option selected="selected" value="">Select</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Dr">Dr</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="joint_firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="100" placeholder="Enter First Name" name="joint_firstname" type="text" id="joint_firstname">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="30" placeholder="Enter Last Name" name="joint_lastname" type="text" id="joint_lastname">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_occupation" class="form-label">Occupation <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="30" placeholder="Enter Occupation" name="joint_occupation" type="text" id="joint_occupation">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_date_of_birth" class="form-label">Date of Birth (YYYY-MM-DD) <span class="text-danger">*</span></label>
                                                <div class="flatpicker">
                                                    <input class="form-control required birthdate" placeholder="Enter Date of Birth" id="joint_date_of_birth" name="joint_date_of_birth" type="date">
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_father_name" class="form-label">Father&#039;s Name <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="30" placeholder="Enter Father Name" name="joint_father_name" type="text" id="joint_father_name">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_mother_name" class="form-label">Mother&#039;s Name <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="30" placeholder="Enter Mother Name" name="joint_mother_name" type="text" id="joint_mother_name">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="joint_nid" class="form-label">National ID <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="20" placeholder="Enter National Identity Card Number" name="joint_nid" type="text" id="joint_nid">
                                            </div>

                                            <div class="col-md-12 mb-2">
                                                <label for="joint_address_line_1" class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="30" placeholder="Enter Address Line 1" name="joint_address_line_1" type="text" id="joint_address_line_1">
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label for="joint_address_line_2" class="form-label ">Address Line 2</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 2" name="joint_address_line_2" type="text" id="joint_address_line_2">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label for="joint_address_line_3" class="form-label ">Address Line 3</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 3" name="joint_address_line_3" type="text" id="joint_address_line_3">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_city" class="form-label">City <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="25" placeholder="Enter City" name="joint_city" type="text" id="joint_city">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="joint_post_code" class="form-label">Post Code <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="10" placeholder="Enter Post Code" name="joint_post_code" type="text" id="joint_post_code">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_division" class="form-label">District <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="25" placeholder="Enter District" name="joint_division" type="text" id="joint_division">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_country" class="form-label">Country <span class="text-danger">*</span></label>
                                                <select class="form-control required select2" id="joint_country" name="joint_country">
                                                    <option selected="selected" value="">Select Country</option>
                                                    <option value="ban">Bangladesh</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="80" placeholder="Enter Email Address" name="joint_email" type="email" id="joint_email">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                                <input class="form-control required" maxlength="20" placeholder="Enter Mobile Number" name="joint_mobile" type="text" id="joint_mobile">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_telephone" class="form-label">Telephone</label>
                                                <input class="form-control" maxlength="20" placeholder="Enter Telephone" name="joint_telephone" type="text" id="joint_telephone">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_fax" class="form-label">Fax</label>
                                                <input class="form-control" maxlength="20" placeholder="Enter Fax" name="joint_fax" type="text" id="joint_fax">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary next-step mt-4">Save & Continue</button>
                                </form>
                            </div>

                            <!-- Step 2 Content -->
                            <div id="step-2" class="step-content">

                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between view-profile-card-header">
                                        <h4 class="card-title mb-0">Bank Information</h4>
                                    </div>
                                </div>

                                <form id="step-2-form" action="{{ route('bank.store') }}" method="POST">
                                    @csrf
                                    <div class="row p-2 pt-3">

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <input type="hidden" name="bo_last_id" id="bo_last_id">
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="bank_id" class="form-label">Bank Name <span class="text-danger">*</span></label>
                                                <select class="form-control required select2" id="bank_id" name="bank_id">
                                                    <option selected="selected" value="">Select Bank Name</option>
                                                    <option value="1">AB Bank Limited</option>
                                                    <option value="2">Agrani Bank Limited</option>
                                                    <option value="3">Al - Arafah Islami Bank Limited</option>
                                                    <option value="4">Bangladesh Commerce Bank Limited</option>
                                                    <option value="5">Bangladesh Development Bank Limited</option>
                                                    <option value="6">Bangladesh Krishi Bank</option>
                                                    <option value="7">BASIC Bank Limited</option>
                                                    <option value="8">Bank Alfalah Limited</option>
                                                    <option value="9">Bank Asia Limited</option>
                                                    <option value="10">BRAC Bank Limited</option>
                                                    <option value="11">Citibank N . A</option>
                                                    <option value="12">Commercial Bank of Ceylon Limited</option>
                                                    <option value="13">Dhaka Bank Limited</option>
                                                    <option value="14">Dutch - Bangla Bank Limited</option>
                                                    <option value="15">EBL - Eastern Bank Limited</option>
                                                    <option value="16">EXIM - Export Import Bank of Bangladesh Limited</option>
                                                    <option value="17">FSIBL - First Security Islami Bank Limited</option>
                                                    <option value="18">Habib Bank Limited</option>
                                                    <option value="19">ICB Islamic Bank Limited</option>
                                                    <option value="20">IFIC - International Finance Invest and Commerce Bank Limited</option>
                                                    <option value="21">Islami Bank Bangladesh Limited</option>
                                                    <option value="22">Jamuna Bank Limited</option>
                                                    <option value="23">Janata Bank Limited</option>
                                                    <option value="24">Meghna Bank Limited</option>
                                                    <option value="25">Mercantile Bank Limited</option>
                                                    <option value="26">Midland Bank Limited</option>
                                                    <option value="27">Modhumoti Bank Limited</option>
                                                    <option value="28">Mutual Trust Bank Limited</option>
                                                    <option value="29">National Bank Limited</option>
                                                    <option value="30">National Bank of Pakistan</option>
                                                    <option value="31">NCC - National Credit &amp; Commerce Bank Limited</option>
                                                    <option value="32">NRB Bank Limited</option>
                                                    <option value="33">NRB Commercial Bank Limited</option>
                                                    <option value="34">Global Islami Bank Limited</option>
                                                    <option value="35">One Bank Limited</option>
                                                    <option value="36">Padma Bank Limited</option>
                                                    <option value="37">Prime Bank Limited</option>
                                                    <option value="38">Pubali Bank Limited</option>
                                                    <option value="39">Rupali Bank Limited</option>
                                                    <option value="40">Rajshahi Krishi Unnayan Bank</option>
                                                    <option value="41">Shahjalal Islami Bank Limited</option>
                                                    <option value="42">Social Islami Bank Limited</option>
                                                    <option value="43">Sonali Bank Limited</option>
                                                    <option value="44">SBAC - South Bangla Agriculture &amp; Commerce Bank Limited</option>
                                                    <option value="45">Southeast Bank Limited</option>
                                                    <option value="46">Standard Bank Limited</option>
                                                    <option value="47">SCB - Standard Chartered Bank</option>
                                                    <option value="48">State Bank of India</option>
                                                    <option value="49">Shimanto Bank Limited</option>
                                                    <option value="50">The City Bank Limited</option>
                                                    <option value="51">HSBC - The Hongkong and Shanghai Banking Corporation Limited</option>
                                                    <option value="52">The Premier Bank Limited</option>
                                                    <option value="53">Trust Bank Limited</option>
                                                    <option value="54">Union Bank Limited</option>
                                                    <option value="55">UCBL - United Commercial Bank Limited</option>
                                                    <option value="56">Uttara Bank Limited</option>
                                                    <option value="57">Woori Bank Bangladesh</option>
                                                    <option value="59">COMMUNITY BANK BANGLADESH LTD</option>
                                                </select>
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="branch_id" class="form-label">Bank Branch <span class="text-danger">*</span></label>
                                                <select class="form-control required select2" id="branch_id" name="branch_id">
                                                    <option selected="selected" value="">Select Branch</option>
                                                    <option value="1">Main Branch</option>
                                                </select>
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="district_name" class="form-label">Bank District <span class="text-danger">*</span></label>
                                                <input class="form-control required" placeholder="Enter Bank District Name" name="bank_district_name" type="text" id="district_name">
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="account_number" class="form-label">Bank A/C Number <span class="text-danger">*</span></label>
                                                <input class="form-control required" placeholder="Enter Bank Account Number" name="bank_account_number" type="text" id="account_number">
                                                <i class="help-text">** Bank AC must be 13 digits</i>
                                                <span class="error-message" style="color: red; display: none;"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary next-step">Save & Next</button>
                                    <button type="button" class="btn btn-secondary prev-step">Back</button>
                                </form>
                            </div>

                            <!-- Step 3 Content -->
                            <div id="step-3" class="step-content">
                                <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                    <h4 class="card-title mb-0">Authorize</h4>
                                </div>
                                <form id="step-3-form" action="{{ route('authorize.store') }}" method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row p-3">

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input name="user_id" class="user_id" type="hidden" value="">
                                                </div>
                                            </div>


                                            <div class="col-md-3 mb-2">
                                                <label for="auth_courtesy_title" class="form-label">Courtesy Title <span class="text-danger">*</span></label>
                                                <select class="form-control select2" id="auth_courtesy_title" maxlength="10" name="auth_courtesy_title">
                                                    <option selected="selected" value="">Select</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Dr">Dr</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                                                <input class="form-control" maxlength="100" placeholder="Enter First Name" name="auth_firstname" type="text" id="firstname">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                <input class="form-control" maxlength="100" placeholder="Enter Last Name" name="auth_lastname" type="text" id="lastname">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="occupation" class="form-label">Occupation <span class="text-danger">*</span></label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Occupation" name="auth_occupation" type="text" id="occupation">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="date_of_birth" class="form-label">Date of Birth (YYYY-MM-DD) <span class="text-danger">*</span></label>
                                                <div class="flatpickr">
                                                    <input class="form-control birthdate" placeholder="Enter Date of Birth" id="auth_date_of_birth" name="auth_date_of_birth" type="date">
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="nid" class="form-label">NID <span class="text-danger">*</span></label>
                                                <input class="form-control" minlength="10" maxlength="20" placeholder="Enter NID" name="auth_nid" type="text" id="nid">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="father_name" class="form-label">Father&#039;s Name <span class="text-danger">*</span></label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Father Name" name="auth_father_name" type="text" id="father_name">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="mother_name" class="form-label">Mother&#039;s Name <span class="text-danger">*</span></label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Mother Name" name="auth_mother_name" type="text" id="mother_name">
                                            </div>

                                            <div class="col-md-12 mb-2">
                                                <label for="address_line_1" class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 1" name="auth_address_line_1" type="text" id="address_line_1">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label for="address_line_2" class="form-label">Address Line 2</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 2" name="auth_address_line_2" type="text" id="address_line_2">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label for="address_line_3" class="form-label">Address Line 3</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 3" name="auth_address_line_3" type="text" id="address_line_3">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                                <input class="form-control" maxlength="25" placeholder="Enter City" name="auth_city" type="text" id="auth_city">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="post_code" class="form-label">Post Code <span class="text-danger">*</span></label>
                                                <input class="form-control" maxlength="10" placeholder="Enter Post Code" name="auth_post_code" type="text" id="post_code">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="division" class="form-label">Division <span class="text-danger">*</span></label>
                                                <input class="form-control" maxlength="25" placeholder="Enter Division" name="auth_division" type="text" id="division">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="auth_country" class="form-label">Country <span class="text-danger">*</span></label>
                                                <select class="form-control select2" id="auth_country" name="auth_country">
                                                    <option selected="selected" value="">Select Country</option>
                                                    <option value="ban">Bangladesh</option>
                                                </select>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input class="form-control" maxlength="80" placeholder="Enter Email Address" name="auth_email" type="email" id="auth_email">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                                <input class="form-control" maxlength="20" placeholder="Enter Mobile Number" name="auth_mobile" type="text" id="auth_mobile">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="telephone" class="form-label">Telephone</label>
                                                <input class="form-control" maxlength="20" placeholder="Enter Telephone" name="auth_telephone" type="text" id="auth_telephone">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="fax" class="form-label">Fax</label>
                                                <input class="form-control" maxlength="20" placeholder="Enter Fax" name="auth_fax" type="text" id="auth_fax">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary next-step">Save & Next</button>
                                    <button type="button" class="btn btn-secondary prev-step">Back</button>
                                </form>
                            </div>

                            <div id="step-4" class="step-content">
                                <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                    <h4 class="card-title mb-0"> Nominee(s)</h4>
                                </div>
                                <form action="{{ route('nominee.store') }}" method="post" id="step-4-form">
                                    @csrf
                                    <div class="m-3">
                                        <input name="user_id" class="user_id" type="hidden">
                                    </div>

                                    <div class="card mt-4">
                                        <div>
                                            <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                                <h4 class="card-title mb-0">Nominee 1</h4>
                                            </div>

                                            <div class="row p-3">
                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_courtesy_title" class="form-label">Courtesy Title <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" maxlength="10" id="nominee_1_courtesy_title" name="nominee_1_courtesy_title">
                                                        <option selected="selected" value="">Select</option>
                                                        <option value="Mr">Mr</option>
                                                        <option value="Mrs">Mrs</option>
                                                        <option value="Ms">Ms</option>
                                                        <option value="Dr">Dr</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="100" placeholder="Enter First Name" name="nominee_1_firstname" type="text" id="nominee_1_firstname">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="100" placeholder="Enter Last Name" name="nominee_1_lastname" type="text" id="nominee_1_lastname">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_relationship" class="form-label">Relationship <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="100" placeholder="Relationship with A/C Holder" name="nominee_1_relationship" type="text" id="nominee_1_relationship">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_percentage" class="form-label">Percentage <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input class="form-control" placeholder="Enter Percentage(%)" id="nominee_1_percentage" min="0" max="100" autocomplete="off" name="nominee_1_percentage" type="number">
                                                        <button class="btn btn-light shadow-none ms-0 percentage_addon" type="button" id="percentage-addon">%</button>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 my-3">
                                                    <p class="required"><b>Residential Status</b></p>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="nominee_1_residency_Resident" checked="checked" name="nominee_1_residency" type="radio" value="Resident">
                                                        <label for="nominee_1_residency_Resident" class="form-check-label">Resident</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="nominee_1_residency_Non_Resident" name="nominee_1_residency" type="radio" value="Non Resident">
                                                        <label for="nominee_1_residency_Non_Resident" class="form-check-label">Non Resident</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="nominee_1_residency_Foreigner" name="nominee_1_residency" type="radio" value="Foreigner">
                                                        <label for="nominee_1_residency_Foreigner" class="form-check-label">Foreigner</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_date_of_birth" class="form-label">Date of Birth (YYYY-MM-DD) <span class="text-danger">*</span></label>
                                                    <div class="flatpickr">
                                                        <input class="form-control birthdate" placeholder="Enter Date of Birth" id="nominee_1_date_of_birth" name="nominee_1_date_of_birth" type="date">
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_nid" class="form-label">NID <span class="text-danger">*</span></label>
                                                    <input class="form-control" minlength="10" maxlength="20" placeholder="Enter NID" name="nominee_1_nid" type="text" id="nominee_1_nid">
                                                </div>

                                                <div class="col-md-12 mb-2">
                                                    <label for="nominee_1_address_line_1" class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="30" placeholder="Enter Address Line 1" name="nominee_1_address_line_1" type="text" id="nominee_1_address_line_1">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="nominee_1_address_line_2" class="form-label">Address Line 2</label>
                                                    <input class="form-control" maxlength="30" placeholder="Enter Address Line 2" name="nominee_1_address_line_2" type="text" id="nominee_1_address_line_2">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="nominee_1_address_line_3" class="form-label">Address Line 3</label>
                                                    <input class="form-control" maxlength="30" placeholder="Enter Address Line 3" name="nominee_1_address_line_3" type="text" id="nominee_1_address_line_3">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_city" class="form-label">City <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="25" placeholder="Enter City" name="nominee_1_city" type="text" id="nominee_1_city">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_post_code" class="form-label">Post Code <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="10" placeholder="Enter Post Code" name="nominee_1_post_code" type="text" id="nominee_1_post_code">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_division" class="form-label">Division <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="25" placeholder="Enter Division" name="nominee_1_division" type="text" id="nominee_1_division">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_country" class="form-label">Country <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" id="nominee_1_country" name="nominee_1_country">
                                                        <option selected="selected" value="">Select Country</option>
                                                        <option value="ban">Bangladesh</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_email" class="form-label">Email <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="80" placeholder="Enter Email Address" name="nominee_1_email" type="email" id="nominee_1_email">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="20" placeholder="Enter Mobile Number" name="nominee_1_mobile" type="text" id="nominee_1_mobile">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_telephone" class="form-label">Telephone</label>
                                                    <input class="form-control" maxlength="20" placeholder="Enter Telephone" name="nominee_1_telephone" type="text" id="nominee_1_telephone">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_fax" class="form-label">Fax</label>
                                                    <input class="form-control" maxlength="20" placeholder="Enter Fax" name="nominee_1_fax" type="text" id="nominee_1_fax">
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="view-profile-card-header p-3 border border-info" role="alert">
                                                        Do you want to add Nominee 1 Guardian (If Nominee is A Minor)?
                                                        <label class="custom-switch">
                                                            <input name="nominee_1_is_guardian" type="checkbox" value="1" class="form-check-input" id="nominee_1_is_guardian">
                                                            <div class="custom-slider round"></div>
                                                        </label>
                                                    </div>
                                                </div>

                                                {{-- Nominee 1 Guardian --}}
                                                {{-- <div class="nominee_1_guardian" style="display:none">
                                                    <div class="card border-info border-top-0 border-radious-0">
                                                        <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                                            <h4 class="card-title mb-0">Nominee 1 Guardian (If Nominee is A Minor)</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row  p-2">
                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_courtesy_title" class="form-label">Courtesy Title <span class="text-danger">*</span></label>
                                                                    <select class="form-control select2" maxlength="10" id="guardian_of_nominee_1_courtesy_title" name="guardian_of_nominee_1_courtesy_title"><option selected="selected" value="">Select</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Ms">Ms</option><option value="Dr">Dr</option></select>
                                                                </div>
                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="100" placeholder="Enter First Name" name="guardian_of_nominee_1_firstname" type="text" id="guardian_of_nominee_1_firstname">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="100" placeholder="Enter Last Name" name="guardian_of_nominee_1_lastname" type="text" id="guardian_of_nominee_1_lastname">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_relationship" class="form-label">Relationship <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="100" placeholder="Relationship with Nominee" name="guardian_of_nominee_1_relationship" type="text" id="guardian_of_nominee_1_relationship">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_maturity_date_of_minor" class="form-label">Maturity Date of Minor (YYYY-MM-DD) <span class="text-danger">*</span></label>
                                                                    <div class="flatpickr">
                                                                        <input class="form-control datepicker" id="guardian_of_nominee_1_maturity_date_of_minor" name="guardian_of_nominee_1_maturity_date_of_minor" type="date">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3 my-3">
                                                                    <p class="required"><b>Residential Status</b></p>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" id="guardian_of_nominee_1_residency_Resident" checked="checked" name="guardian_of_nominee_1_residency" type="radio" value="Resident">
                                                                        <label for="guardian_of_nominee_1_residency_Resident" class="form-check-label">Resident</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" id="guardian_of_nominee_1_residency_Non_Resident" name="guardian_of_nominee_1_residency" type="radio" value="Non Resident">
                                                                        <label for="guardian_of_nominee_1_residency_Non_Resident" class="form-check-label">Non Resident</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" id="guardian_of_nominee_1_residency_Foreigner" name="guardian_of_nominee_1_residency" type="radio" value="Foreigner">
                                                                        <label for="guardian_of_nominee_1_residency_Foreigner" class="form-check-label">Foreigner</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_date_of_birth" class="form-label">Date of Birth (YYYY-MM-DD) <span class="text-danger">*</span></label>
                                                                    <div class="flatpickr">
                                                                        <input class="form-control birthdate" placeholder="Enter Date of Birth" name="guardian_of_nominee_1_date_of_birth" type="date" id="guardian_of_nominee_1_date_of_birth">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_nid" class="form-label">NID <span class="text-danger">*</span></label>
                                                                    <input class="form-control" minlength="20" maxlength="16" placeholder="Enter NID" name="guardian_of_nominee_1_nid" type="text" id="guardian_of_nominee_1_nid">
                                                                </div>

                                                                <div class="col-md-12 mb-2">
                                                                    <label for="guardian_of_nominee_1_address_line_1" class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="30" placeholder="Enter Address Line 1" name="guardian_of_nominee_1_address_line_1" type="text" id="guardian_of_nominee_1_address_line_1">
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="guardian_of_nominee_1_address_line_2" class="form-label">Address Line 2</label>
                                                                    <input class="form-control" maxlength="30" placeholder="Enter Address Line 2" name="guardian_of_nominee_1_address_line_2" type="text" id="guardian_of_nominee_1_address_line_2">
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="guardian_of_nominee_1_address_line_3" class="form-label">Address Line 3</label>
                                                                    <input class="form-control" maxlength="30" placeholder="Enter Address Line 3" name="guardian_of_nominee_1_address_line_3" type="text" id="guardian_of_nominee_1_address_line_3">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_city" class="form-label">City <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="25" placeholder="Enter City" name="guardian_of_nominee_1_city" type="text" id="guardian_of_nominee_1_city">
                                                                </div>
                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_post_code" class="form-label">Post Code <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="10" placeholder="Enter Post Code" name="guardian_of_nominee_1_post_code" type="text" id="guardian_of_nominee_1_post_code">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_division" class="form-label">Division <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="25" placeholder="Enter Division" name="guardian_of_nominee_1_division" type="text" id="guardian_of_nominee_1_division">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_country" class="form-label">Country <span class="text-danger">*</span></label>
                                                                    <select class="form-control select2" id="guardian_of_nominee_1_country" name="guardian_of_nominee_1_country">
                                                                        <option selected="selected" value="">Select Country</option>
                                                                        <option value="ban">Bangladesh</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_email" class="form-label">Email <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="80" placeholder="Enter Email Address" name="guardian_of_nominee_1_email" type="email" id="guardian_of_nominee_1_email">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="20" placeholder="Enter Mobile Number" name="guardian_of_nominee_1_mobile" type="text" id="guardian_of_nominee_1_mobile">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_telephone" class="form-label">Telephone</label>
                                                                    <input class="form-control" maxlength="20" placeholder="Enter Telephone" name="guardian_of_nominee_1_telephone" type="text" id="guardian_of_nominee_1_telephone">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_fax" class="form-label">Fax</label>
                                                                    <input class="form-control" maxlength="20" placeholder="Enter Fax" name="guardian_of_nominee_1_fax" type="text" id="guardian_of_nominee_1_fax">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>

                                        <div class="mb-2 p-3">
                                            <div class="view-profile-card-header p-3 rounded-2 border border-warning" role="alert">
                                                Do you want to add nominee 2?
                                                <label class="custom-switch">
                                                    <input name="nominee_2" type="checkbox" value="1" class="form-check-input" id="add-nominee_2">
                                                    <div class="custom-slider round"></div>
                                                </label>
                                            </div>
                                        </div>

                                        {{-- Nominee 2 Details --}}
                                        {{-- <div class="mb-3" id="nominee_2-details" style="display:none">
                                            <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                                <h4 class="card-title mb-0">Nominee 2</h4>
                                            </div>

                                            <div class="row p-3">
                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_courtesy_title" class="form-label">Courtesy Title <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" maxlength="10" id="nominee_2_courtesy_title" name="nominee_2_courtesy_title"><option selected="selected" value="">Select</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Ms">Ms</option><option value="Dr">Dr</option></select>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="100" placeholder="Enter First Name" name="nominee_2_firstname" type="text" id="nominee_2_firstname">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="100" placeholder="Enter Last Name" name="nominee_2_lastname" type="text" id="nominee_2_lastname">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_relationship" class="form-label">Relationship <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="100" placeholder="Relationship with A/C Holder" name="nominee_2_relationship" type="text" id="nominee_2_relationship">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_percentage" class="form-label">Percentage <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                        <input class="form-control" placeholder="Enter Percentage(%)" id="nominee_2_percentage" min="0" max="100" autocomplete="off" name="nominee_2_percentage" type="number">
                                                        <button class="btn btn-light shadow-none ms-0 percentage_addon" type="button" id="percentage-addon">%</button>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 my-3">
                                                    <p class="required"><b>Residential Status</b></p>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="nominee_2_residency_Resident" checked="checked" name="nominee_2_residency" type="radio" value="Resident">
                                                        <label for="nominee_2_residency_Resident" class="form-check-label">Resident</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="nominee_2_residency_Non_Resident" name="nominee_2_residency" type="radio" value="Non Resident">
                                                        <label for="nominee_2_residency_Non_Resident" class="form-check-label">Non Resident</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" id="nominee_2_residency_Foreigner" name="nominee_2_residency" type="radio" value="Foreigner">
                                                        <label for="nominee_2_residency_Foreigner" class="form-check-label">Foreigner</label>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_date_of_birth" class="form-label">Date of Birth (YYYY-MM-DD) <span class="text-danger">*</span></label>
                                                    <div class="flatpickr">
                                                        <input class="form-control birthdate" placeholder="Enter Date of Birth" id="nominee_2_date_of_birth" name="nominee_2_date_of_birth" type="date">
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_nid" class="form-label">NID <span class="text-danger">*</span></label>
                                                    <input class="form-control" minlength="10" maxlength="20" placeholder="Enter NID" name="nominee_2_nid" type="text" id="nominee_2_nid">
                                                </div>

                                                <div class="col-md-12 mb-2">
                                                    <label for="nominee_2_address_line_1" class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="30" placeholder="Enter Address Line 1" name="nominee_2_address_line_1" type="text" id="nominee_2_address_line_1">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="nominee_2_address_line_2" class="form-label">Address Line 2</label>
                                                    <input class="form-control" maxlength="30" placeholder="Enter Address Line 2" name="nominee_2_address_line_2" type="text" id="nominee_2_address_line_2">
                                                </div>
                                                <div class="col-md-6 mb-2">
                                                    <label for="nominee_2_address_line_3" class="form-label">Address Line 3</label>
                                                    <input class="form-control" maxlength="30" placeholder="Enter Address Line 3" name="nominee_2_address_line_3" type="text" id="nominee_2_address_line_3">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_city" class="form-label">City <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="25" placeholder="Enter City" name="nominee_2_city" type="text" id="nominee_2_city">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_post_code" class="form-label">Post Code <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="10" placeholder="Enter Post Code" name="nominee_2_post_code" type="text" id="nominee_2_post_code">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_division" class="form-label">Division <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="25" placeholder="Enter Division" name="nominee_2_division" type="text" id="nominee_2_division">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_country" class="form-label">Country <span class="text-danger">*</span></label>
                                                    <select class="form-control select2" id="nominee_2_country" name="nominee_2_country">
                                                        <option selected="selected" value="">Select Country</option>
                                                        <option value="ban">Bangladesh</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_email" class="form-label">Email <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="80" placeholder="Enter Email Address" name="nominee_2_email" type="email" id="nominee_2_email">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                                    <input class="form-control" maxlength="20" placeholder="Enter Mobile Number" name="nominee_2_mobile" type="text" id="nominee_2_mobile">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_telephone" class="form-label">Telephone</label>
                                                    <input class="form-control" maxlength="20" placeholder="Enter Telephone" name="nominee_2_telephone" type="text" id="nominee_2_telephone">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_fax" class="form-label">Fax</label>
                                                    <input class="form-control" maxlength="20" placeholder="Enter Fax" name="nominee_2_fax" type="text" id="nominee_2_fax">
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="view-profile-card-header p-3 border border-info" role="alert">
                                                        Do you want to add Nominee 2 Guardian (If Nominee is A Minor)?
                                                        <label class="custom-switch">
                                                            <input name="nominee_2_is_guardian" type="checkbox" value="1" class="form-check-input" id="nominee_2_is_guardian">
                                                            <div class="custom-slider round"></div>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="nominee_2_guardian" style="display:none">
                                                    <div class="card border-info border-top-0 border-radious-0">
                                                        <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                                            <h4 class="card-title mb-0">Nominee 2 Guardian (If Nominee is A Minor)</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row  p-2">
                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_courtesy_title" class="form-label">Courtesy Title <span class="text-danger">*</span></label>
                                                                    <select class="form-control select2" maxlength="10" id="guardian_of_nominee_2_courtesy_title" name="guardian_of_nominee_2_courtesy_title"><option selected="selected" value="">Select</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Ms">Ms</option><option value="Dr">Dr</option></select>
                                                                </div>
                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="100" placeholder="Enter First Name" name="guardian_of_nominee_2_firstname" type="text" id="guardian_of_nominee_2_firstname">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="100" placeholder="Enter Last Name" name="guardian_of_nominee_2_lastname" type="text" id="guardian_of_nominee_2_lastname">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_relationship" class="form-label">Relationship <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="100" placeholder="Relationship with Nominee" name="guardian_of_nominee_2_relationship" type="text" id="guardian_of_nominee_2_relationship">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_maturity_date_of_minor" class="form-label">Maturity Date of Minor (YYYY-MM-DD) <span class="text-danger">*</span></label>
                                                                    <div class="flatpickr">
                                                                        <input class="form-control datepicker" id="guardian_of_nominee_2_maturity_date_of_minor" name="guardian_of_nominee_2_maturity_date_of_minor" type="date">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3 my-3">
                                                                    <p><b>Residential Status</b></p>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" id="guardian_of_nominee_2_residency_Resident" checked="checked" name="guardian_of_nominee_2_residency" type="radio" value="Resident">
                                                                        <label for="guardian_of_nominee_2_residency_Resident" class="form-check-label">Resident</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" id="guardian_of_nominee_2_residency_Non_Resident" name="guardian_of_nominee_2_residency" type="radio" value="Non Resident">
                                                                        <label for="guardian_of_nominee_2_residency_Non_Resident" class="form-check-label">Non Resident</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" id="guardian_of_nominee_2_residency_Foreigner" name="guardian_of_nominee_2_residency" type="radio" value="Foreigner">
                                                                        <label for="guardian_of_nominee_2_residency_Foreigner" class="form-check-label">Foreigner</label>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_date_of_birth" class="form-label">Date of Birth (YYYY-MM-DD) <span class="text-danger">*</span></label>
                                                                    <div class="flatpickr">
                                                                        <input class="form-control birthdate" placeholder="Enter Date of Birth" name="guardian_of_nominee_2_date_of_birth" type="date" id="guardian_of_nominee_2_date_of_birth">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_nid" class="form-label">NID <span class="text-danger">*</span></label>
                                                                    <input class="form-control" minlength="20" maxlength="16" placeholder="Enter NID" name="guardian_of_nominee_2_nid" type="text" id="guardian_of_nominee_2_nid">
                                                                </div>

                                                                <div class="col-md-12 mb-2">
                                                                    <label for="guardian_of_nominee_2_address_line_1" class="form-label">Address Line 1 <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="30" placeholder="Enter Address Line 1" name="guardian_of_nominee_2_address_line_1" type="text" id="guardian_of_nominee_2_address_line_1">
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="guardian_of_nominee_2_address_line_2" class="form-label">Address Line 2</label>
                                                                    <input class="form-control" maxlength="30" placeholder="Enter Address Line 2" name="guardian_of_nominee_2_address_line_2" type="text" id="guardian_of_nominee_2_address_line_2">
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <label for="guardian_of_nominee_2_address_line_3" class="form-label">Address Line 3</label>
                                                                    <input class="form-control" maxlength="30" placeholder="Enter Address Line 3" name="guardian_of_nominee_2_address_line_3" type="text" id="guardian_of_nominee_2_address_line_3">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_city" class="form-label">City <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="25" placeholder="Enter City" name="guardian_of_nominee_2_city" type="text" id="guardian_of_nominee_2_city">
                                                                </div>
                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_post_code" class="form-label">Post Code <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="10" placeholder="Enter Post Code" name="guardian_of_nominee_2_post_code" type="text" id="guardian_of_nominee_2_post_code">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_division" class="form-label">Division <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="25" placeholder="Enter Division" name="guardian_of_nominee_2_division" type="text" id="guardian_of_nominee_2_division">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_country" class="form-label">Country <span class="text-danger">*</span></label>
                                                                    <select class="form-control select2" id="guardian_of_nominee_2_country" name="guardian_of_nominee_2_country">
                                                                        <option selected="selected" value="">Select Country</option>
                                                                        <option value="ban">Bangladesh</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_email" class="form-label">Email <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="80" placeholder="Enter Email Address" name="guardian_of_nominee_2_email" type="email" id="guardian_of_nominee_2_email">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_mobile" class="form-label">Mobile <span class="text-danger">*</span></label>
                                                                    <input class="form-control" maxlength="20" placeholder="Enter Mobile Number" name="guardian_of_nominee_2_mobile" type="text" id="guardian_of_nominee_2_mobile">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_telephone" class="form-label">Telephone</label>
                                                                    <input class="form-control" maxlength="20" placeholder="Enter Telephone" name="guardian_of_nominee_2_telephone" type="text" id="guardian_of_nominee_2_telephone">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_fax" class="form-label">Fax</label>
                                                                    <input class="form-control" maxlength="20" placeholder="Enter Fax" name="guardian_of_nominee_2_fax" type="text" id="guardian_of_nominee_2_fax">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}

                                    </div>
                                    <button type="submit" class="btn btn-primary next-step">Save & Next</button>
                                    <button type="button" class="btn btn-secondary prev-step">Back</button>
                                </form>
                            </div>

                            <div id="step-5" class="step-content">
                                <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                    <h4 class="card-title mb-0">Please Upload Your Necessary Document</h4>
                                </div>
                                <div class="row row p-2 pt-3">
                                    <div class="col-lg-3">
                                        <div class="mb-4">
                                            <form method="POST" id="image-form" enctype="multipart/form-data">
                                                @csrf
                                                <input name="id" type="hidden" value="">
                                                <input type="hidden" id="csrf-token" value="{{ csrf_token() }}">
                                                <input name="user_id" class="user_id" type="hidden">
                                                <input name="image_title" type="hidden" value="First Applicant (1st Holder) NID/Passport/Driving Front Side">
                                                <input name="image_preview" type="hidden" value="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">

                                                <div class="upload-preview">
                                                    <a href="javascript:void(0)" style="cursor:default">
                                                        <img id="preview-image" class="img-fluid" alt="" src="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">
                                                    </a>
                                                </div>
                                                <div class="mt-3">
                                                    <h5 class="m-0">First Applicant (1st Holder) NID/Passport/Driving Front Side</h5>
                                                    <span class="text-info help-text"></span>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="custom-file-upload">
                                                            <button type="button" class="btn btn-warning waves-effect waves-light btn-sm" id="choose-file-btn">Choose File</button>
                                                            <input id="file-input" name="first_applicant_1st_holder_photo" type="file" style="display: none;">
                                                        </div>
                                                        <button type="button" id="clear-btn" class="upload-clear d-none btn btn-soft-danger waves-effect waves-light btn-sm" style="margin-right:5px">Clear</button>
                                                        <button type="button" id="save-btn" class="upload-btn btn btn-soft-info waves-effect waves-light btn-sm d-none">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>


                                    <div class="col-lg-3">
                                        <div class="mb-4">
                                            <form method="POST" action="" class="document-frm" enctype="multipart/form-data">
                                                <input name="id" type="hidden" value="">
                                                <input name="user_id" type="hidden" value="95">
                                                <input name="title" type="hidden" value="First Applicant (1st Holder) NID/Passport/Driving Front Side">
                                                <input name="image_preview" type="hidden" value="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">

                                                <div class="upload-preview">
                                                    <a href="javascript:void(0)" style="cursor:default">
                                                        <img class="img-fluid" alt="" src="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">
                                                    </a>
                                                </div>
                                                <div class="mt-3">
                                                    <h5 class="m-0">First Applicant (1st Holder) NID/Passport/Driving Front Side</h5>
                                                    <span class="text-info help-text"></span>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="custom-file-upload">
                                                            <button type="button" class="btn btn-warning waves-effect waves-light btn-sm">Choose File</button>
                                                            <input name="file" type="file" />
                                                        </div>
                                                        <button type="button" class="upload-clear d-none btn btn-soft-danger waves-effect waves-light btn-sm" style="margin-right:5px">Clear</button>
                                                        <button type="submit" class="upload-btn btn btn-soft-info waves-effect waves-light btn-sm d-none">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="mb-4">
                                            <form method="POST" action="https://onlinebo.uftfast.com/bo-account/document/store" accept-charset="UTF-8" class="document-frm" enctype="multipart/form-data">

                                                <input name="id" type="hidden" value="">
                                                <input name="user_id" type="hidden" value="95">
                                                <input name="title" type="hidden" value="First Applicant (1st Holder) NID/Passport/Driving Back Side">
                                                <input name="image_preview" type="hidden" value="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">

                                                <div class="upload-preview">
                                                    <a href="javascript:void(0)" style="cursor:default">
                                                        <img class="img-fluid" alt="" src="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">
                                                    </a>
                                                </div>
                                                <div class="mt-3">
                                                    <h5 class="m-0">First Applicant (1st Holder) NID/Passport/Driving Back Side</h5>
                                                    <span class="text-info help-text">
                                                                            </span>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="custom-file-upload">
                                                            <button type="button" class="btn btn-warning waves-effect waves-light btn-sm">Choose File</button>
                                                            <input name="file" type="file" />
                                                        </div>
                                                        <button type="button" class="upload-clear d-none btn btn-soft-danger waves-effect waves-light btn-sm" style="margin-right:5px">Clear</button>
                                                        <button type="submit" class="upload-btn btn btn-soft-info waves-effect waves-light btn-sm d-none">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="mb-4">
                                            <form method="POST" action="https://onlinebo.uftfast.com/bo-account/document/store" accept-charset="UTF-8" class="document-frm" enctype="multipart/form-data">

                                                <input name="id" type="hidden" value="">
                                                <input name="user_id" type="hidden" value="95">
                                                <input name="title" type="hidden" value="Signature of First Applicant">
                                                <input name="image_preview" type="hidden" value="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">

                                                <div class="upload-preview">
                                                    <a href="javascript:void(0)" style="cursor:default">
                                                        <img class="img-fluid" alt="" src="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">
                                                    </a>
                                                </div>
                                                <div class="mt-3">
                                                    <h5 class="m-0">Signature of First Applicant</h5>
                                                    <span class="text-info help-text">
                                                                                    (Image size 300x50 pixel)
                                                                            </span>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="custom-file-upload">
                                                            <button type="button" class="btn btn-warning waves-effect waves-light btn-sm">Choose File</button>
                                                            <input name="file" type="file" />
                                                        </div>
                                                        <button type="button" class="upload-clear d-none btn btn-soft-danger waves-effect waves-light btn-sm" style="margin-right:5px">Clear</button>
                                                        <button type="submit" class="upload-btn btn btn-soft-info waves-effect waves-light btn-sm d-none">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="mb-4">
                                            <form method="POST" action="https://onlinebo.uftfast.com/bo-account/document/store" accept-charset="UTF-8" class="document-frm" enctype="multipart/form-data">

                                                <input name="id" type="hidden" value="">
                                                <input name="user_id" type="hidden" value="95">
                                                <input name="title" type="hidden" value="TIN Certificate of First Applicant (1st Holder)">
                                                <input name="image_preview" type="hidden" value="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">

                                                <div class="upload-preview">
                                                    <a href="javascript:void(0)" style="cursor:default">
                                                        <img class="img-fluid" alt="" src="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">
                                                    </a>
                                                </div>
                                                <div class="mt-3">
                                                    <h5 class="m-0">TIN Certificate of First Applicant (1st Holder)</h5>
                                                    <span class="text-info help-text"></span>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="custom-file-upload">
                                                            <button type="button" class="btn btn-warning waves-effect waves-light btn-sm">Choose File</button>
                                                            <input name="file" type="file" />
                                                        </div>
                                                        <button type="button" class="upload-clear d-none btn btn-soft-danger waves-effect waves-light btn-sm" style="margin-right:5px">Clear</button>
                                                        <button type="submit" class="upload-btn btn btn-soft-info waves-effect waves-light btn-sm d-none">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="mb-4">
                                            <form method="POST" action="https://onlinebo.uftfast.com/bo-account/document/store" accept-charset="UTF-8" class="document-frm" enctype="multipart/form-data">

                                                <input name="id" type="hidden" value="">
                                                <input name="user_id" type="hidden" value="95">
                                                <input name="title" type="hidden" value="Bank Statement/Certificate/Cheque Copy">
                                                <input name="image_preview" type="hidden" value="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">

                                                <div class="upload-preview">
                                                    <a href="javascript:void(0)" style="cursor:default">
                                                        <img class="img-fluid" alt="" src="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">
                                                    </a>
                                                </div>
                                                <div class="mt-3">
                                                    <h5 class="m-0">Bank Statement/Certificate/Cheque Copy</h5>
                                                    <span class="text-info help-text">
                                                                                    (Please use a MICR Cheque Leaf)
                                                                            </span>
                                                </div>
                                                <div class="mt-2">
                                                    <div class="d-flex align-items-center">
                                                        <div class="custom-file-upload">
                                                            <button type="button" class="btn btn-warning waves-effect waves-light btn-sm">Choose File</button>
                                                            <input name="file" type="file" />
                                                        </div>
                                                        <button type="button" class="upload-clear d-none btn btn-soft-danger waves-effect waves-light btn-sm" style="margin-right:5px">Clear</button>
                                                        <button type="submit" class="upload-btn btn btn-soft-info waves-effect waves-light btn-sm d-none">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary submit">Submit</button>
                                <button type="button" class="btn btn-secondary prev-step">Back</button>
                            </div>
                        </div>
                    </div>
                </div>


                <footer class="footer" style="height:90px">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-8 py-0 d-none d-sm-block">
                                <h6 class="d-block mb-0 text-info">ANC Securities COMPANY LIMITED</h6>
                                <p class="d-block mb-0 text-muted">TREC Holder of Dhaka &amp; Chittagong Stock Exchange Ltd</p>
                                <b class="d-block mb-0">E-Trade License No: TRAD/DSCC/344810/2019</b>
                            </div>
                            <div class="col-sm-4 py-0">
                                <div class="text-sm-end text-primary">
                                    2024&copy;ANC Securities BO Account
                                </div>
                                <div class="text-sm-end text-success">
                                    Design & Develop by <a href="https://github.com/saikatExpress" class="text-decoration-underline">TS WEB BUILD</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>

            </div>
        </div>
    </div>

    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Contact Us</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="contactForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin/assets/js/bo.js') }}"></script>
    <script src="{{ asset('admin/assets/js/boupload.js') }}"></script>
    <!-- jQuery -->
    <script>
        $(document).ready(function() {
            var currentStep = 1;
            var totalSteps = $('#step-wizard .step-content').length;

            function validateStep(step) {
                // var isValid = true;
                // $('#step-' + step + '-form .required').each(function() {
                //     var $input = $(this);
                //     var $errorMessage = $input.next('.error-message');

                //     // Check if joint option is selected and the input is part of the joint form
                //     if ($('#type_of_client:checked').val() === 'joint' || !$input.closest('.joint_applicant').length) {
                //         if (!$input.val()) {
                //             isValid = false;
                //             $input.addClass('is-invalid');
                //             $errorMessage.text('This field is required.').show();
                //         } else {
                //             $input.removeClass('is-invalid');
                //             $errorMessage.hide();
                //         }
                //     } else {
                //         $input.removeClass('is-invalid');
                //         $errorMessage.hide();
                //     }
                // });
                // return isValid;
                return true;
            }

            function submitStepForm(step) {
                var form = $('#step-' + step + '-form');
                $.ajax({
                    type: 'POST',
                    url: form.attr('action'),
                    data: form.serialize(),
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Form ' + step + ' submitted successfully.'
                            }).then(function() {
                                $('#bo_last_id').val(response.id);
                                $('.user_id').val(response.id);
                                $('#step-' + currentStep).removeClass('active');
                                currentStep++;
                                $('#step-' + currentStep).addClass('active');
                            });
                        } else {
                            console.error('Validation failed for form ' + step);
                            $.each(response.errors, function(key, value) {
                                var $input = $('input[name="' + key + '"]');
                                var $errorMessage = $input.next('.error-message');
                                $input.addClass('is-invalid');
                                $errorMessage.text(value[0]).show();
                            });
                        }
                    },
                    error: function(response) {
                        console.error('Error submitting form ' + step);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while submitting the form. Please try again.'
                        });
                    }
                });
            }

            $('.next-step').click(function(e) {
                e.preventDefault();
                if (validateStep(currentStep)) {
                    submitStepForm(currentStep);
                } else {
                    $('html, body').animate({
                        scrollTop: $('.is-invalid:first').offset().top
                    }, 500);
                }
            });

            $('.prev-step').click(function(e) {
                e.preventDefault();
                $('#step-' + currentStep).removeClass('active');
                currentStep--;
                $('#step-' + currentStep).addClass('active');
            });

            $('.submit').click(function(e) {
                e.preventDefault(); // Prevent default form submission
                if (validateStep(currentStep)) {
                    alert('Form submitted successfully!');
                    // You can submit the form using AJAX or redirect as needed
                }
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('input[name="bo_type"]').on('change', function(){
                if ($('#link_bo').is(':checked')) {
                    $('#form_bo_id').show();
                } else {
                    $('#form_bo_id').hide();
                }
            });
            $('input[name="type_of_client"]').on('change', function(){
                if ($('#type_of_client').is(':checked')) {
                    $('.joint_applicant').show();
                } else {
                    $('.joint_applicant').hide();
                }
            });
        });
    </script>

</body>
</html>
