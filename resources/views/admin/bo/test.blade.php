<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Bo Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: grey;
        }
        .header {
            padding: 20px;
            text-align: center;
            background-color: #f8f8f8;
            width: 735px;
            display: block;
            margin: 10px auto;
            background-color: #fff;
        }
        .header img {
            width: 100px;
            height: auto;
        }
        .header .address {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
        .content {
            padding: 20px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .content table, .content th, .content td {
            border: 1px solid #ddd;
        }
        .content th, .content td {
            padding: 10px;
            text-align: left;
        }
        .content th {
            background-color: #f2f2f2;
        }
        .info-header {
            background-color: blue;
            width: 350px;
            color: #fff;
            font-size: 12px;
            padding: 2px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .info-date {
            font-size: 12px;
        }
        .flex-container {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="d-flex align-items-center justify-content-around">
                <div>
                    <img src="{{ asset('auth/ANCSECURITIES.png') }}" alt="Company Logo">
                </div>
                <div class="address">
                    <p style="margin-bottom: 0;"><strong>Address : </strong></p>
                    <p style="margin-bottom: 0;">Alhaj Tower, Fourth Floor (Level-3)</p>
                    <p style="margin-bottom: 0;">82, Mothijheel C/A, Dhaka-1000</p>
                    <p style="margin-bottom: 0;">DSE TREC No.275 & CSE TREC No. 158</p>
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <p class="info-header">CUSTOMER ACCOUNT INFORMATION</p>
                    <p class="info-date">Date : 16-Jul-2024</p>
                </div>
                <div>
                    <img style="width: 95px;" src="{{ asset('auth/ANCSECURITIES.png') }}" alt="">
                    <img style="width: 95px;" src="{{ asset('auth/ANCSECURITIES.png') }}" alt="">
                </div>
            </div>

            <div style="text-align:center;font-size: 10px;margin-top: 11px;font-weight: 600;">
                <p style="margin-bottom: 0;">
                    Please Complete all details 'CAPITAL' letters and PUT Tick mark in appropiate box.
                </p>
                <p style="margin-bottom: 0;">
                    All communication shall be made only to the First Account Holder's correspondents Address.
                </p>
            </div>

            <div class="d-flex justify-content-around">
                <div style="margin-bottom: 0; margin-top: 10px;">
                    <p>
                        Client Code : 12038746
                    </p>
                </div>
                <div style="margin-bottom: 0; margin-top: 10px;">
                    <p>
                        BO ID : 120387465454
                    </p>
                </div>
            </div>

            <div>
                <p>
                    Account Type : Individual
                </p>
            </div>

            <div>
                <p style="text-transform: uppercase;background-color: blue;color: #fff;text-align: left;width: 100%;padding: 3px;font-size: 14px;font-weight: 600;">
                    Particulars of first applicants information:
                </p>
            </div>

            <div style="text-align: left; font-size: 12px; border: 1px solid black; padding:5px;">
                <p>Name of the Account Holder : <span style="text-transform: uppercase;">{{ $client->client_name }}</span></p>
                <p>Father/Husband Name : </p>
                <p>Mother Name : </p>
                <p style="display: flex; justify-content: space-between;">
                    Date Of Birth : 19-03-1987 <span>Sex : Male</span>
                    <span>Occupation : {{ $client->occupation }}</span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Tel : {{ $client->mobile . ' ' }}</span> <span>Mobile : <strong style="text-decoration: underline;">{{ $client->mobile }}</strong></span> <span>Email : {{ $client->email }}</span> <span>Fax: 546556</span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Nationality : Bangladeshi</span> <span>Natiobal ID : 183276473843</span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Passport No : 73768387 </span> <span>Issue Date : 27-03-76</span> <span>Issue Place : Dhaka</span> <span>Expiry Date : 27-03-76</span>
                </p>
                <p>
                    Present Address :
                </p>
                <p>
                    Permanent Address :
                </p>
            </div>

            <div class="mt-2">
                <p style="text-transform: uppercase;background-color: blue;color: #fff;text-align: left;width: 100%;padding: 3px;font-size: 14px;font-weight: 600;">
                    in case of company:
                </p>
            </div>

            <div style="text-align: left; font-size: 12px; border: 1px solid black; padding:5px;">
                <p>Name of CEO/MD : </p>
                <p style="display: flex; justify-content: space-between;">
                    Registration No : 19031987 <span>Date of Incorporation : 27-03-96</span> <span>Country of Origin : Bangladesh</span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>TIN Number : {{ $client->mobile . ' ' }}</span> <span>Tel : <strong style="text-decoration: underline;">{{ $client->mobile }}</strong></span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Mobile : 01713617913</span> <span>Email : s@gmail.com</span> <span>Fax : 17364373</span>
                </p>
                <p>
                    Contact Address :
                </p>
            </div>

            <div class="mt-2">
                <p style="text-transform: uppercase;background-color: blue;color: #fff;text-align: left;width: 100%;padding: 3px;font-size: 14px;font-weight: 600;">
                    particular of joint applicant information:
                </p>
            </div>

            <div style="text-align: left; font-size: 12px; border: 1px solid black; padding:5px;">
                <p>Name of Account Holder : </p>
                <p>Father/Husband Name : </p>
                <p>Mother Name : </p>
                <p style="display: flex; justify-content: space-between;">
                    Date Of Birth : 19-03-1987 <span>Sex : Male</span>
                    <span>Occupation : {{ $client->occupation }}</span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Tel : {{ $client->mobile . ' ' }}</span> <span>Mobile : <strong style="text-decoration: underline;">{{ $client->mobile }}</strong></span> <span>Email : {{ $client->email }}</span> <span>Fax: 546556</span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Mobile : 01713617913</span> <span>Email : s@gmail.com</span> <span>Fax : 17364373</span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Nationality : Bangladeshi</span> <span>Natiobal ID : 183276473843</span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Passport No : 73768387 </span> <span>Issue Date : 27-03-76</span> <span>Issue Place : Dhaka</span> <span>Expiry Date : 27-03-76</span>
                </p>
                <p>
                    Present Address :
                </p>
                <p>
                    Permanent Address :
                </p>
            </div>

            <div class="mt-2">
                <p style="text-transform: uppercase;background-color: blue;color: #fff;text-align: left;width: 100%;padding: 3px;font-size: 14px;font-weight: 600;">
                    bank information:
                </p>
            </div>

            <div style="text-align: left; font-size: 12px; border: 1px solid black; padding:5px;">
                <p style="display: flex; justify-content: space-between;">
                    Bank Name : Asia Bank <span>Branch Name : Tejgaon</span> <span>District Name : Bangladesh</span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Routing No : {{ $client->mobile . ' ' }}</span> <span>Account No : <strong style="text-decoration: underline;">{{ $client->mobile }}</strong></span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Bank Identifier Code(B/C) : 01713617913</span> <span>SWIFT Code : 34535</span> <span>International Bank A/C No(IBAN) : 17364373</span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Electronic Dividend Credit: Yes </span> <span>Electronic Dividend Credit: Yes </span> <span>TIN/Tax ID: 17364373</span>
                </p>
            </div>

            <div class="mt-2">
                <p style="text-transform: uppercase;background-color: blue;color: #fff;text-align: left;width: 100%;padding: 3px;font-size: 14px;font-weight: 600;">
                    particular of introducer:
                </p>
            </div>

            <div style="text-align: left; font-size: 12px; border: 1px solid black; padding:5px;">
                <p>
                    <span>Name of the Introducer : </span>
                </p>
                <p>Father/Husband Name : </p>
                <p>Mother Name : </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Sex : Male</span> <span>Nationality : <strong style="text-decoration: underline;">Bangladeshi</strong></span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Mobile : 01713617913</span> <span>National ID: 34535</span> <span>Email: s@gmail.com</span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Electronic Dividend Credit: Yes </span> <span>Electronic Dividend Credit: Yes </span> <span>TIN/Tax ID: 17364373</span>
                </p>
                <p>
                    <span>Present Address : </span>
                </p>
                <p style="display: flex; justify-content: space-between;">
                    <span>Internal Code No: Yes </span> <span>Introducer's BO ID: 12066500 </span>
                </p>
                <p>
                    I certify that i have shown <span>.......</span> for the last
                    <span>.......</span> years and confirm his/her signature, occupation,address and other particulars else where in the application.
                </p>
            </div>

            <div class="mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <div style="height: 60px;width: 100%;background-color: #80808082;">

                        </div>
                        <p style="font-size: 12px;">
                            Signature & Date of the Account Holder (1st Applicant)
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div style="height: 60px;width: 100%;background-color: #80808082;">

                        </div>
                        <p style="font-size: 12px;">
                            Signature & Date of the Joint Account Holder (2nd Applicant)
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div style="height: 60px;width: 100%;background-color: #80808082;">

                        </div>
                        <p style="font-size: 12px;">
                            Signature & Date of the 3rd Signatory (Artificial Body)
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div style="height: 60px;width: 100%;background-color: #80808082;">

                        </div>
                        <p style="font-size: 12px;">
                            Signature & Date of the Person Introducing the Customer
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-2">
                <p style="text-transform: uppercase;background-color: blue;color: #fff;text-align: left;width: 100%;padding: 3px;font-size: 14px;font-weight: 600;">
                    office only:
                </p>
                <div class="row">
                    <div class="col-md-4">
                        <div style="height: 60px;width: 100%;background-color: #80808082;">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="height: 60px;width: 100%;background-color: #80808082;">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="height: 60px;width: 100%;background-color: #80808082;">

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
