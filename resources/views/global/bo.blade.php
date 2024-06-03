@extends('user.layout.app')

@section('content')
    <div class="bo">
        <div class="content">
            <h1>Single BO Opening</h1>
            <p>Home / Online Bo</p>
        </div>
    </div>
    <section id="main-container" class="main-container">
        <div class="container">
            <div class="underline">
                <h4 style="text-align: center;">BO Opening Account</h4>
            </div>
            <h6 style="text-align: center;" class="mt-5">
                <button style="text-transform: uppercase; font-weight:600;" class="btn btn-sm btn-warning text-white">
                    Click here to follow instructions before BO opening
                </button>
            </h6>

            <form action="{{ route('bo.store') }}" method="post" style="width: 100%;" enctype="multipart/form-data">
                <div style="box-shadow: 0 0 10px rgba(0,0,0,0.1); padding:5px 8px 5px;">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="form_heading">Personal Information</h6>
                            <hr>
                            <div class="form-group">
                                <label for="">Client Name : <span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="client_name" placeholder="Client name">
                            </div>
                            <div class="form-group">
                                <label for="">Father Name : <span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="father_name" placeholder="Father name">
                            </div>
                            <div class="form-group">
                                <label for="">Mother Name : <span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="mother_name" placeholder="Mother name">
                            </div>

                            <div class="form-group">
                                <label for="">Gender : <span class="text-danger"> * </span></label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="male" id="inlineRadio1" value="option1">
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="female" id="inlineRadio2" value="option2">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Date of birth : <span class="text-danger"> * </span></label>
                                <input type="date" class="form-control" name="dob" placeholder="date of birth">
                            </div>

                            <div class="form-group">
                                <label for="">Occupation : <span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="occupation" placeholder="Occupation">
                            </div>
                            <div class="form-group">
                                <label for="">Address : <span class="text-danger"> * </span></label>
                                <input type="text" name="address" class="form-control" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label for="">City : <span class="text-danger"> * </span></label>
                                <input type="text" name="city" class="form-control" placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="">Postal Code : <span class="text-danger"> * </span></label>
                                <input type="text" name="postal_code" class="form-control" placeholder="Postal Code">
                            </div>
                            <div class="form-group">
                                <label for="">Division : <span class="text-danger"> * </span></label>
                                <input type="text" name="division" class="form-control" placeholder="Division">
                            </div>
                            <div class="form-group">
                                <label for="">Country : <span class="text-danger"> * </span></label>
                                <input type="text" name="country" class="form-control" placeholder="Country">
                            </div>
                            <div class="form-group">
                                <label for="">Mobile Number : <span class="text-danger"> * </span></label>
                                <input type="text" name="mobile" class="form-control" placeholder="Mobile Number">
                            </div>
                            <div class="form-group">
                                <label for="">Email : <span class="text-danger"> * </span></label>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="">NID No : <span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="nid_no" placeholder="NID No">
                            </div>

                            <div class="form-group">
                                <label for="">NID Attachment : <span class="text-danger"> * </span></label>
                                <input type="file" class="form-control" name="nid_attachment" placeholder="NID Attachment">
                            </div>

                            <div class="form-group">
                                <label for="">User photo : <span class="text-danger"> * </span></label>
                                <input type="file" name="user_photo" class="form-control" placeholder="User photo">
                            </div>
                            <div class="form-group">
                                <label for="">Signature : <span class="text-danger"> * </span></label>
                                <input type="file" name="user_signature" class="form-control" placeholder="Signature">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6 class="form_heading">Bank Information</h6>
                            <hr>
                            <div class="form-group">
                                <label for="">Bank Name : <span class="text-danger"> * </span></label>
                                <input type="text" name="bank_name" class="form-control" placeholder="Bank name">
                            </div>
                            <div class="form-group">
                                <label for="">Branch Name : <span class="text-danger"> * </span></label>
                                <input type="text" name="branch_name" class="form-control" placeholder="Branch name">
                            </div>
                            <div class="form-group">
                                <label for="">Bank Account No : <span class="text-danger"> * </span></label>
                                <input type="text" name="bank_account_no" class="form-control" placeholder="Bank account no">
                            </div>
                            <div class="form-group">
                                <label for="">Routing number : <span class="text-danger"> * </span></label>
                                <input type="text" name="routing_number" class="form-control" placeholder="Routing number">
                            </div>
                            <div class="form-group">
                                <label for="">Cheque leaf : <span class="text-danger"> * </span></label>
                                <input type="file" name="cheque_leaf" class="form-control" placeholder="Cheque leaf">
                            </div>
                            <div class="mt-3"></div>

                            <h6 class="form_heading">Nomineee infomation </h6>
                            <hr>
                            <div class="form-group">
                                <label for="">Nomineee name : <span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="nominee_name" placeholder="Nomineee name">
                            </div>
                            <div class="form-group">
                                <label for="">Relationship : <span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="n_relationship" placeholder="Relationship">
                            </div>
                            <div class="form-group">
                                <label for="">Percentage  : <span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="percentage" placeholder="Percentage">
                            </div>
                            <div class="form-group">
                                <label for="">Mobile number  : <span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="n_mobile" placeholder="Mobile number">
                            </div>
                            <div class="form-group">
                                <label for="">Nominee NID No : <span class="text-danger"> * </span></label>
                                <input type="text" class="form-control" name="n_nid" placeholder="Nominee NID No">
                            </div>
                            <div class="form-group">
                                <label for="">NID Attachment : <span class="text-danger"> * </span></label>
                                <input type="file" class="form-control" name="n_nid_attachment" placeholder="NID Attachment">
                            </div>
                            <div class="form-group">
                                <label for="">Nomineee photo : <span class="text-danger"> * </span></label>
                                <input type="file" class="form-control" name="n_photo" placeholder="NID Attachment">
                            </div>
                            <div class="form-group">
                                <label for="">Nomineee signature : <span class="text-danger"> * </span></label>
                                <input type="file" class="form-control" name="n_signature" placeholder="Nomineee signature">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h6 class="form_heading">Joint Holder</h6>
                        </div>
                        <hr>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Full Name : </label>
                                <input type="text" name="j_name" class="form-control" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <label for="">Mobile number : </label>
                                <input type="text" name="j_mobile" class="form-control" placeholder="Mobile number">
                            </div>
                            <div class="form-group">
                                <label for="">NID Attachment : </label>
                                <input type="file" class="form-control" name="j_nid_attachment" aria-invalid="false" placeholder="NID Attachment">
                            </div>
                            <div class="form-group">
                                <label for="">Signature : </label>
                                <input type="file" name="j_signature" class="form-control" placeholder="Signature">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Gender : </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="j_gender" value="male" id="inlineRadio1">
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="j_gender" id="inlineRadio2" value="female">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">NID No : </label>
                                <input type="text" class="form-control" name="j_nid" placeholder="NID No">
                            </div>
                            <div class="form-group">
                                <label for="">Photo : </label>
                                <input type="file" class="form-control" name="j_photo" placeholder="Photo">
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="submitCheck" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">Accept terms & conditions</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Form</button>
                    </div>

                </div>
            </form>
        </div>
    </section>

@endsection
