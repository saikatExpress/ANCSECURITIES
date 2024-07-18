<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BO Form | Anc Securities</title>
  <link rel="icon" type="image/png" href="{{ asset('user/assets/logos/8022322.png') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    body {
      /* background-image: url(https://thumbs.dreamstime.com/z/blank-modern-digital-tablet-money-saving-account-passbo-passbook-book-bank-statement-middle-office-equipment-72000571.jpg);
      background-size: cover;
      background-position: 50% 0;
      background-repeat: no-repeat;
      min-height: 100vh; */
      background-color: #DFEDCC;
      font-family: Arial, sans-serif;
    }
    .accordion-item {
      background-color: #ffffff;
      border: 1px solid #ddd;
      border-radius: 5px;
      margin-bottom: 10px;
    }
    .accordion-item .card-header {
      background-color: #f5f5f5;
      border-bottom: 1px solid #ddd;
      padding: 15px;
      cursor: pointer;
      position: relative;
    }
    .accordion-item .card-header h2 {
      margin: 0;
      font-size: 18px;
      font-weight: bold;
      display: inline-block;
      position: relative;
    }
    .accordion-item .card-header h2:before {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0%;
      height: 2px;
      background-color: #007bff;
      transition: width 0.3s ease;
    }
    .accordion-item .card-header:hover h2:before {
      width: 100%;
    }
    .accordion-item .card-header .fas {
      margin-right: 10px;
    }
    .accordion-item .card-body {
      padding: 15px;
    }
    .accordion-item .card-body .form-group {
      margin-bottom: 20px;
    }
    .btn-submit-container {
      text-align: center;
      margin-top: 20px;
    }
    .btn-submit {
      margin-top: 10px;
    }
    .page-title {
      position: relative;
      text-align: center;
      margin-bottom: 20px;
    }
    .page-title h2 {
      display: inline-block;
      position: relative;
      font-size: 24px;
      font-weight: bold;
      color: #00814c;
      padding-bottom: 10px; /* Adjust as needed */
    }
    .page-title h2:before {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 50%; /* Start at half-width */
      height: 2px;
      background-color: #007bff;
      transition: width 0.3s ease;
    }
    .page-title h2:hover:before {
      width: 100%; /* Expand to full-width on hover */
    }
    .label-required::after {
        content: "*";
        color: red;
    }
    label.block {
        display: block;
    }
    .c-select[id*="Day"] {
        width: 29%;
        display: inline-block;
    }
    .c-select[id*="Month"] {
        width: 29%;
        display: inline-block;
    }
    .c-select[id*="Year"] {
        width: 29%;
        display: inline-block;
    }
  </style>
