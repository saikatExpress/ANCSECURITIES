<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .info_title p {
            margin-bottom: 0;
            font-size: 12px;
            font-weight: 600;
            color: #000;
        }
        .info_title h4 {
            margin-bottom: 0;
            font-size: 13px;
            font-weight: 600;
            color: #000;
        }

        .application_body {
            padding: 20px;
            border-radius: 8px;
        }
        .application_footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            text-align: left;
            vertical-align: middle;
            border: 1px solid #ddd;
            padding: 5px;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .signature_div p {
            margin-bottom: 0;
            text-align: center;
        }
        .signature_div h4 {
            margin-bottom: 0;
            text-align: center;
        }
        .signature_div img {
            width: 100px;
            height: 50px;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 33%; padding: 10px;">
                    <img style="width: 200px; height: auto;" src="{{ public_path('auth/logo.png') }}" alt="Logo">
                </td>
                <td style="width: 33%; padding: 10px;">
                    <h4 style="margin-bottom:0%; font-size:0.6rem; color:#000;">Corporate Office :</h4>
                    <p style="margin-bottom:0%; font-size:0.6rem; color:#000;">GME House, Plot #21, Road #13, Block-G</p>
                    <p style="margin-bottom:0%; font-size:0.6rem; color:#000;">Niketan, Gulshan-1, Dhaka- 1212, Bangladesh</p>
                    <p style="margin-bottom:0%; font-size:0.6rem; color:#000;">Tel: +880-9610-553355, Fax: +880-2-985-4412</p>
                </td>
                <td style="width: 33%; padding: 10px;">
                    <h4 style="margin-bottom:0%; font-size:0.6rem; color:#000;">Registered Office :</h4>
                    <p style="margin-bottom:0%; font-size:0.6rem; color:#000;">Monem Business District</p>
                    <p style="margin-bottom:0%; font-size:0.6rem; color:#000;">111 Bir Uttam CR Dutta Road</p>
                    <p style="margin-bottom:0%; font-size:0.6rem; color:#000;">Dhaka- 1205, Bangladesh</p>
                    <p style="margin-bottom:0%; font-size:0.6rem; color:#000;">Email: ancsecuritieslimited@gmail.com</p>
                    <p style="margin-bottom:0%; font-size:0.6rem; color:#000;">Tel: +880-9610-553355</p>
                </td>
            </tr>
        </table>

        <div class="application_body">
            <!-- Application Header -->
            <div class="mb-4 application-item">
                <p style="font-size: 0.8rem; color: #000;">Ref: ANCSL/BM/IFIC/08/2024/28</p>
                <p style="margin-bottom: 0%; font-size: 0.8rem; color: #000;">Date: 07.08.2024</p>
                <p style="margin-bottom: 0%; font-size: 0.8rem; color: #000;">To,</p>
                <p style="margin-bottom: 0%; font-size: 0.8rem; color: #000;">Manager</p>
                <p style="margin-bottom: 0%; font-size: 0.8rem; color: #000;">IFIC Bank Limited</p>
                <p style="margin-bottom: 0%; font-size: 0.8rem; color: #000;">Stock Exchange Branch</p>
                <p style="margin-bottom: 0%; font-size: 0.8rem; color: #000;">Mothijheel C/A</p>
                <p style="margin-bottom: 0%; font-size: 0.8rem; color: #000;">Dhaka- 1000</p>
            </div>

            <!-- Subject -->
            <div class="mb-4">
                <p style="font-size: 0.8rem; color: #000;">Sub: Transfer to fund under BEFTN/RTGS agreement</p>
            </div>

            <!-- Salutation and Body Text -->
            <div class="mb-4">
                <p style="font-size: 0.8rem; line-height: 1.4rem; color: #000;">Dear Sir,</p>
                <p style="font-size: 0.8rem; line-height: 1.4rem; color: #000;">
                    We ANC Securities Limited request you to kindly transfer the amount of the following respective bank accounts
                    by debiting from our account bearing no: <b>0210100402041</b>, Account Name: <b>ANC Securities Limited CCA</b>
                </p>
            </div>

            <!-- Request Info Table -->
            <div class="mb-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="font-size: 0.7rem;">S.I</th>
                            <th style="font-size: 0.7rem;">Receiver Name</th>
                            <th style="font-size: 0.7rem;">Receiving A/C NO.</th>
                            <th style="font-size: 0.7rem;">Bank Name</th>
                            <th style="font-size: 0.7rem;">Routing Number</th>
                            <th style="font-size: 0.7rem;">Branch Name</th>
                            <th style="font-size: 0.7rem;">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sl = 1;
                            $totalAmount = 0;
                        @endphp
                        @foreach ($withdraws as $withdraw)
                            <tr>
                                <td style="font-size: 0.7rem;">{{ 0 . $sl }}</td>
                                <td style="font-size: 0.7rem;">{{ $withdraw->client_name }}</td>
                                <td style="font-size: 0.7rem;">{{ $withdraw->clients->bank_account_no }}</td>
                                <td style="font-size: 0.7rem;">{{ $withdraw->clients->bank_name }}</td>
                                <td style="font-size: 0.7rem;"></td>
                                <td style="font-size: 0.7rem;">{{ $withdraw->clients->branch_name }}</td>
                                <td style="font-size: 0.7rem;">{{ number_format($withdraw->amount) }}</td>
                            </tr>
                            @php
                                $sl++;
                                $totalAmount += $withdraw->amount;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="6" style="text-align: right;">Total</td>
                            <td>{{ number_format($totalAmount) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="application_footer">
                <p style="font-size: 0.8rem; color: #000;">In Word Total= {{ ucfirst(numberToWords($totalAmount)) . ' taka only' }}</p>
                <p style="font-size: 0.8rem; color: #000;">Your Cooperation in this regard will be highly appreciated.</p>
                <p style="font-size: 0.8rem; color: #000;">Thanks & Regards</p>
            </div>
        </div>

        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="width: 25%; text-align: center;">
                    <div class="signature_div">
                        <img src="https://www.signwell.com/assets/vip-signatures/muhammad-ali-signature-3f9237f6fc48c3a04ba083117948e16ee7968aae521ae4ccebdfb8f22596ad22.svg" alt="">
                        <h4 style="font-size: 0.8rem; color: #000; margin-bottom:0%;">{{ $md->name }}</h4>
                        <p style="font-size: 0.7rem; color: #000;margin-bottom:0%;">Managing Director</p>
                        <p style="font-size: 0.7rem; color: #000;margin-bottom:0%;">Anc Securities Limited</p>
                    </div>
                </td>
                <td style="width: 25%; text-align: center;">
                    <div class="signature_div">
                        <img src="https://www.signwell.com/assets/vip-signatures/muhammad-ali-signature-3f9237f6fc48c3a04ba083117948e16ee7968aae521ae4ccebdfb8f22596ad22.svg" alt="">
                        <h4 style="font-size: 0.8rem; color: #000; margin-bottom:0%;">{{ ucfirst($head->name) }}</h4>
                        <p style="font-size: 0.7rem; color: #000; margin-bottom:0%;">Head of Business</p>
                        <p style="font-size: 0.7rem; color: #000;margin-bottom:0%;">Anc Securities Limited</p>
                    </div>
                </td>
                <td style="width: 25%; text-align: center;">
                    <div class="signature_div">
                        <img src="https://www.signwell.com/assets/vip-signatures/muhammad-ali-signature-3f9237f6fc48c3a04ba083117948e16ee7968aae521ae4ccebdfb8f22596ad22.svg" alt="">
                        <h4 style="font-size: 0.8rem; color: #000; margin-bottom:0%;">Rana Quraishi</h4>
                        <p style="font-size: 0.7rem; color: #000;margin-bottom:0%;">Audit</p>
                        <p style="font-size: 0.7rem; color: #000;margin-bottom:0%;">Anc Securities Limited</p>
                    </div>
                </td>
                <td style="width: 25%; text-align: center;">
                    <div class="signature_div">
                        <img src="https://www.signwell.com/assets/vip-signatures/muhammad-ali-signature-3f9237f6fc48c3a04ba083117948e16ee7968aae521ae4ccebdfb8f22596ad22.svg" alt="">
                        <h4 style="font-size: 0.8rem; color: #000; margin-bottom:0%;">{{ $ceo->name }}</h4>
                        <p style="font-size: 0.7rem; color: #000;margin-bottom:0%;">Chief Executive Officer</p>
                        <p style="font-size: 0.7rem; color: #000;margin-bottom:0%;">Anc Securities Limited</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
