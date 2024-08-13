<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .info_title p{
            margin-bottom: 0;
            font-size: 12px;
            font-weight: 600;
            color: #000;
        }
        .info_title h4{
            margin-bottom: 0;
            font-size: 13px;
            font-weight: 600;
            color: #000;
        }

        .application_body {
            padding: 20px;
            border-radius: 8px;
            margin: 20px;
        }
        .application_footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
        .table th, .table td {
            text-align: left;
            vertical-align: middle;
        }
        .table td{
            font-size: 12px;
            color: #000;
        }
        .signature_div p{
            margin-bottom: 0;
            text-align: center;
        }

        .signature_div h4{
            margin-bottom: 0;
            text-align: center;
        }

        .signature_div img{
            width: 100px;
            height: 50px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <div style="display: flex;justify-content: space-between; margin-bottom: 70px;">
                        <div class="info_title">
                            <img style="width: 200px;height: auto;" src="{{ asset('auth/logo.png') }}" alt="Logo">
                        </div>

                        <div class="info_title">
                            <h4>Corporate Office : </h4>
                            <p>GME House, Plot #21, Road #13, Block-G</p>
                            <p>Niketan, Gulshan-1, Dhaka- 1212, Bangladesh</p>
                            <p>
                                Tel: +880-9610-553355, Fax: +880-2-985-4412
                            </p>
                        </div>

                        <div class="info_title">
                            <h4>Registered Office : </h4>
                            <p>Monem Business District</p>
                            <p>111 Bir Uttam CR Dutta Road</p>
                            <p>Dhaka- 1205, Bangladesh</p>
                            <p>Email: ancsecuritieslimited@gmail.com</p>
                            <p>Tel: +880-9610-553355</p>
                        </div>
                    </div>

                    <div class="info_body">
                        <div class="application_body">
                            <!-- Application Header -->
                            <div class="mb-4 application-item">
                                <p style="font-size:0.8rem;color:#000;">Ref: ANCSL/BM/IFIC/08/2024/28</p>
                                <p style="margin-bottom: 0%; font-size:0.8rem;color:#000;">Date: 07.08.2024</p>
                                <p style="margin-bottom: 0%; font-size:0.8rem;color:#000;">To,</p>
                                <p style="margin-bottom: 0%; font-size:0.8rem;color:#000;">Manager</p>
                                <p style="margin-bottom: 0%; font-size:0.8rem;color:#000;">IFIC Bank Limited</p>
                                <p style="margin-bottom: 0%; font-size:0.8rem;color:#000;">Stock Exchange Branch</p>
                                <p style="margin-bottom: 0%; font-size:0.8rem;color:#000;">Mothijheel C/A</p>
                                <p style="margin-bottom: 0%; font-size:0.8rem;color:#000;">Dhaka- 1000</p>
                            </div>

                            <!-- Subject -->
                            <div class="mb-4">
                                <p style="font-size: 0.8rem;color:#000;">Sub: Transfer to fund under BEFTN/RTGS agreement</p>
                            </div>

                            <!-- Salutation and Body Text -->
                            <div class="mb-4">
                                <p style="font-size: 0.8rem;line-height: 1.4rem;color: #000;">Dear Sir,</p>
                                <p style="font-size: 0.8rem;line-height: 1.4rem;color: #000;">
                                    We ANC Securities Limited request you to kindly transfer the amount of the following respective bank accounts
                                    by debiting from our account bearing no: <b>0210100402041</b>, Account Name: <b>ANC Securities Limited CCA</b>
                                </p>
                            </div>

                            <!-- Request Info Table -->
                            <div class="mb-4">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>S.I</th>
                                            <th>Receiver Name</th>
                                            <th>Receiving A/C NO.</th>
                                            <th>Bank Name</th>
                                            <th>Routing Number</th>
                                            <th>Branch Name</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>{{ $bankInfo->name }}</td>
                                            <td>{{ $bankInfo->bank_account_no }}</td>
                                            <td>{{ $bankInfo->bank_name }}</td>
                                            <td></td>
                                            <td>{{ $bankInfo->branch_name }}</td>
                                            <td>{{ number_format($withdraw->amount) }}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total</td>
                                            <td>{{ number_format($withdraw->amount) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Application Footer -->
                            <div class="application_footer">
                                <p style="font-size: 0.8rem;color:#000;">In Word Total= {{ ucfirst(numberToWords($withdraw->amount)) . ' taka only' }}</p>
                                <p style="font-size: 0.8rem;color:#000;">Your Cooperation in this regard will be highly appreciated.</p>

                                <p style="font-size: 0.8rem;color:#000;">Thanks & Regards</p>
                            </div>
                        </div>
                        <div style="display: flex; justify-content:space-between; align-items:center;">
                            <div class="signature_div">
                                @if ($withdraw->mdstatus === 'approved')
                                    <img src="https://www.signwell.com/assets/vip-signatures/muhammad-ali-signature-3f9237f6fc48c3a04ba083117948e16ee7968aae521ae4ccebdfb8f22596ad22.svg" alt="">
                                @endif
                                <h4 style="font-size: 1rem;color:#000;">Md. Mahmud Alam</h4>
                                <p style="font-size: 0.8rem;color:#000;">Managing Director</p>
                                <p>Anc Securities Limited</p>
                            </div>
                            <div class="signature_div">
                                @if ($staff->signature != NULL)
                                    <img src="{{ asset('storage/staffSignature/' . $staff->signature) }}" alt="">
                                @endif
                                <h4 style="font-size: 1rem;color:#000;">{{ $staff->name }}</h4>
                                <p style="font-size: 0.8rem;color:#000;">Head of Business</p>
                                <p>Anc Securities Limited</p>
                            </div>
                            <div class="signature_div">
                                <img src="https://www.signwell.com/assets/vip-signatures/muhammad-ali-signature-3f9237f6fc48c3a04ba083117948e16ee7968aae521ae4ccebdfb8f22596ad22.svg" alt="">
                                <h4 style="font-size: 1rem;color:#000;">Rana Quraishi</h4>
                                <p style="font-size: 0.8rem;color:#000;">Audit</p>
                                <p>Anc Securities Limited</p>
                            </div>
                            <div class="signature_div">
                                @if ($withdraw->ceostatus === 'approved')
                                    <img src="https://www.signwell.com/assets/vip-signatures/muhammad-ali-signature-3f9237f6fc48c3a04ba083117948e16ee7968aae521ae4ccebdfb8f22596ad22.svg" alt="">
                                @endif
                                <h4 style="font-size: 1rem;color:#000;">Mohammed Monirul Islam</h4>
                                <p style="font-size: 0.8rem;color:#000;">Chief Executive Officer</p>
                                <p>Anc Securities Limited</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