</head>
<body>

    <div class="container mt-5">

        <div class="page-title">
            <h2>New BO Account</h2>
        </div>

        <form id="boForm" action="/submit" method="POST">
            <div class="accordion" id="accordionExample">
            <!-- Section 1 -->
            <div class="accordion-item">
                <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <span class="fas fa-user"></span> Basic Information
                    </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">
                                <label for="fullName">Account Type : </label>
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Select</option>
                                    <option value="single">Single</option>
                                    <option value="joint">Joint</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="fullName">Introducer : </label>
                                <select name="" id="" class="form-control">
                                    <option value="" selected disabled>Select</option>
                                    <option value="single">Single</option>
                                    <option value="joint">Joint</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="accordion-item">
                <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <span class="fas fa-file-alt"></span> First Application Information
                    </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="" class="label-required">
                                    Name
                                </label>
                                <select name="" id="" class="c-select form-control">
                                    <option value="" selected disabled>Select</option>
                                    <option value="mr">Mr</option>
                                    <option value="mrs">Mrs</option>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="applicationNumber">Investor's First Name</label>
                                <input type="text" class="form-control" id="applicationNumber" name="applicationNumber" placeholder="Enter first name">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="applicationNumber">Investor's Last Name</label>
                                <input type="text" class="form-control" id="applicationNumber" name="applicationNumber" placeholder="Enter last name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="" class="label-required">
                                    Father/Hus Name
                                </label>
                                <select name="" id="" class="c-select form-control">
                                    <option value="father">Father Name</option>
                                    <option value="husband">Husband Name</option>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for="" class="blank-label">Father Name</label>
                                <input type="text" class="form-control" id="applicationNumber" name="applicationNumber" placeholder="Enter father name">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="" class="label-required">
                                    Mother Name
                                </label>
                                <input type="text" class="form-control" id="applicationNumber" name="applicationNumber" placeholder="Enter mother name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="" class="label-required block">
                                    Date of Birth
                                </label>
                                <select name="" id="ddlinvdobDay" class="c-select form-control">
                                    <option value="" selected disabled>Day</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                                <select name="" id="ddlinvdobMonth" class="c-select form-control">
                                    <option value="" selected disabled>Day</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                                <select name="" id="ddlinvdobYear" class="c-select form-control">
                                    <option value="" selected disabled>Day</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">
                                    Occupation
                                </label>
                                <select name="" id="" class="c-select form-control">
                                    <option value="" selected disabled>Select</option>
                                    <option value="">Teacher</option>
                                    <option value="">Businessman</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">
                                    Gender
                                </label>
                                <select name="" id="" class="c-select form-control">
                                    <option value="" selected disabled>Select</option>
                                    <option value="">Male</option>
                                    <option value="">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">
                                    Maritial Status
                                </label>
                                <select name="" id="" class="c-select form-control">
                                    <option value="" selected disabled>Select</option>
                                    <option value="">Married</option>
                                    <option value="">Unmarried</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="">
                                    Passport/NID
                                </label>
                                <select name="" id="" class="c-select form-control">
                                    <option value="">Nid</option>
                                    <option value="">Passport</option>
                                </select>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="">NID</label>
                                <input type="text" class="form-control" placeholder="Enter NID number">
                            </div>

                            <div class="form-group col-md-4">
                                <label class="block" for="">Passport/NID Issue Date</label>
                                <select name="" class="c-select form-control" id="ddlpassportissuebDay">
                                    <option value="" selected disabled>Day</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                                <select name="" class="c-select form-control" id="ddlpassportissuebMonth">
                                    <option value="" selected disabled>Month</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                                <select name="" class="c-select form-control" id="ddlpassportissuebYear">
                                    <option value="" selected disabled>Month</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="" class="label-required">
                                    State/Division
                                </label>
                                <select name="" id="ddlDivision" class="c-select form-control">
                                    <option value="" selected disabled>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class="label-required">
                                    City
                                </label>
                                <select name="" id="ddlCitylist" class="c-select form-control">
                                    <option value="" selected disabled>Select</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class="label-required">
                                    ZIP/Post Code
                                </label>
                                <input type="text" id="txtZipCode" class="form-control" placeholder="Enter ZIP/Post Code">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="">Contact Address</label>
                                <select name="" id="ddlContact" class="c-select form-control">
                                    <option value="">Select</option>
                                </select>
                            </div>

                            <div class="form-group col-md-10">
                                <label for="" class="blank-label">Address</label>
                                <textarea name="" id="txtPresentAddress" rows="1" class="form-control" placeholder="Enter Contact Address"></textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="">Present Address</label>
                                <select name="" id="ddlContact" class="c-select form-control">
                                    <option value="">Select</option>
                                </select>
                            </div>

                            <div class="form-group col-md-10">
                                <label for="" class="blank-label">Address</label>
                                <textarea name="" id="txtPresentAddress" rows="1" class="form-control" placeholder="Enter Present Address"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="">Permanent Address</label>
                                <select name="" id="txtPresentAddress" class="c-select form-control">
                                    <option value="">Select</option>
                                </select>
                            </div>

                            <div class="form-group col-md-10">
                                <label for="" class="blank-label">Address</label>
                                <textarea name="" id="ddlPermanent" rows="1" class="form-control" placeholder="Enter Permanent Address"></textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="">TIN (if any)</label>
                                <input type="text" id="txtTin" class="form-control" placeholder="TIN (optional)">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="" class="label-required">Mobile</label>
                                <input type="text" id="txtMobileNumber" class="form-control" placeholder="Primary Mobile Number">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class="label">Secondary Mobile(Optional)</label>
                                <input type="text" id="txtMobileNumber" class="form-control" placeholder="Primary Mobile Number">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="" class="label">Email Address</label>
                                <input type="email" id="txtEmailAddress" class="form-control" placeholder="Primary Mobile Number">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class="label">Email Address(Optional)</label>
                                <input type="email" id="txtSecondaryEmailAddress" class="form-control" placeholder="Primary Mobile Number">
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Section 3 -->
            <div class="accordion-item">
                <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <span class="fas fa-university"></span> Bank Information (1st Applicant)
                    </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="" class="label-required">Bank</label>
                                <select name="" id="ddlBanklist" class="c-select form-control">
                                    <option value="" selected disabled>Select</option>
                                    <option value="">Brank Bank</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class="label-required">Bank Branch</label>
                                <select name="" id="ddlBanklist" class="c-select form-control">
                                    <option value="" selected disabled>Select</option>
                                    <option value="">Brank Bank</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="" class="label-required">Account Number</label>
                                <input type="text" id="txtAccountNumber" class="form-control" placeholder="Enter Your Acoount Number">
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Section 4 -->
            <div class="accordion-item">
                <div class="card">
                <div class="card-header" id="headingFour">
                    <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <span class="fas fa-user-friends"></span> Nominee Information
                    </button>
                    </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="">Nominee Name</label>
                                <input type="text" id="txtNomineeName" class="form-control" placeholder="Nominee Name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Relationship with Investor</label>
                                <select name="" id="ddlRelationship" class="c-select form-control">
                                    <option value="" disabled selected>Select Relationship</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="block" for="">Date Of Birth</label>
                                <select name="" class="c-select form-control" id="ddlpassportissuebDay">
                                    <option value="" selected disabled>Day</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                                <select name="" class="c-select form-control" id="ddlpassportissuebMonth">
                                    <option value="" selected disabled>Month</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                                <select name="" class="c-select form-control" id="ddlpassportissuebYear">
                                    <option value="" selected disabled>Month</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">NID/Passport</label>
                                <input type="text" id="txtNomineeNidPassport" class="form-control" name="nid/pass" placeholder="Nominee NID or Passport">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="">Contact Address</label>
                                <input type="text" id="txtNomineeContactAddress" class="form-control" placeholder="Nominee Contact Address">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="" class="label-required">Mobile Number</label>
                                <input type="text" id="txtNomineeMobile" class="form-control" placeholder="Nominee Mobile Number">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class="label">Email Address</label>
                                <input type="email" id="txtNomineeEmail" class="form-control" placeholder="Nominee Email Address">
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- Section 5 -->
            <div class="accordion-item">
                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            <span class="fas fa-file-signature"></span> Power of Attorney Information (optional)
                        </button>
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">POA Name</label>
                                    <input type="text" name="" id="txtPoaName" class="form-control" placeholder="Power of Attorney Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Relationship with Investor</label>
                                    <select name="" id="ddlRelationshipPoa" class="c-select form-control">
                                        <option value="" selected disabled>Select Relationhip</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" class="block">Date Of Birth</label>
                                    <select name="" class="c-select form-control" id="ddlpassportissuebDay">
                                        <option value="" selected disabled>Day</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                    <select name="" class="c-select form-control" id="ddlpassportissuebMonth">
                                        <option value="" selected disabled>Month</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                    <select name="" class="c-select form-control" id="ddlpassportissuebYear">
                                        <option value="" selected disabled>Month</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="">NID/Passport</label>
                                    <input type="text" id="txtPoaNidPassport" class="form-control" placeholder="Power of Attorney NID/Pssport">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="">Contact Address</label>
                                    <input type="text" id="txtPoaContactAddress" class="form-control" placeholder="Power of Attorney Contact Address">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" class="label-required">Mobile Number</label>
                                    <input type="text" id="txtPoaMobileNumber" class="form-control" placeholder="Power of Attorney Mobile Number">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Email Address</label>
                                    <input type="email" id="txtPoaEmailAddress" class="form-control" placeholder="Power of Attorney Email Address">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="" class="block">Effective Date From</label>
                                    <select name="" class="c-select form-control" id="ddlpassportissuebDay">
                                        <option value="" selected disabled>Day</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                    <select name="" class="c-select form-control" id="ddlpassportissuebMonth">
                                        <option value="" selected disabled>Month</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                    <select name="" class="c-select form-control" id="ddlpassportissuebYear">
                                        <option value="" selected disabled>Month</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-1">
                                    <label for="">.</label>
                                    <input type="text" class="form-control text-center" name="" value="TO">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" class="block">Effective Date From</label>
                                    <select name="" class="c-select form-control" id="ddlpassportissuebDay">
                                        <option value="" selected disabled>Day</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                    <select name="" class="c-select form-control" id="ddlpassportissuebMonth">
                                        <option value="" selected disabled>Month</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                    <select name="" class="c-select form-control" id="ddlpassportissuebYear">
                                        <option value="" selected disabled>Month</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>

            <div class="btn-submit-container">
            <button type="submit" class="btn btn-primary btn-submit">Submit</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
