<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BO Form | Anc Securities</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <style>
    body {
      background-image: url(http://www.wallpapersxl.com/wallpapers/1366x768/light-blue/254930/light-blue-landscape-opal-lake-254930.jpg);
      background-size: cover;
      background-position: 50% 0;
      background-repeat: no-repeat;
      min-height: 100vh;
    }

    .card-like {
      margin-top: 50px;
      margin-bottom: 50px;
      color: rgba(0,0,0,0.8);
      background-color: #fff;
      border-radius: 6px;
      padding: 50px;
      box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }

    .btn-irv {
      width: 100%;
      background: #038dab;
      color: #fff!important;
      font-weight: bold;
      padding: 10px 0;
      transition: all 0.3s;
    }

    .btn-irv:hover {
      background: #02738d;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
    }

    .btn-irv-default {
      font-weight: bold;
      background: #bbb;
      color: #fff!important;
    }

    .btn-irv-default:hover {
      background: #aaa;
    }

    .wizard {
      overflow: hidden;
    }

    .wizard-header {
      margin-bottom: 30px;
    }

    .wizard-header h1 {
      margin-top: 0;
      margin-bottom: 20px;
    }

    .wizard-header h1 small {
      color: #bbb;
    }

    .wizard-header hr {
      border-color: #038dab;
      border-top-width: 2px;
    }

    .wizard-header .steps {
      height: 15px;
    }

    .wizard-header .steps .wizard-step {
      background: #038dab;
      width: 15px;
      height: 15px;
      display: inline-block;
      margin: 0 10px;
      opacity: 0.2;
      border-radius: 50%;
      transition: all 0.8s;
    }

    .wizard-header .steps .wizard-step.active {
      opacity: 1;
    }

    .wizard-body {
      position: relative;
      transition: all 0.3s cubic-bezier(0.68, -0.30, 0.37, 0.6);
    }

    .wizard-body .step {
      transition: all 0.3s ease-in-out;
      position: absolute;
      width: 100%;
      top: 0;
      right: -100%;
      opacity: 0;
    }

    .wizard-body .step.initial {
      position: relative;
    }

    .wizard-body .step.off {
      opacity: 0!important;
      right: 100%!important;
    }

    .wizard-body .step.active {
      right: 0;
      margin-left: 0;
      margin-top: 0;
      opacity: 1;
      transition: all 0.4s linear;
      transition-delay: 0.1s;
    }

    .wizard-footer {
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <div class="wizard card-like">
          <form action="#">
            <div class="wizard-header">
              <div class="row">
                <div class="col-xs-12">
                    <div>
                        <img style="width: 100px;margin-left: auto;margin-right: auto;display: block;height: 100px;" src="{{ asset('auth/ANCSECURITIES.png') }}" alt="">
                    </div>
                    <div class="mt-3 mb-3">
                        <h4 class="text-danger text-center">পুজিবাজার ঝুকিপূর্ণ । জেনে ও বুঝে বিনিয়োগ করবেন।</h4>
                        <br>
                        <h4 class="text-center" style="color: #000; font-weight:600;">নতুন বিও আবেদন (New BO Application)</h4>
                        <h4 class="text-center" style="color: #000; font-weight:600;">ডিপি ও বিও টাইপ নির্বাচন (Select DP & BO type)</h4>
                    </div>
                  <hr />
                  <div class="steps text-center">
                    <div class="wizard-step active"></div>
                    <div class="wizard-step"></div>
                    <div class="wizard-step"></div>
                    <div class="wizard-step"></div>
                    <div class="wizard-step"></div>
                    <div class="wizard-step"></div>
                    <div class="wizard-step"></div>
                    <div class="wizard-step"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="wizard-body">
              <div class="step initial active">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="dpType">Choose DP <span class="text-danger">*</span></label>
                      <select class="form-control" id="dpType">
                        <option value="NSDL">NSDL</option>
                        <option value="CDSL">CDSL</option>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">BO option <span class="text-danger">*</span> </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="boOption" id="newBo">
                                <label class="form-check-label" for="newBo">
                                    New BO
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="boOption" id="linkBo">
                                <label class="form-check-label" for="linkBo">
                                    Link BO
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Residency <span class="text-danger">*</span> </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="residency" id="residentRb">
                                <label class="form-check-label" for="residentRb">
                                    Resident in Bangladesh (RB)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="residency" id="nonResidentNrb">
                                <label class="form-check-label" for="nonResidentNrb">
                                    Non-Res in Bangladesh (NRB)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">BO Type <span class="text-danger">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="boType" id="individual">
                                <label class="form-check-label" for="individual">
                                    Individual
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="boType" id="joint">
                                <label class="form-check-label" for="joint">
                                    Joint
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
              </div>

              <div class="step">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for=""><span class="text-danger"> * </span>Type of NID(Optional for NRB)</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="nidType" id="10DigitNid">
                                <label class="form-check-label" for="10DigitNid">
                                    10 Digit (Smartcard)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="nidType" id="17DigitNid">
                                <label class="form-check-label" for="17DigitNid">
                                    17 Digit (Old NID)
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Enter First Holder NID No.(optional for NRB)</label>
                            <span style="cursor:pointer;" class="badge badge-pill badge-primary" data-toggle="modal" data-target="#nidhelp">Help ?</span>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="firstname">Your name: <span class="fw-bold">(As per NID)</span></label>
                        <input type="text" class="form-control" id="firstname">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="lastname">Passport Number:</label>
                        <input type="text" class="form-control" id="lastname">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="lastname">Husband/Father Name:</label>
                        <input type="text" class="form-control" id="lastname">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="lastname">Issue place of passport:</label>
                        <input type="text" class="form-control" id="lastname">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="lastname">Mother Name:</label>
                        <input type="text" class="form-control" id="lastname">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="lastname">Issue date of passport :</label>
                        <input type="date" class="form-control" id="lastname">
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="email">Date of Birth: <span class="fw-blod">(As per NID)</span></label>
                      <input type="date" class="form-control" id="email">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="phone">Expiry Date of Passport:</label>
                      <input type="date" class="form-control" id="phone">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="phone">Sex:</label>
                      <select name="" id="" class="form-control">
                        <option value="" selected disabled>Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="step">

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="gender">Citizen/Resident Of:</label>
                      <select class="form-control">
                        <option value="" selected disabled>Select</option>
                        <option value="Male">Bangladesh</option>
                        <option value="Female">India</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="occupation">Occupation:</label>
                      <input type="text" class="form-control" id="occupation">
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="gender">Statement Cycle:</label>
                      <select class="form-control">
                        <option value="" selected disabled>Select</option>
                        <option value="Male">Bangladesh</option>
                        <option value="Female">India</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="income">TIN:</label>
                      <input type="text" class="form-control" id="income">
                    </div>
                  </div>
                </div>

              </div>

              <div class="step">
                <div class="row">

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="addressLine1">Address Line 1:</label>
                      <input type="text" class="form-control" id="addressLine1">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="addressLine2">Address Line 2(optional):</label>
                      <input type="text" class="form-control" id="addressLine2">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="city">City:</label>
                      <input type="text" class="form-control" id="city">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="state">State/Division:</label>
                      <input type="text" class="form-control" id="state">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="zipcode">Postal/Zip Code:</label>
                      <input type="text" class="form-control" id="zipcode">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="country">Country:</label>
                      <input type="text" class="form-control" id="country">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="country">Phone:</label>
                      <input type="text" class="form-control" id="country">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="country">Email:</label>
                      <input type="text" class="form-control" id="country">
                    </div>
                  </div>
                </div>
              </div>

              <div class="step">
                <div class="row">

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="bankName">Routing Number:</label>
                      <input type="text" class="form-control" id="routingNumber" placeholder="Enter your 9 digit routing number...">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="bankName">Bank Name:</label>
                      <input type="text" class="form-control" id="bankName">
                    </div>
                  </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="branchName">Branch Name:</label>
                        <input type="text" class="form-control" id="branchName">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="ifscCode">District Name:</label>
                        <input type="text" class="form-control" id="ifscCode">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                        <label for="accountNumber">Account Number:</label>
                        <input type="text" class="form-control" id="accountNumber" placeholder="Enter your 13 digit bank a/c number">
                        </div>
                    </div>
                </div>
              </div>

              <div class="step">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="nomineeName">Nominee Name:</label>
                      <input type="text" class="form-control" id="nomineeName">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="nomineeRelation">Nominee Relation:</label>
                      <input type="text" class="form-control" id="nomineeRelation">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="nomineeDob">Nominee Date of Birth:</label>
                      <input type="date" class="form-control" id="nomineeDob">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="nomineeShare">Nominee Share (%):</label>
                      <input type="text" class="form-control" id="nomineeShare">
                    </div>
                  </div>
                </div>
              </div>
              <div class="step">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="uploadPhoto">Upload Photo:</label>
                      <input type="file" class="form-control" id="uploadPhoto">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="uploadSignature">Upload Signature:</label>
                      <input type="file" class="form-control" id="uploadSignature">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="uploadPan">Upload PAN Card:</label>
                      <input type="file" class="form-control" id="uploadPan">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="uploadAadhar">Upload Aadhar Card:</label>
                      <input type="file" class="form-control" id="uploadAadhar">
                    </div>
                  </div>
                </div>
              </div>
              <div class="step">
                <div class="row">
                  <div class="col-sm-12 text-center">
                    <h3>Review and Finish</h3>
                    <p>Please review all the information you have provided. Once you are sure everything is correct, click the "Submit" button below to complete the process.</p>
                    <button id="wizard-subm" type="button" class="btn btn-irv">Submit</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="wizard-footer">
              <div class="row">
                <div class="col-xs-6 pull-left block-center">
                  <button id="wizard-prev" style="display:none" type="button" class="btn btn-irv btn-irv-default">
                    Previous
                  </button>
                </div>
                <div class="col-xs-6 pull-right text-center">
                  <button id="wizard-next" type="button" class="btn btn-irv">
                    Next
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

    <div class="modal fade" id="nidhelp" tabindex="-1" aria-labelledby="nidhelpLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="nidhelpLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        const checkButtons = (activeStep, stepsCount) => {
        const prevBtn = $("#wizard-prev");
        const nextBtn = $("#wizard-next");
        const submBtn = $("#wizard-subm");

        switch (activeStep) {
            case 0: // First Step
            prevBtn.hide();
            submBtn.hide();
            nextBtn.show();
            break;
            case stepsCount: // Last Step
            nextBtn.hide();
            prevBtn.show();
            submBtn.show();
            break;
            default:
            submBtn.hide();
            prevBtn.show();
            nextBtn.show();
        }
        };

        const setWizardHeight = activeStepHeight => {
        $(".wizard-body").height(activeStepHeight);
        };

        $(function() {
        const wizardSteps = $(".wizard-header .wizard-step");
        const steps = $(".wizard-body .step");
        const stepsCount = steps.length - 1;
        let activeStep = 0;
        let activeStepHeight = $(steps[activeStep]).height();

        checkButtons(activeStep, stepsCount);
        setWizardHeight(activeStepHeight);

        $(window).resize(function() {
            setWizardHeight($(steps[activeStep]).height());
        });

        $("#wizard-prev").click(() => {
            $(steps[activeStep]).removeClass("active");
            $(wizardSteps[activeStep]).removeClass("active");

            activeStep--;

            $(steps[activeStep]).removeClass("off").addClass("active");
            $(wizardSteps[activeStep]).addClass("active");

            activeStepHeight = $(steps[activeStep]).height();
            setWizardHeight(activeStepHeight);
            checkButtons(activeStep, stepsCount);
        });

        $("#wizard-next").click(() => {
            $(steps[activeStep]).removeClass("initial").addClass("off").removeClass("active");
            $(wizardSteps[activeStep]).removeClass("active");

            activeStep++;

            $(steps[activeStep]).addClass("active");
            $(wizardSteps[activeStep]).addClass("active");

            activeStepHeight = $(steps[activeStep]).height();
            setWizardHeight(activeStepHeight);
            checkButtons(activeStep, stepsCount);
        });
        });
    </script>
</body>
</html>
