<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Bo Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: grey;
        }
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
        .client-info {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .client-info div {
            float: left;
            width: 33%;
            padding: 10px 0;
        }
        .client-info p {
            margin: 0;
            color: #333;
        }
        .client-info p strong {
            color: #0056b3;
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
    </style>
</head>
<body>
    <div>
        <div style="padding: 20px;text-align: center; display: block; margin: 10px auto;background-color: #fff;">
            <div class="clearfix" style="margin-bottom: 20px;">
                <div style="float: left; width: 30%;">
                    <img src="{{ public_path('user/assets/logos/logo.png') }}" alt="Company Logo" style="width: 100px;">
                </div>
                <div style="float: right; width: 70%; text-align: right;">
                    <p style="margin-bottom: 0;"><strong>Address : </strong></p>
                    <p style="margin-bottom: 0;">Alhaj Tower, Fourth Floor (Level-3)</p>
                    <p style="margin-bottom: 0;">82, Mothijheel C/A, Dhaka-1000</p>
                    <p style="margin-bottom: 0;">DSE TREC No.275 & CSE TREC No. 158</p>
                </div>
            </div>

            <div class="clearfix" style="margin-bottom: 20px;">
                <div style="float: left; width: 70%;">
                    <p class="info-header" style="margin-bottom: 0;">CUSTOMER ACCOUNT INFORMATION</p>
                    <p style="margin-bottom: 0;font-size: 12px;text-align:left;">Date : 16-Jul-2024</p>
                </div>
                <div style="float: right; width: 30%; text-align: right;">
                    <img style="width: 65px;" src="{{ public_path('auth/ANCSECURITIES.png') }}" alt="">
                    <img style="width: 65px;" src="{{ public_path('auth/ANCSECURITIES.png') }}" alt="">
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

            <div class="clearfix client-info" style="margin-bottom: 20px;">
                <div>
                    <p>
                        <strong>Client Code :</strong> 12038746
                    </p>
                </div>
                <div>
                    <p>
                        <strong>BO ID :</strong> 120387465454
                    </p>
                </div>
                <div>
                    <p>
                        <strong>Account Type :</strong> Individual
                    </p>
                </div>
            </div>


            <div>
                <p style="text-transform: uppercase;background-color: blue;color: #fff;text-align: left;width: 100%;padding: 3px;font-size: 14px;font-weight: 600;">
                    Particulars of first applicants information:
                </p>
            </div>

            <div style="text-align: left; font-size: 12px; border: 1px solid black; padding: 5px;">
                <p>Name of the Account Holder : <span style="text-transform: uppercase; color: blue;">{{ $client->client_name }}</span></p>
                <p style="color: green;">Father/Husband Name :</p>
                <p style="color: green;">Mother Name :</p>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 50%; color: red;">
                        Date Of Birth : 19-03-1987
                    </div>
                    <div style="float: left; width: 25%; color: purple;">
                        Sex : Male
                    </div>
                    <div style="float: left; width: 25%; color: purple;">
                        Occupation : {{ $client->occupation }}
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 25%; color: orange;">
                        Tel : {{ $client->mobile }}
                    </div>
                    <div style="float: left; width: 25%; color: orange;">
                        Mobile : <strong style="text-decoration: underline; color: black;">{{ $client->mobile }}</strong>
                    </div>
                    <div style="float: left; width: 25%; color: orange;">
                        Email : {{ $client->email }}
                    </div>
                    <div style="float: left; width: 25%; color: orange;">
                        Fax : 546556
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 50%; color: blue;">
                        Nationality : Bangladeshi
                    </div>
                    <div style="float: left; width: 50%; color: blue;">
                        National ID : 183276473843
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 25%; color: green;">
                        Passport No : 73768387
                    </div>
                    <div style="float: left; width: 25%; color: green;">
                        Issue Date : 27-03-76
                    </div>
                    <div style="float: left; width: 25%; color: green;">
                        Issue Place : Dhaka
                    </div>
                    <div style="float: left; width: 25%; color: green;">
                        Expiry Date : 27-03-76
                    </div>
                </div> <br>

                <p style="color: brown;">Present Address :</p>
                <p style="color: brown;">Permanent Address :</p>
            </div>


            <div class="mt-2">
                <p style="text-transform: uppercase;background-color: blue;color: #fff;text-align: left;width: 100%;padding: 3px;font-size: 14px;font-weight: 600;">
                    in case of company:
                </p>
            </div>

            <div style="text-align: left; font-size: 12px; border: 1px solid black; padding: 5px; page-break-inside: avoid;">
                <p>Name of CEO/MD : </p>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 33%; color: red;">
                        Registration No : 19031987
                    </div>
                    <div style="float: left; width: 33%; color: purple;">
                        Date of Incorporation : 27-03-96
                    </div>
                    <div style="float: left; width: 33%; color: purple;">
                        Country of Origin : Bangladesh
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 50%; color: orange;">
                        TIN Number : {{ $client->mobile . ' ' }}
                    </div>
                    <div style="float: left; width: 50%; color: orange;">
                        Tel : <strong style="text-decoration: underline; color: black;">{{ $client->mobile }}</strong>
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 33%; color: blue;">
                        Mobile : 01713617913
                    </div>
                    <div style="float: left; width: 33%; color: blue;">
                        Email : s@gmail.com
                    </div>
                    <div style="float: left; width: 33%; color: blue;">
                        Fax : 17364373
                    </div>
                </div> <br>

                <p style="color: brown;">Contact Address :</p>
            </div>

            <div style="margin-top: 50px;">
            </div>


            <div class="mt-2">
                <p style="text-transform: uppercase; background-color: blue; color: #fff; text-align: left; width: 100%; padding: 3px; font-size: 14px; font-weight: 600;">
                    particular of joint applicant information:
                </p>
            </div>

            <div style="text-align: left; font-size: 12px; border: 1px solid black; padding: 5px; page-break-inside: avoid;">
                <p>Name of Account Holder : </p>
                <p>Father/Husband Name : </p>
                <p>Mother Name : </p>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 50%; color: red;">
                        Date Of Birth : 19-03-1987
                    </div>
                    <div style="float: left; width: 25%; color: purple;">
                        Sex : Male
                    </div>
                    <div style="float: left; width: 25%; color: purple;">
                        Occupation : {{ $client->occupation }}
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 25%; color: orange;">
                        Tel : {{ $client->mobile . ' ' }}
                    </div>
                    <div style="float: left; width: 25%; color: orange;">
                        Mobile : <strong style="text-decoration: underline; color: black;">{{ $client->mobile }}</strong>
                    </div>
                    <div style="float: left; width: 25%; color: orange;">
                        Email : {{ $client->email }}
                    </div>
                    <div style="float: left; width: 25%; color: orange;">
                        Fax: 546556
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 33%; color: blue;">
                        Mobile : 01713617913
                    </div>
                    <div style="float: left; width: 33%; color: blue;">
                        Email : s@gmail.com
                    </div>
                    <div style="float: left; width: 33%; color: blue;">
                        Fax : 17364373
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 50%; color: brown;">
                        Nationality : Bangladeshi
                    </div>
                    <div style="float: left; width: 50%; color: brown;">
                        National ID : 183276473843
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 25%; color: green;">
                        Passport No : 73768387
                    </div>
                    <div style="float: left; width: 25%; color: green;">
                        Issue Date : 27-03-76
                    </div>
                    <div style="float: left; width: 25%; color: green;">
                        Issue Place : Dhaka
                    </div>
                    <div style="float: left; width: 25%; color: green;">
                        Expiry Date : 27-03-76
                    </div>
                </div> <br>

                <p style="color: black;">Present Address :</p>
                <p style="color: black;">Permanent Address :</p>
            </div>


            <div class="mt-2">
                <p style="text-transform: uppercase; background-color: blue; color: #fff; text-align: left; width: 100%; padding: 3px; font-size: 14px; font-weight: 600;">
                    bank information:
                </p>
            </div>

            <div style="text-align: left; font-size: 12px; border: 1px solid black; padding: 5px; page-break-inside: avoid;">
                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 33%; color: red;">
                        Bank Name : Asia Bank
                    </div>
                    <div style="float: left; width: 33%; color: red;">
                        Branch Name : Tejgaon
                    </div>
                    <div style="float: left; width: 33%; color: red;">
                        District Name : Bangladesh
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 50%; color: purple;">
                        Routing No : {{ $client->mobile . ' ' }}
                    </div>
                    <div style="float: left; width: 50%; color: purple;">
                        Account No : <strong style="text-decoration: underline; color: black;">{{ $client->mobile }}</strong>
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 33%; color: orange;">
                        B/C : 01713617913
                    </div>
                    <div style="float: left; width: 33%; color: orange;">
                        SWIFT Code : 34535
                    </div>
                    <div style="float: left; width: 33%; color: orange;">
                        IBAN : 17364373
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 33%; color: green;">
                        Electronic Dividend Credit: Yes
                    </div>
                    <div style="float: left; width: 33%; color: green;">
                        Electronic Dividend Credit: Yes
                    </div>
                    <div style="float: left; width: 33%; color: green;">
                        TIN/Tax ID: 17364373
                    </div>
                </div> <br>
            </div>


            <div class="mt-2">
                <p style="text-transform: uppercase; background-color: blue; color: #fff; text-align: left; width: 100%; padding: 3px; font-size: 14px; font-weight: 600;">
                    particular of introducer:
                </p>
            </div>

            <div style="text-align: left; font-size: 12px; border: 1px solid black; padding: 5px; page-break-inside: avoid;">
                <p>
                    <span>Name of the Introducer :</span>
                </p>
                <p>Father/Husband Name :</p>
                <p>Mother Name :</p>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 50%; color: red;">
                        Sex : Male
                    </div>
                    <div style="float: left; width: 50%; color: red;">
                        Nationality : <strong style="text-decoration: underline;">Bangladeshi</strong>
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 33%; color: purple;">
                        Mobile : 01713617913
                    </div>
                    <div style="float: left; width: 33%; color: purple;">
                        National ID: 34535
                    </div>
                    <div style="float: left; width: 33%; color: purple;">
                        Email: s@gmail.com
                    </div>
                </div> <br>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 33%; color: orange;">
                        Electronic Dividend Credit: Yes
                    </div>
                    <div style="float: left; width: 33%; color: orange;">
                        Electronic Dividend Credit: Yes
                    </div>
                    <div style="float: left; width: 33%; color: orange;">
                        TIN/Tax ID: 17364373
                    </div>
                </div> <br>

                <p>
                    <span>Present Address :</span>
                </p>

                <div style="width: 100%; margin-bottom: 5px; overflow: auto;">
                    <div style="float: left; width: 50%; color: green;">
                        Internal Code No: Yes
                    </div>
                    <div style="float: left; width: 50%; color: green;">
                        Introducer's BO ID: 12066500
                    </div>
                </div> <br>

                <p>
                    I certify that I have shown <span>.......</span> for the last
                    <span>.......</span> years and confirm his/her signature, occupation, address, and other particulars elsewhere in the application.
                </p>
            </div>

            <div style="margin-top: 1rem;">
                <div style="overflow: hidden; width: 100%;">
                    <div style="float: left; width: calc(50% - 5px); margin-right: 10px;">
                        <div style="height: 60px; width: 100%; background-color: #80808082;"></div>
                        <p style="font-size: 12px; margin-top: 5px;">
                            Signature & Date of the Account Holder (1st Applicant)
                        </p>
                    </div>
                    <div style="float: left; width: calc(50% - 5px); margin-left: 10px;">
                        <div style="height: 60px; width: 100%; background-color: #80808082;"></div>
                        <p style="font-size: 12px; margin-top: 5px;">
                            Signature & Date of the Joint Account Holder (2nd Applicant)
                        </p>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div style="overflow: hidden; width: 100%; margin-top: 10px;">
                    <div style="float: left; width: calc(50% - 5px); margin-right: 10px;">
                        <div style="height: 60px; width: 100%; background-color: #80808082;"></div>
                        <p style="font-size: 12px; margin-top: 5px;">
                            Signature & Date of the 3rd Signatory (Artificial Body)
                        </p>
                    </div>
                    <div style="float: left; width: calc(50% - 5px); margin-left: 10px;">
                        <div style="height: 60px; width: 100%; background-color: #80808082;"></div>
                        <p style="font-size: 12px; margin-top: 5px;">
                            Signature & Date of the Person Introducing the Customer
                        </p>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>


            <div style="margin-top: 10px;">
                <p style="text-transform: uppercase; background-color: blue; color: #fff; text-align: left; width: 100%; padding: 3px; font-size: 14px; font-weight: 600; margin-bottom: 0;">
                    office only:
                </p>
                <div style="margin-top: 5px;">
                    <div style="width: 33.33%; float: left; margin-right: 20px;">
                        <div style="height: 60px; width: 100%; background-color: #80808082;"></div>
                    </div>
                    <div style="width: 33.33%; float: left; margin-right: 20px;">
                        <div style="height: 60px; width: 100%; background-color: #80808082;"></div>
                    </div>
                    <div style="width: 33.33%; float: left;">
                        <div style="height: 60px; width: 100%; background-color: #80808082;"></div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </div>


        </div>
    </div>
</body>
</html>
