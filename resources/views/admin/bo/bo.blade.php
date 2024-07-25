<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BO Account Form | ANC Securities Ltd</title>
    <link rel="shortcut icon" href="{{ asset('user/assets/logos/8022322.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bo.css') }}">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Account Holder</div>
                    <div class="card-body">
                        <!-- Step wizard -->
                        <div id="step-wizard">
                            <!-- Step 1 Content -->
                            <div id="step-1" class="step-content active">
                                <form id="step-1-form">

                                    <div class="d-flex justify-content-between">
                                        <div class="form-group">
                                            <label for="field1">BO Type:</label> <br>
                                            <input type="radio" id="new_bo" name="bo_type" checked> New BO
                                            <input type="radio" id="link_bo" name="bo_type"> Link BO
                                        </div>
                                        <div class="form-group" style="display: none;" id="form_bo_id">
                                            <label for="">BOID <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="card mt-4">
                                        <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header rounded-0">
                                            <h4 class="card-title mb-0">First A/C Holder</h4>
                                        </div>
                                        <div class="row p-3">
                                            <div class="col-md-3 mb-2">
                                                <p class="required">
                                                    <b>Type of Client</b>
                                                </p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" checked="checked" name="type_of_client" type="radio">
                                                    <label for="type_of_client_Individual" class="form-check-label">Individual</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" checked="checked" name="type_of_client" id="type_of_client" type="radio">
                                                    <label for="type_of_client_Individual" class="form-check-label">Joint</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="first_acc_courtesy_title" class="form-label required">
                                                    Courtesy Title <span>*</span>
                                                </label>
                                                <select name="" id="" class="form-control">
                                                    <option selected="selected" value="">Select</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Mrs">Mrs</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Dr">Dr</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="firstname" class="form-label required">First Name</label>
                                                <input class="form-control" maxlength="100" placeholder="Enter First Name" name="firstname" type="text" id="firstname">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="lastname" class="form-label required">Last Name</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Last Name" name="lastname" type="text" id="lastname">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="occupation" class="form-label required">Occupation</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Occupation" name="occupation" type="text" id="occupation">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="date_of_birth" class="form-label required">Date of Birth (YYYY-MM-DD)</label>
                                                <div class="flatpickr">
                                                    <input class="form-control birthdate" placeholder="Enter Date of Birth" id="date_of_birth" aria-label="date_of_birth" aria-describedby="date_of_birth-addon" autocomplete="off" name="date_of_birth" type="text">
                                                    <a class="input-button" title="toggle" data-toggle>
                                                        <i class="icon-calendar"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="father_name" class="form-label required">Father&#039;s Name</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Father Name" name="father_name" type="text" id="father_name">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="mother_name" class="form-label required">Mother&#039;s Name</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Mother Name" name="mother_name" type="text" id="mother_name">
                                            </div>

                                            <div class="col-md-12 mb-2">
                                                <label for="address_line_1" class="form-label required">Address Line 1</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 1" name="address_line_1" type="text" id="address_line_1">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label for="address_line_2" class="form-label">Address Line 2</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 2" name="address_line_2" type="text" id="address_line_2">
                                            </div>    <div class="col-md-6 mb-2">
                                                <label for="address_line_3" class="form-label">Address Line 3</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 3" name="address_line_3" type="text" id="address_line_3">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="city" class="form-label required">City</label>
                                                <input class="form-control" maxlength="25" placeholder="Enter City" name="city" type="text" id="city">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="post_code" class="form-label required">Post Code</label>
                                                <input class="form-control" maxlength="10" placeholder="Enter Post Code" name="post_code" type="text" id="post_code">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="division" class="form-label required">District</label>
                                                <input class="form-control" maxlength="25" placeholder="Enter District" name="division" type="text" id="division">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="fisrt_acc_country" class="form-label required">Country</label>
                                                <select class="form-control select2" id="fisrt_acc_country" maxlength="25" name="country"><option selected="selected" value="">Select Country</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Antarctica">Antarctica</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Azerbaijan">Azerbaijan</option><option value="Argentina">Argentina</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Armenia">Armenia</option><option value="Barbados">Barbados</option><option value="Belgium">Belgium</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="Belize">Belize</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Solomon Islands">Solomon Islands</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Myanmar">Myanmar</option><option value="Burundi">Burundi</option><option value="Belarus">Belarus</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Sri Lanka">Sri Lanka</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Taiwan, Province of China">Taiwan, Province of China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling); Islands">Cocos (Keeling); Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Mayotte">Mayotte</option><option value="Congo">Congo</option><option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Benin">Benin</option><option value="Denmark">Denmark</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Ethiopia">Ethiopia</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Faroe Islands">Faroe Islands</option><option value="Falkland Islands (Malvinas);">Falkland Islands (Malvinas);</option><option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="Aland Islands">Aland Islands</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Djibouti">Djibouti</option><option value="Gabon">Gabon</option><option value="Georgia">Georgia</option><option value="Gambia">Gambia</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Kiribati">Kiribati</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option><option value="Holy See (Vatican City State);">Holy See (Vatican City State);</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Côte d&#039;Ivoire">Côte d&#039;Ivoire</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Kazakhstan">Kazakhstan</option><option value="Jordan">Jordan</option><option value="Kenya">Kenya</option><option value="Korea, Democratic People&#039;s Republic of">Korea, Democratic People&#039;s Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People&#039;s Democratic Republic">Lao People&#039;s Democratic Republic</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Latvia">Latvia</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Moldova">Moldova</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Oman">Oman</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="Aruba">Aruba</option><option value="New Caledonia">New Caledonia</option><option value="Vanuatu">Vanuatu</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Norway">Norway</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Marshall Islands">Marshall Islands</option><option value="Palau">Palau</option><option value="Pakistan">Pakistan</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Timor-Leste">Timor-Leste</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Réunion">Réunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Barthélemy">Saint Barthélemy</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Anguilla">Anguilla</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Martin (French part);">Saint Martin (French part);</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia[5]">Serbia[5]</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Viet Nam">Viet Nam</option><option value="Slovenia">Slovenia</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="Zimbabwe">Zimbabwe</option><option value="Spain">Spain</option><option value="Western Sahara">Western Sahara</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Tajikistan">Tajikistan</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="United Arab Emirates">United Arab Emirates</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option><option value="Egypt">Egypt</option><option value="United Kingdom">United Kingdom</option><option value="Guernsey">Guernsey</option><option value="Jersey">Jersey</option><option value="Isle of Man">Isle of Man</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="United States">United States</option><option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option><option value="Burkina Faso">Burkina Faso</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Venezuela">Venezuela</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Samoa">Samoa</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option></select>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="mobile" class="form-label required">Mobile</label>
                                                <input class="form-control" maxlength="20" placeholder="Enter Mobile" name="mobile" type="text" id="mobile">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="email" class="form-label required">Email</label>
                                                <input class="form-control" maxlength="80" placeholder="Enter Email Address" name="email" type="email" id="email">
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
                                                <label for="nationality" class="form-label required">Nationality</label>
                                                <input class="form-control" maxlength="50" placeholder="Enter Nationality" name="nationality" type="text" value="Bangladeshi" id="nationality">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="nid" class="form-label required">National ID</label>
                                                <input class="form-control" minlength="10" maxlength="20" placeholder="Enter National Identity Card Number" name="nid" type="text" id="nid">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="tin" class="form-label">Tax Identification Number (TIN)</label>
                                                <input class="form-control" placeholder="Enter Tax Identification Number (TIN)" name="tin" type="text" id="tin">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="branch" class="form-label required">Broker Branch</label>
                                                <select class="form-control select2" id="branch" name="branch">
                                                    <option value=""> Select </option>
                                                    <option value="Head Office" selected="selected">Head Office</option>
                                                    <option value="Khatungonj">Khatungonj</option>
                                                    <option value="MJL">Motijheel</option>
                                                    <option value="Singapore Branch">Singapore Branch</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 my-3">
                                                <p class="required"><b>Residential Status</b></p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="residency_Resident" checked="checked" name="residency" type="radio" value="Resident">
                                                    <label for="residency_Resident" class="form-check-label">Resident</label>
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
                                                <p class="required"><b>Gender</b></p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="gender_Male" checked="checked" name="gender" type="radio" value="Male">
                                                    <label for="gender_Male" class="form-check-label">Male</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" id="gender_Female" name="gender" type="radio" value="Female">
                                                    <label for="gender_Female" class="form-check-label">Female</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <div class="view-profile-card-header p-3 rounded-2" role="alert">
                                                        Whether the applicant is an officer or Director or Authorized
                                                        Representative of any Stock Exchange/Listed Company/Brokerage Firm
                                                        <div class="form-check form-switch form-switch-lg switch" dir="ltr">
                                                            <input name="is_director" type="checkbox" class="form-check-input" id="is_director">
                                                            <label class="form-check-label" for="is_director"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2 director_company" style="display:none">
                                                    <label for="director_company" class="form-label">If yes Name of The Stock Exchange/Listed Company/Brokerage Firm:</label>
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
                                                <label for="joint_courtesy_title" class="form-label required">Courtesy Title</label>
                                                <select class="form-control select2" maxlength="10" id="joint_courtesy_title" name="joint_courtesy_title"><option selected="selected" value="">Select</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Ms">Ms</option><option value="Dr">Dr</option></select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="joint_firstname" class="form-label required">First Name</label>
                                                <input class="form-control" maxlength="100" placeholder="Enter First Name" name="joint_firstname" type="text" id="joint_firstname">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_lastname" class="form-label required">Last Name</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Last Name" name="joint_lastname" type="text" id="joint_lastname">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_occupation" class="form-label required">Occupation</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Occupation" name="joint_occupation" type="text" id="joint_occupation">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_date_of_birth" class="form-label required">Date of Birth (YYYY-MM-DD)</label>
                                                <div class="flatpicker">
                                                    <input class="form-control birthdate" placeholder="Enter Date of Birth" id="joint_date_of_birth" aria-label="joint_date_of_birth" aria-describedby="joint_date_of_birth-addon" autocomplete="off" name="joint_date_of_birth" type="text">
                                                    <a class="input-button" title="toggle" data-toggle>
                                                        <i class="icon-calendar"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_father_name" class="form-label required">Father&#039;s Name</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Father Name" name="joint_father_name" type="text" id="joint_father_name">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_mother_name" class="form-label required">Mother&#039;s Name</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Mother Name" name="joint_mother_name" type="text" id="joint_mother_name">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="joint_nid" class="form-label required">National ID</label>
                                                <input class="form-control" maxlength="20" placeholder="Enter National Identity Card Number" name="joint_nid" type="text" id="joint_nid">
                                            </div>

                                            <div class="col-md-12 mb-2">
                                                <label for="joint_address_line_1" class="form-label required">Address Line 1</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 1" name="joint_address_line_1" type="text" id="joint_address_line_1">
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
                                                <label for="joint_city" class="form-label required">City</label>
                                                <input class="form-control" maxlength="25" placeholder="Enter City" name="joint_city" type="text" id="joint_city">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="joint_post_code" class="form-label required">Post Code</label>
                                                <input class="form-control" maxlength="10" placeholder="Enter Post Code" name="joint_post_code" type="text" id="joint_post_code">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_division" class="form-label required">District</label>
                                                <input class="form-control" maxlength="25" placeholder="Enter District" name="joint_division" type="text" id="joint_division">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_country" class="form-label required">Country</label>
                                                <select class="form-control select2" id="joint_country" name="joint_country"><option selected="selected" value="">Select Country</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Antarctica">Antarctica</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Azerbaijan">Azerbaijan</option><option value="Argentina">Argentina</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Armenia">Armenia</option><option value="Barbados">Barbados</option><option value="Belgium">Belgium</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="Belize">Belize</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Solomon Islands">Solomon Islands</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Myanmar">Myanmar</option><option value="Burundi">Burundi</option><option value="Belarus">Belarus</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Sri Lanka">Sri Lanka</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Taiwan, Province of China">Taiwan, Province of China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling); Islands">Cocos (Keeling); Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Mayotte">Mayotte</option><option value="Congo">Congo</option><option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Benin">Benin</option><option value="Denmark">Denmark</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Ethiopia">Ethiopia</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Faroe Islands">Faroe Islands</option><option value="Falkland Islands (Malvinas);">Falkland Islands (Malvinas);</option><option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="Aland Islands">Aland Islands</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Djibouti">Djibouti</option><option value="Gabon">Gabon</option><option value="Georgia">Georgia</option><option value="Gambia">Gambia</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Kiribati">Kiribati</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option><option value="Holy See (Vatican City State);">Holy See (Vatican City State);</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Côte d&#039;Ivoire">Côte d&#039;Ivoire</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Kazakhstan">Kazakhstan</option><option value="Jordan">Jordan</option><option value="Kenya">Kenya</option><option value="Korea, Democratic People&#039;s Republic of">Korea, Democratic People&#039;s Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People&#039;s Democratic Republic">Lao People&#039;s Democratic Republic</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Latvia">Latvia</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Moldova">Moldova</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Oman">Oman</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="Aruba">Aruba</option><option value="New Caledonia">New Caledonia</option><option value="Vanuatu">Vanuatu</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Norway">Norway</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Marshall Islands">Marshall Islands</option><option value="Palau">Palau</option><option value="Pakistan">Pakistan</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Timor-Leste">Timor-Leste</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Réunion">Réunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Barthélemy">Saint Barthélemy</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Anguilla">Anguilla</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Martin (French part);">Saint Martin (French part);</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia[5]">Serbia[5]</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Viet Nam">Viet Nam</option><option value="Slovenia">Slovenia</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="Zimbabwe">Zimbabwe</option><option value="Spain">Spain</option><option value="Western Sahara">Western Sahara</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Tajikistan">Tajikistan</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="United Arab Emirates">United Arab Emirates</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option><option value="Egypt">Egypt</option><option value="United Kingdom">United Kingdom</option><option value="Guernsey">Guernsey</option><option value="Jersey">Jersey</option><option value="Isle of Man">Isle of Man</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="United States">United States</option><option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option><option value="Burkina Faso">Burkina Faso</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Venezuela">Venezuela</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Samoa">Samoa</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option></select>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_email" class="form-label required">Email</label>
                                                <input class="form-control" maxlength="80" placeholder="Enter Email Address" name="joint_email" type="email" id="joint_email">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="joint_mobile" class="form-label required">Mobile</label>
                                                <input class="form-control" maxlength="20" placeholder="Enter Mobile Number" name="joint_mobile" type="text" id="joint_mobile">
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

                                    <button type="button" class="btn btn-primary next-step mt-4">Next & Continue</button>
                                </form>
                            </div>

                            <!-- Step 2 Content -->
                            <div id="step-2" class="step-content">

                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between view-profile-card-header">
                                        <h4 class="card-title mb-0">Bank Information</h4>
                                    </div>
                                </div>

                                <form id="step-2-form">

                                    <div class="row p-2 pt-3">

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <input name="user_id" type="hidden" value="95">
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="bank_id" class="form-label required">Bank Name</label>
                                                <select class="form-control select2" id="bank_id" name="bank_id"><option selected="selected" value="">Select Bank Name</option><option value="1">AB Bank Limited</option><option value="2">Agrani Bank Limited</option><option value="3">Al - Arafah Islami Bank Limited</option><option value="4">Bangladesh Commerce Bank Limited</option><option value="5">Bangladesh Development Bank Limited</option><option value="6">Bangladesh Krishi Bank</option><option value="7">BASIC Bank Limited</option><option value="8">Bank Alfalah Limited</option><option value="9">Bank Asia Limited</option><option value="10">BRAC Bank Limited</option><option value="11">Citibank N . A</option><option value="12">Commercial Bank of Ceylon Limited</option><option value="13">Dhaka Bank Limited</option><option value="14">Dutch - Bangla Bank Limited</option><option value="15">EBL - Eastern Bank Limited</option><option value="16">EXIM - Export Import Bank of Bangladesh Limited</option><option value="17">FSIBL - First Security Islami Bank Limited</option><option value="18">Habib Bank Limited</option><option value="19">ICB Islamic Bank Limited</option><option value="20">IFIC - International Finance Invest and Commerce Bank Limited</option><option value="21">Islami Bank Bangladesh Limited</option><option value="22">Jamuna Bank Limited</option><option value="23">Janata Bank Limited</option><option value="24">Meghna Bank Limited</option><option value="25">Mercantile Bank Limited</option><option value="26">Midland Bank Limited</option><option value="27">Modhumoti Bank Limited</option><option value="28">Mutual Trust Bank Limited</option><option value="29">National Bank Limited</option><option value="30">National Bank of Pakistan</option><option value="31">NCC - National Credit &amp; Commerce Bank Limited</option><option value="32">NRB Bank Limited</option><option value="33">NRB Commercial Bank Limited</option><option value="34">Global Islami Bank Limited</option><option value="35">One Bank Limited</option><option value="36">Padma Bank Limited</option><option value="37">Prime Bank Limited</option><option value="38">Pubali Bank Limited</option><option value="39">Rupali Bank Limited</option><option value="40">Rajshahi Krishi Unnayan Bank</option><option value="41">Shahjalal Islami Bank Limited</option><option value="42">Social Islami Bank Limited</option><option value="43">Sonali Bank Limited</option><option value="44">SBAC - South Bangla Agriculture &amp; Commerce Bank Limited</option><option value="45">Southeast Bank Limited</option><option value="46">Standard Bank Limited</option><option value="47">SCB - Standard Chartered Bank</option><option value="48">State Bank of India</option><option value="49">Shimanto Bank Limited</option><option value="50">The City Bank Limited</option><option value="51">HSBC - The Hongkong and Shanghai Banking Corporation Limited</option><option value="52">The Premier Bank Limited</option><option value="53">Trust Bank Limited</option><option value="54">Union Bank Limited</option><option value="55">UCBL - United Commercial Bank Limited</option><option value="56">Uttara Bank Limited</option><option value="57">Woori Bank Bangladesh</option><option value="59">COMMUNITY BANK BANGLADESH LTD</option></select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="branch_id" class="form-label required">Bank Branch</label>
                                                <select class="form-control select2" id="branch_id" name="branch_id"><option selected="selected" value="">Select Branch</option></select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="district_name" class="form-label required">Bank District</label>
                                                <input class="form-control" placeholder="Enter Bank District Name" name="district_name" type="text" id="district_name">
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label for="account_number" class="form-label required">Bank A/C Number</label>
                                                <input class="form-control" placeholder="Enter Bank Account Number" name="account_number" type="text" id="account_number">
                                                <i class="help-text">** Bank AC must be 13 digits</i>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                    <button type="button" class="btn btn-secondary prev-step">Back</button>
                                </form>
                            </div>

                            <!-- Step 3 Content -->
                            <div id="step-3" class="step-content">
                                <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                    <h4 class="card-title mb-0">Authorize</h4>
                                </div>
                                <form id="step-3-form">
                                    <div class="card-body">
                                        <div class="row p-3">

                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <input name="user_id" type="hidden" value="95">
                                                                    </div>
                                            </div>


                                            <div class="col-md-3 mb-2">
                                                <label for="auth_courtesy_title" class="form-label required">Courtesy Title</label>
                                                <select class="form-control select2" id="auth_courtesy_title" maxlength="10" name="courtesy_title"><option selected="selected" value="">Select</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Ms">Ms</option><option value="Dr">Dr</option></select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="firstname" class="form-label required">First Name</label>
                                                <input class="form-control" maxlength="100" placeholder="Enter First Name" name="firstname" type="text" id="firstname">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="lastname" class="form-label required">Last Name</label>
                                                <input class="form-control" maxlength="100" placeholder="Enter Last Name" name="lastname" type="text" id="lastname">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="occupation" class="form-label required">Occupation</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Occupation" name="occupation" type="text" id="occupation">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="date_of_birth" class="form-label required">Date of Birth (YYYY-MM-DD)</label>
                                                <div class="flatpickr">
                                                    <input class="form-control birthdate" placeholder="Enter Date of Birth" id="date_of_birth" aria-label="date_of_birth" aria-describedby="date_of_birth-addon" autocomplete="off" name="date_of_birth" type="text">
                                                    <a class="input-button" title="toggle" data-toggle>
                                                        <i class="icon-calendar"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="nid" class="form-label required">NID</label>
                                                <input class="form-control" minlength="10" maxlength="20" placeholder="Enter NID" name="nid" type="text" id="nid">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="father_name" class="form-label required">Father&#039;s Name</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Father Name" name="father_name" type="text" id="father_name">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="mother_name" class="form-label required">Mother&#039;s Name</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Mother Name" name="mother_name" type="text" id="mother_name">
                                            </div>

                                            <div class="col-md-12 mb-2">
                                                <label for="address_line_1" class="form-label required">Address Line 1</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 1" name="address_line_1" type="text" id="address_line_1">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label for="address_line_2" class="form-label">Address Line 2</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 2" name="address_line_2" type="text" id="address_line_2">
                                            </div>    <div class="col-md-6 mb-2">
                                                <label for="address_line_3" class="form-label">Address Line 3</label>
                                                <input class="form-control" maxlength="30" placeholder="Enter Address Line 3" name="address_line_3" type="text" id="address_line_3">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="city" class="form-label required">City</label>
                                                <input class="form-control" maxlength="25" placeholder="Enter City" name="city" type="text" id="city">
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label for="post_code" class="form-label required">Post Code</label>
                                                <input class="form-control" maxlength="10" placeholder="Enter Post Code" name="post_code" type="text" id="post_code">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="division" class="form-label required">Division</label>
                                                <input class="form-control" maxlength="25" placeholder="Enter Division" name="division" type="text" id="division">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="auth_country" class="form-label required">Country</label>
                                                <select class="form-control select2" id="auth_country" name="country"><option selected="selected" value="">Select Country</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Antarctica">Antarctica</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Azerbaijan">Azerbaijan</option><option value="Argentina">Argentina</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Armenia">Armenia</option><option value="Barbados">Barbados</option><option value="Belgium">Belgium</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="Belize">Belize</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Solomon Islands">Solomon Islands</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Myanmar">Myanmar</option><option value="Burundi">Burundi</option><option value="Belarus">Belarus</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Sri Lanka">Sri Lanka</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Taiwan, Province of China">Taiwan, Province of China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling); Islands">Cocos (Keeling); Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Mayotte">Mayotte</option><option value="Congo">Congo</option><option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Benin">Benin</option><option value="Denmark">Denmark</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Ethiopia">Ethiopia</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Faroe Islands">Faroe Islands</option><option value="Falkland Islands (Malvinas);">Falkland Islands (Malvinas);</option><option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="Aland Islands">Aland Islands</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Djibouti">Djibouti</option><option value="Gabon">Gabon</option><option value="Georgia">Georgia</option><option value="Gambia">Gambia</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Kiribati">Kiribati</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option><option value="Holy See (Vatican City State);">Holy See (Vatican City State);</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Côte d&#039;Ivoire">Côte d&#039;Ivoire</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Kazakhstan">Kazakhstan</option><option value="Jordan">Jordan</option><option value="Kenya">Kenya</option><option value="Korea, Democratic People&#039;s Republic of">Korea, Democratic People&#039;s Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People&#039;s Democratic Republic">Lao People&#039;s Democratic Republic</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Latvia">Latvia</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Moldova">Moldova</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Oman">Oman</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="Aruba">Aruba</option><option value="New Caledonia">New Caledonia</option><option value="Vanuatu">Vanuatu</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Norway">Norway</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Marshall Islands">Marshall Islands</option><option value="Palau">Palau</option><option value="Pakistan">Pakistan</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Timor-Leste">Timor-Leste</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Réunion">Réunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Barthélemy">Saint Barthélemy</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Anguilla">Anguilla</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Martin (French part);">Saint Martin (French part);</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia[5]">Serbia[5]</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Viet Nam">Viet Nam</option><option value="Slovenia">Slovenia</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="Zimbabwe">Zimbabwe</option><option value="Spain">Spain</option><option value="Western Sahara">Western Sahara</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Tajikistan">Tajikistan</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="United Arab Emirates">United Arab Emirates</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option><option value="Egypt">Egypt</option><option value="United Kingdom">United Kingdom</option><option value="Guernsey">Guernsey</option><option value="Jersey">Jersey</option><option value="Isle of Man">Isle of Man</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="United States">United States</option><option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option><option value="Burkina Faso">Burkina Faso</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Venezuela">Venezuela</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Samoa">Samoa</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option></select>
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="email" class="form-label required">Email</label>
                                                <input class="form-control" maxlength="80" placeholder="Enter Email Address" name="email" type="email" id="email">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="mobile" class="form-label required">Mobile</label>
                                                <input class="form-control" maxlength="20" placeholder="Enter Mobile Number" name="mobile" type="text" id="mobile">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="telephone" class="form-label">Telephone</label>
                                                <input class="form-control" maxlength="20" placeholder="Enter Telephone" name="telephone" type="text" id="telephone">
                                            </div>

                                            <div class="col-md-3 mb-2">
                                                <label for="fax" class="form-label">Fax</label>
                                                <input class="form-control" maxlength="20" placeholder="Enter Fax" name="fax" type="text" id="fax">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary next-step">Next</button>
                                    <button type="button" class="btn btn-secondary prev-step">Back</button>
                                </form>
                            </div>

                            <div id="step-4" class="step-content">
                                <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                    <h4 class="card-title mb-0"> Nominee(s)</h4>
                                </div>
                                <form action="" method="post" id="step-4-form">
                                    <div class="m-3">
                                        <input name="user_id" type="hidden" value="95">
                                    </div>

                                    <div class="card mt-4">
                                        <div>
                                            <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                                <h4 class="card-title mb-0">Nominee 1</h4>
                                            </div>

                                            <div class="row p-3">
                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_courtesy_title" class="form-label required">Courtesy Title</label>
                                                    <select class="form-control select2" maxlength="10" id="nominee_1_courtesy_title" name="nominee_1_courtesy_title"><option selected="selected" value="">Select</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Ms">Ms</option><option value="Dr">Dr</option></select>
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_firstname" class="form-label required">First Name</label>
                                                    <input class="form-control" maxlength="100" placeholder="Enter First Name" name="nominee_1_firstname" type="text" id="nominee_1_firstname">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_lastname" class="form-label required">Last Name</label>
                                                    <input class="form-control" maxlength="100" placeholder="Enter Last Name" name="nominee_1_lastname" type="text" id="nominee_1_lastname">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_relationship" class="form-label required">Relationship</label>
                                                    <input class="form-control" maxlength="100" placeholder="Relationship with A/C Holder" name="nominee_1_relationship" type="text" id="nominee_1_relationship">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_percentage" class="form-label required">Percentage</label>
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
                                                    <label for="nominee_1_date_of_birth" class="form-label required">Date of Birth (YYYY-MM-DD)</label>
                                                    <div class="flatpickr">
                                                        <input class="form-control birthdate" placeholder="Enter Date of Birth" id="nominee_1_date_of_birth" aria-label="date_of_birth" aria-describedby="date_of_birth-addon" autocomplete="off" name="nominee_1_date_of_birth" type="text">
                                                        <a class="input-button" title="toggle" data-toggle>
                                                            <i class="icon-calendar"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_nid" class="form-label required">NID</label>
                                                    <input class="form-control" minlength="10" maxlength="20" placeholder="Enter NID" name="nominee_1_nid" type="text" id="nominee_1_nid">
                                                </div>

                                                <div class="col-md-12 mb-2">
                                                    <label for="nominee_1_address_line_1" class="form-label required">Address Line 1</label>
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
                                                    <label for="nominee_1_city" class="form-label required">City</label>
                                                    <input class="form-control" maxlength="25" placeholder="Enter City" name="nominee_1_city" type="text" id="nominee_1_city">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_post_code" class="form-label required">Post Code</label>
                                                    <input class="form-control" maxlength="10" placeholder="Enter Post Code" name="nominee_1_post_code" type="text" id="nominee_1_post_code">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_division" class="form-label required">Division</label>
                                                    <input class="form-control" maxlength="25" placeholder="Enter Division" name="nominee_1_division" type="text" id="nominee_1_division">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_country" class="form-label required">Country</label>
                                                    <select class="form-control select2" id="nominee_1_country" name="nominee_1_country"><option selected="selected" value="">Select Country</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Antarctica">Antarctica</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Azerbaijan">Azerbaijan</option><option value="Argentina">Argentina</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Armenia">Armenia</option><option value="Barbados">Barbados</option><option value="Belgium">Belgium</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="Belize">Belize</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Solomon Islands">Solomon Islands</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Myanmar">Myanmar</option><option value="Burundi">Burundi</option><option value="Belarus">Belarus</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Sri Lanka">Sri Lanka</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Taiwan, Province of China">Taiwan, Province of China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling); Islands">Cocos (Keeling); Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Mayotte">Mayotte</option><option value="Congo">Congo</option><option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Benin">Benin</option><option value="Denmark">Denmark</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Ethiopia">Ethiopia</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Faroe Islands">Faroe Islands</option><option value="Falkland Islands (Malvinas);">Falkland Islands (Malvinas);</option><option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="Aland Islands">Aland Islands</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Djibouti">Djibouti</option><option value="Gabon">Gabon</option><option value="Georgia">Georgia</option><option value="Gambia">Gambia</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Kiribati">Kiribati</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option><option value="Holy See (Vatican City State);">Holy See (Vatican City State);</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Côte d&#039;Ivoire">Côte d&#039;Ivoire</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Kazakhstan">Kazakhstan</option><option value="Jordan">Jordan</option><option value="Kenya">Kenya</option><option value="Korea, Democratic People&#039;s Republic of">Korea, Democratic People&#039;s Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People&#039;s Democratic Republic">Lao People&#039;s Democratic Republic</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Latvia">Latvia</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Moldova">Moldova</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Oman">Oman</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="Aruba">Aruba</option><option value="New Caledonia">New Caledonia</option><option value="Vanuatu">Vanuatu</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Norway">Norway</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Marshall Islands">Marshall Islands</option><option value="Palau">Palau</option><option value="Pakistan">Pakistan</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Timor-Leste">Timor-Leste</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Réunion">Réunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Barthélemy">Saint Barthélemy</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Anguilla">Anguilla</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Martin (French part);">Saint Martin (French part);</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia[5]">Serbia[5]</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Viet Nam">Viet Nam</option><option value="Slovenia">Slovenia</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="Zimbabwe">Zimbabwe</option><option value="Spain">Spain</option><option value="Western Sahara">Western Sahara</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Tajikistan">Tajikistan</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="United Arab Emirates">United Arab Emirates</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option><option value="Egypt">Egypt</option><option value="United Kingdom">United Kingdom</option><option value="Guernsey">Guernsey</option><option value="Jersey">Jersey</option><option value="Isle of Man">Isle of Man</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="United States">United States</option><option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option><option value="Burkina Faso">Burkina Faso</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Venezuela">Venezuela</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Samoa">Samoa</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option></select>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_email" class="form-label ">Email</label>
                                                    <input class="form-control" maxlength="80" placeholder="Enter Email Address" name="nominee_1_email" type="email" id="nominee_1_email">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_1_mobile" class="form-label required">Mobile</label>
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
                                                        Do you want to add Nominee 1 Guardian (If Nominee is A Minor) ?
                                                        <div class="form-check form-switch form-switch-lg switch" dir="ltr">
                                                            <input name="nominee_1_is_guardian" type="checkbox" value="1" class="form-check-input" id="nominee_1_is_guardian">
                                                            <label class="form-check-label" for="nominee_1_is_guardian"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="nominee_1_guardian" style="display:none">
                                                    <div class="card border-info border-top-0 border-radious-0">
                                                        <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                                            <h4 class="card-title mb-0">Nominee 1 Guardian (If Nominee is A Minor)</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row  p-2">
                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_courtesy_title" class="form-label required">Courtesy Title</label>
                                                                    <select class="form-control select2" maxlength="10" id="guardian_of_nominee_1_courtesy_title" name="guardian_of_nominee_1_courtesy_title"><option selected="selected" value="">Select</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Ms">Ms</option><option value="Dr">Dr</option></select>
                                                                </div>
                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_firstname" class="form-label required">First Name</label>
                                                                    <input class="form-control" maxlength="100" placeholder="Enter First Name" name="guardian_of_nominee_1_firstname" type="text" id="guardian_of_nominee_1_firstname">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_lastname" class="form-label required">Last Name</label>
                                                                    <input class="form-control" maxlength="100" placeholder="Enter Last Name" name="guardian_of_nominee_1_lastname" type="text" id="guardian_of_nominee_1_lastname">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_relationship" class="form-label required">Relationship</label>
                                                                    <input class="form-control" maxlength="100" placeholder="Relationship with Nominee" name="guardian_of_nominee_1_relationship" type="text" id="guardian_of_nominee_1_relationship">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_maturity_date_of_minor" class="form-label required">Maturity Date of Minor (YYYY-MM-DD)</label>
                                                                    <div class="flatpickr">
                                                                        <input class="form-control datepicker" id="guardian_of_nominee_1_maturity_date_of_minor" placeholder="Enter Date of Birth" aria-label="maturity_date_of_minor" aria-describedby="maturity_date_of_minor-addon" autocomplete="off" name="guardian_of_nominee_1_maturity_date_of_minor" type="text">
                                                                        <a class="input-button" title="toggle" data-toggle>
                                                                            <i class="icon-calendar"></i>
                                                                        </a>
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
                                                                    <label for="guardian_of_nominee_1_date_of_birth" class="form-label required">Date of Birth (YYYY-MM-DD)</label>
                                                                    <div class="flatpickr">
                                                                        <input class="form-control birthdate" placeholder="Enter Date of Birth" aria-label="guardian_date_of_birth" aria-describedby="guardian_date_of_birth-addon" autocomplete="off" name="guardian_of_nominee_1_date_of_birth" type="text" id="guardian_of_nominee_1_date_of_birth">
                                                                        <a class="input-button" title="toggle" data-toggle>
                                                                            <i class="icon-calendar"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_nid" class="form-label required">NID</label>
                                                                    <input class="form-control" minlength="20" maxlength="16" placeholder="Enter NID" name="guardian_of_nominee_1_nid" type="text" id="guardian_of_nominee_1_nid">
                                                                </div>

                                                                <div class="col-md-12 mb-2">
                                                                    <label for="guardian_of_nominee_1_address_line_1" class="form-label required">Address Line 1</label>
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
                                                                    <label for="guardian_of_nominee_1_city" class="form-label required">City</label>
                                                                    <input class="form-control" maxlength="25" placeholder="Enter City" name="guardian_of_nominee_1_city" type="text" id="guardian_of_nominee_1_city">
                                                                </div>
                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_post_code" class="form-label required">Post Code</label>
                                                                    <input class="form-control" maxlength="10" placeholder="Enter Post Code" name="guardian_of_nominee_1_post_code" type="text" id="guardian_of_nominee_1_post_code">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_division" class="form-label required">Division</label>
                                                                    <input class="form-control" maxlength="25" placeholder="Enter Division" name="guardian_of_nominee_1_division" type="text" id="guardian_of_nominee_1_division">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_country" class="form-label required">Country</label>
                                                                    <select class="form-control select2" id="guardian_of_nominee_1_country" name="guardian_of_nominee_1_country"><option selected="selected" value="">Select Country</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Antarctica">Antarctica</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Azerbaijan">Azerbaijan</option><option value="Argentina">Argentina</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Armenia">Armenia</option><option value="Barbados">Barbados</option><option value="Belgium">Belgium</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="Belize">Belize</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Solomon Islands">Solomon Islands</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Myanmar">Myanmar</option><option value="Burundi">Burundi</option><option value="Belarus">Belarus</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Sri Lanka">Sri Lanka</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Taiwan, Province of China">Taiwan, Province of China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling); Islands">Cocos (Keeling); Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Mayotte">Mayotte</option><option value="Congo">Congo</option><option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Benin">Benin</option><option value="Denmark">Denmark</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Ethiopia">Ethiopia</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Faroe Islands">Faroe Islands</option><option value="Falkland Islands (Malvinas);">Falkland Islands (Malvinas);</option><option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="Aland Islands">Aland Islands</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Djibouti">Djibouti</option><option value="Gabon">Gabon</option><option value="Georgia">Georgia</option><option value="Gambia">Gambia</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Kiribati">Kiribati</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option><option value="Holy See (Vatican City State);">Holy See (Vatican City State);</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Côte d&#039;Ivoire">Côte d&#039;Ivoire</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Kazakhstan">Kazakhstan</option><option value="Jordan">Jordan</option><option value="Kenya">Kenya</option><option value="Korea, Democratic People&#039;s Republic of">Korea, Democratic People&#039;s Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People&#039;s Democratic Republic">Lao People&#039;s Democratic Republic</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Latvia">Latvia</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Moldova">Moldova</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Oman">Oman</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="Aruba">Aruba</option><option value="New Caledonia">New Caledonia</option><option value="Vanuatu">Vanuatu</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Norway">Norway</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Marshall Islands">Marshall Islands</option><option value="Palau">Palau</option><option value="Pakistan">Pakistan</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Timor-Leste">Timor-Leste</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Réunion">Réunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Barthélemy">Saint Barthélemy</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Anguilla">Anguilla</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Martin (French part);">Saint Martin (French part);</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia[5]">Serbia[5]</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Viet Nam">Viet Nam</option><option value="Slovenia">Slovenia</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="Zimbabwe">Zimbabwe</option><option value="Spain">Spain</option><option value="Western Sahara">Western Sahara</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Tajikistan">Tajikistan</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="United Arab Emirates">United Arab Emirates</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option><option value="Egypt">Egypt</option><option value="United Kingdom">United Kingdom</option><option value="Guernsey">Guernsey</option><option value="Jersey">Jersey</option><option value="Isle of Man">Isle of Man</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="United States">United States</option><option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option><option value="Burkina Faso">Burkina Faso</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Venezuela">Venezuela</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Samoa">Samoa</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option></select>
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_email" class="form-label ">Email</label>
                                                                    <input class="form-control" maxlength="80" placeholder="Enter Email Address" name="guardian_of_nominee_1_email" type="email" id="guardian_of_nominee_1_email">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_1_mobile" class="form-label required">Mobile</label>
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
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-2 p-3">
                                            <div class="view-profile-card-header p-3 rounded-2 border border-warning" role="alert">
                                                Do you want to add nominee 2 ?
                                                <div class="form-check form-switch form-switch-lg switch" dir="ltr">
                                                    <input name="nominee_2" type="checkbox" value="1" class="form-check-input" id="add-nominee_2">
                                                    <label class="form-check-label" for="add-nominee_2"></label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Nominee 2 Details --}}
                                        <div class="mb-3" id="nominee_2-details" style="display:none">
                                            <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                                <h4 class="card-title mb-0">Nominee 2</h4>
                                            </div>

                                            <div class="row p-3">
                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_courtesy_title" class="form-label required">Courtesy Title</label>
                                                    <select class="form-control select2" maxlength="10" id="nominee_2_courtesy_title" name="nominee_2_courtesy_title"><option selected="selected" value="">Select</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Ms">Ms</option><option value="Dr">Dr</option></select>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_firstname" class="form-label required">First Name</label>
                                                    <input class="form-control" maxlength="100" placeholder="Enter First Name" name="nominee_2_firstname" type="text" id="nominee_2_firstname">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_lastname" class="form-label required">Last Name</label>
                                                    <input class="form-control" maxlength="100" placeholder="Enter Last Name" name="nominee_2_lastname" type="text" id="nominee_2_lastname">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_relationship" class="form-label required">Relationship</label>
                                                    <input class="form-control" maxlength="100" placeholder="Relationship with A/C Holder" name="nominee_2_relationship" type="text" id="nominee_2_relationship">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_percentage" class="form-label required">Percentage</label>
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
                                                    <label for="nominee_2_date_of_birth" class="form-label required">Date of Birth (YYYY-MM-DD)</label>
                                                    <div class="flatpickr">
                                                        <input class="form-control birthdate" placeholder="Enter Date of Birth" id="nominee_2_date_of_birth" aria-label="date_of_birth" aria-describedby="date_of_birth-addon" autocomplete="off" name="nominee_2_date_of_birth" type="text">
                                                        <a class="input-button" title="toggle" data-toggle>
                                                            <i class="icon-calendar"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_nid" class="form-label required">NID</label>
                                                    <input class="form-control" minlength="10" maxlength="20" placeholder="Enter NID" name="nominee_2_nid" type="text" id="nominee_2_nid">
                                                </div>

                                                <div class="col-md-12 mb-2">
                                                    <label for="nominee_2_address_line_1" class="form-label required">Address Line 1</label>
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
                                                    <label for="nominee_2_city" class="form-label required">City</label>
                                                    <input class="form-control" maxlength="25" placeholder="Enter City" name="nominee_2_city" type="text" id="nominee_2_city">
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_post_code" class="form-label required">Post Code</label>
                                                    <input class="form-control" maxlength="10" placeholder="Enter Post Code" name="nominee_2_post_code" type="text" id="nominee_2_post_code">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_division" class="form-label required">Division</label>
                                                    <input class="form-control" maxlength="25" placeholder="Enter Division" name="nominee_2_division" type="text" id="nominee_2_division">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_country" class="form-label required">Country</label>
                                                    <select class="form-control select2" id="nominee_2_country" name="nominee_2_country"><option selected="selected" value="">Select Country</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Antarctica">Antarctica</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Azerbaijan">Azerbaijan</option><option value="Argentina">Argentina</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Armenia">Armenia</option><option value="Barbados">Barbados</option><option value="Belgium">Belgium</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="Belize">Belize</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Solomon Islands">Solomon Islands</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Myanmar">Myanmar</option><option value="Burundi">Burundi</option><option value="Belarus">Belarus</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Sri Lanka">Sri Lanka</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Taiwan, Province of China">Taiwan, Province of China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling); Islands">Cocos (Keeling); Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Mayotte">Mayotte</option><option value="Congo">Congo</option><option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Benin">Benin</option><option value="Denmark">Denmark</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Ethiopia">Ethiopia</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Faroe Islands">Faroe Islands</option><option value="Falkland Islands (Malvinas);">Falkland Islands (Malvinas);</option><option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="Aland Islands">Aland Islands</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Djibouti">Djibouti</option><option value="Gabon">Gabon</option><option value="Georgia">Georgia</option><option value="Gambia">Gambia</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Kiribati">Kiribati</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option><option value="Holy See (Vatican City State);">Holy See (Vatican City State);</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Côte d&#039;Ivoire">Côte d&#039;Ivoire</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Kazakhstan">Kazakhstan</option><option value="Jordan">Jordan</option><option value="Kenya">Kenya</option><option value="Korea, Democratic People&#039;s Republic of">Korea, Democratic People&#039;s Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People&#039;s Democratic Republic">Lao People&#039;s Democratic Republic</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Latvia">Latvia</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Moldova">Moldova</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Oman">Oman</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="Aruba">Aruba</option><option value="New Caledonia">New Caledonia</option><option value="Vanuatu">Vanuatu</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Norway">Norway</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Marshall Islands">Marshall Islands</option><option value="Palau">Palau</option><option value="Pakistan">Pakistan</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Timor-Leste">Timor-Leste</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Réunion">Réunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Barthélemy">Saint Barthélemy</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Anguilla">Anguilla</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Martin (French part);">Saint Martin (French part);</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia[5]">Serbia[5]</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Viet Nam">Viet Nam</option><option value="Slovenia">Slovenia</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="Zimbabwe">Zimbabwe</option><option value="Spain">Spain</option><option value="Western Sahara">Western Sahara</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Tajikistan">Tajikistan</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="United Arab Emirates">United Arab Emirates</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option><option value="Egypt">Egypt</option><option value="United Kingdom">United Kingdom</option><option value="Guernsey">Guernsey</option><option value="Jersey">Jersey</option><option value="Isle of Man">Isle of Man</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="United States">United States</option><option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option><option value="Burkina Faso">Burkina Faso</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Venezuela">Venezuela</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Samoa">Samoa</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option></select>
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_email" class="form-label ">Email</label>
                                                    <input class="form-control" maxlength="80" placeholder="Enter Email Address" name="nominee_2_email" type="email" id="nominee_2_email">
                                                </div>

                                                <div class="col-md-3 mb-2">
                                                    <label for="nominee_2_mobile" class="form-label required">Mobile</label>
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
                                                        Do you want to add Nominee 2 Guardian (If Nominee is A Minor) ?
                                                        <div class="form-check form-switch form-switch-lg switch" dir="ltr">
                                                            <input name="nominee_2_is_guardian" type="checkbox" value="1" class="form-check-input" id="nominee_2_is_guardian">
                                                            <label class="form-check-label" for="nominee_2_is_guardian"></label>
                                                        </div>
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
                                                                    <label for="guardian_of_nominee_2_courtesy_title" class="form-label required">Courtesy Title</label>
                                                                    <select class="form-control select2" maxlength="10" id="guardian_of_nominee_2_courtesy_title" name="guardian_of_nominee_2_courtesy_title"><option selected="selected" value="">Select</option><option value="Mr">Mr</option><option value="Mrs">Mrs</option><option value="Ms">Ms</option><option value="Dr">Dr</option></select>
                                                                </div>
                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_firstname" class="form-label required">First Name</label>
                                                                    <input class="form-control" maxlength="100" placeholder="Enter First Name" name="guardian_of_nominee_2_firstname" type="text" id="guardian_of_nominee_2_firstname">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_lastname" class="form-label required">Last Name</label>
                                                                    <input class="form-control" maxlength="100" placeholder="Enter Last Name" name="guardian_of_nominee_2_lastname" type="text" id="guardian_of_nominee_2_lastname">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_relationship" class="form-label required">Relationship</label>
                                                                    <input class="form-control" maxlength="100" placeholder="Relationship with Nominee" name="guardian_of_nominee_2_relationship" type="text" id="guardian_of_nominee_2_relationship">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_maturity_date_of_minor" class="form-label required">Maturity Date of Minor (YYYY-MM-DD)</label>
                                                                    <div class="flatpickr">
                                                                        <input class="form-control datepicker" id="guardian_of_nominee_2_maturity_date_of_minor" placeholder="Enter Date of Birth" aria-label="maturity_date_of_minor" aria-describedby="maturity_date_of_minor-addon" autocomplete="off" name="guardian_of_nominee_2_maturity_date_of_minor" type="text">
                                                                        <a class="input-button" title="toggle" data-toggle>
                                                                            <i class="icon-calendar"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3 my-3">
                                                                    <p class="required"><b>Residential Status</b></p>
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
                                                                    <label for="guardian_of_nominee_2_date_of_birth" class="form-label required">Date of Birth (YYYY-MM-DD)</label>
                                                                    <div class="flatpickr">
                                                                        <input class="form-control birthdate" placeholder="Enter Date of Birth" aria-label="guardian_date_of_birth" aria-describedby="guardian_date_of_birth-addon" autocomplete="off" name="guardian_of_nominee_2_date_of_birth" type="text" id="guardian_of_nominee_2_date_of_birth">
                                                                        <a class="input-button" title="toggle" data-toggle>
                                                                            <i class="icon-calendar"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_nid" class="form-label required">NID</label>
                                                                    <input class="form-control" minlength="20" maxlength="16" placeholder="Enter NID" name="guardian_of_nominee_2_nid" type="text" id="guardian_of_nominee_2_nid">
                                                                </div>

                                                                <div class="col-md-12 mb-2">
                                                                    <label for="guardian_of_nominee_2_address_line_1" class="form-label required">Address Line 1</label>
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
                                                                    <label for="guardian_of_nominee_2_city" class="form-label required">City</label>
                                                                    <input class="form-control" maxlength="25" placeholder="Enter City" name="guardian_of_nominee_2_city" type="text" id="guardian_of_nominee_2_city">
                                                                </div>
                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_post_code" class="form-label required">Post Code</label>
                                                                    <input class="form-control" maxlength="10" placeholder="Enter Post Code" name="guardian_of_nominee_2_post_code" type="text" id="guardian_of_nominee_2_post_code">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_division" class="form-label required">Division</label>
                                                                    <input class="form-control" maxlength="25" placeholder="Enter Division" name="guardian_of_nominee_2_division" type="text" id="guardian_of_nominee_2_division">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_country" class="form-label required">Country</label>
                                                                    <select class="form-control select2" id="guardian_of_nominee_2_country" name="guardian_of_nominee_2_country"><option selected="selected" value="">Select Country</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Antarctica">Antarctica</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Antigua and Barbuda">Antigua and Barbuda</option><option value="Azerbaijan">Azerbaijan</option><option value="Argentina">Argentina</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Armenia">Armenia</option><option value="Barbados">Barbados</option><option value="Belgium">Belgium</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="Belize">Belize</option><option value="British Indian Ocean Territory">British Indian Ocean Territory</option><option value="Solomon Islands">Solomon Islands</option><option value="Virgin Islands, British">Virgin Islands, British</option><option value="Brunei Darussalam">Brunei Darussalam</option><option value="Bulgaria">Bulgaria</option><option value="Myanmar">Myanmar</option><option value="Burundi">Burundi</option><option value="Belarus">Belarus</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Central African Republic">Central African Republic</option><option value="Sri Lanka">Sri Lanka</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Taiwan, Province of China">Taiwan, Province of China</option><option value="Christmas Island">Christmas Island</option><option value="Cocos (Keeling); Islands">Cocos (Keeling); Islands</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Mayotte">Mayotte</option><option value="Congo">Congo</option><option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Benin">Benin</option><option value="Denmark">Denmark</option><option value="Dominica">Dominica</option><option value="Dominican Republic">Dominican Republic</option><option value="Ecuador">Ecuador</option><option value="El Salvador">El Salvador</option><option value="Equatorial Guinea">Equatorial Guinea</option><option value="Ethiopia">Ethiopia</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Faroe Islands">Faroe Islands</option><option value="Falkland Islands (Malvinas);">Falkland Islands (Malvinas);</option><option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="Aland Islands">Aland Islands</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="French Polynesia">French Polynesia</option><option value="French Southern Territories">French Southern Territories</option><option value="Djibouti">Djibouti</option><option value="Gabon">Gabon</option><option value="Georgia">Georgia</option><option value="Gambia">Gambia</option><option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Kiribati">Kiribati</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option><option value="Holy See (Vatican City State);">Holy See (Vatican City State);</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Côte d&#039;Ivoire">Côte d&#039;Ivoire</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Kazakhstan">Kazakhstan</option><option value="Jordan">Jordan</option><option value="Kenya">Kenya</option><option value="Korea, Democratic People&#039;s Republic of">Korea, Democratic People&#039;s Republic of</option><option value="Korea, Republic of">Korea, Republic of</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Lao People&#039;s Democratic Republic">Lao People&#039;s Democratic Republic</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Latvia">Latvia</option><option value="Liberia">Liberia</option><option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macao">Macao</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mexico">Mexico</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Moldova">Moldova</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Oman">Oman</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="Netherlands Antilles">Netherlands Antilles</option><option value="Aruba">Aruba</option><option value="New Caledonia">New Caledonia</option><option value="Vanuatu">Vanuatu</option><option value="New Zealand">New Zealand</option><option value="Nicaragua">Nicaragua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Norway">Norway</option><option value="Northern Mariana Islands">Northern Mariana Islands</option><option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option><option value="Micronesia, Federated States of">Micronesia, Federated States of</option><option value="Marshall Islands">Marshall Islands</option><option value="Palau">Palau</option><option value="Pakistan">Pakistan</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Timor-Leste">Timor-Leste</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Réunion">Réunion</option><option value="Romania">Romania</option><option value="Russian Federation">Russian Federation</option><option value="Rwanda">Rwanda</option><option value="Saint Barthélemy">Saint Barthélemy</option><option value="Saint Helena">Saint Helena</option><option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option><option value="Anguilla">Anguilla</option><option value="Saint Lucia">Saint Lucia</option><option value="Saint Martin (French part);">Saint Martin (French part);</option><option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option><option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option><option value="San Marino">San Marino</option><option value="Sao Tome and Principe">Sao Tome and Principe</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Serbia[5]">Serbia[5]</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovakia">Slovakia</option><option value="Viet Nam">Viet Nam</option><option value="Slovenia">Slovenia</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="Zimbabwe">Zimbabwe</option><option value="Spain">Spain</option><option value="Western Sahara">Western Sahara</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syrian Arab Republic">Syrian Arab Republic</option><option value="Tajikistan">Tajikistan</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad and Tobago</option><option value="United Arab Emirates">United Arab Emirates</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Turks and Caicos Islands">Turks and Caicos Islands</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="Macedonia, the former Yugoslav Republic of">Macedonia, the former Yugoslav Republic of</option><option value="Egypt">Egypt</option><option value="United Kingdom">United Kingdom</option><option value="Guernsey">Guernsey</option><option value="Jersey">Jersey</option><option value="Isle of Man">Isle of Man</option><option value="Tanzania, United Republic of">Tanzania, United Republic of</option><option value="United States">United States</option><option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option><option value="Burkina Faso">Burkina Faso</option><option value="Uruguay">Uruguay</option><option value="Uzbekistan">Uzbekistan</option><option value="Venezuela">Venezuela</option><option value="Wallis and Futuna">Wallis and Futuna</option><option value="Samoa">Samoa</option><option value="Yemen">Yemen</option><option value="Zambia">Zambia</option></select>
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_email" class="form-label ">Email</label>
                                                                    <input class="form-control" maxlength="80" placeholder="Enter Email Address" name="guardian_of_nominee_2_email" type="email" id="guardian_of_nominee_2_email">
                                                                </div>

                                                                <div class="col-md-3 mb-2">
                                                                    <label for="guardian_of_nominee_2_mobile" class="form-label required">Mobile</label>
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
                                        </div>
                                    </div>
                                </form>
                                <button type="button" class="btn btn-primary next-step">Next</button>
                                <button type="button" class="btn btn-secondary prev-step">Back</button>
                            </div>

                            <div id="step-5" class="step-content">
                                <div class="card-header d-flex align-items-center justify-content-between  view-profile-card-header">
                                    <h4 class="card-title mb-0">Please Upload Your Necessary Document</h4>
                                </div>
                                <div class="row row p-2 pt-3">
                                    <div class="col-lg-3">
                                        <form method="POST" action="" class="document-frm" enctype="multipart/form-data">
                                            <input name="id" type="hidden" value="">
                                            <input name="user_id" type="hidden" value="95">
                                            <input name="title" type="hidden" value="First Applicant (1st Holder) Photo">
                                            <input name="image_preview" type="hidden" value="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">

                                            <div class="upload-preview">
                                                <a href="javascript:void(0)" style="cursor:default">
                                                    <img class="img-fluid" alt="" src="https://onlinebo.uftfast.com/assets/images/Not-found-image.svg">
                                                </a>
                                            </div>
                                            <div class="mt-3">
                                                <h5 class="m-0">First Applicant (1st Holder) Photo</h5>
                                                <span class="text-info help-text">
                                                                                (Image size 591x709 pixel)
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

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('admin/assets/js/bo.js') }}"></script>
    <!-- jQuery -->
    <script>
        $(document).ready(function() {
            var currentStep = 1;
            var totalSteps = $('#step-wizard .step-content').length;

            $('.next-step').click(function() {
                // Validate current step form before proceeding
                var isValid = true;
                // $('#step-' + currentStep + '-form .required').each(function() {
                //     if (!$(this).val()) {
                //         isValid = false;
                //         $(this).addClass('is-invalid');
                //     } else {
                //         $(this).removeClass('is-invalid');
                //     }
                // });

                if (isValid) {
                    $('#step-' + currentStep).removeClass('active');
                    currentStep++;
                    $('#step-' + currentStep).addClass('active');
                }
            });

            $('.prev-step').click(function() {
                $('#step-' + currentStep).removeClass('active');
                currentStep--;
                $('#step-' + currentStep).addClass('active');
            });

            $('.submit').click(function() {
                // Handle form submission here
                var isValid = true;
                $('#step-' + currentStep + '-form .required').each(function() {
                    if (!$(this).val()) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                if (isValid) {
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
