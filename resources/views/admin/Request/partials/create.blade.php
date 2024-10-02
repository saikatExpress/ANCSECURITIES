<div class="container mt-3">
    <div class="card shadow-sm">
        <div class="card-header">
            <div style="display: flex;justify-content: space-between;align-items: center;">
                <div class="info_title">
                    <h4>ANC Securities Ltd.</h4>
                    <h6>DSE TREC No. 275</h6>
                    <p>
                        Alhaj Tower, Fourth Floor (Level-3),82,Mothijheel C/A, Dhaka - 1000
                    </p>
                </div>
                <div>
                    <p>Phone: +8801844-547916</p>
                    <p>Mobile: +8801844547918</p>
                    <p>Fax: (+880 2) 8881152</p>
                    <p>Email: ancsecuritieslimited@gmail.com</p>
                    <p>Web: https://ancsecurities.com/</p>
                </div>
            </div>
        </div>
        <h5 class="mb-0" style="text-align: center;background-color: teal;color: #fff;border-radius: 4px;padding: 5px;">
            Withdraw Request Details
        </h5>
        <div class="card-body">
            <h6 class="mb-3"><strong>Client Information</strong></h6>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Client Name:</strong> {{ $request->client_name }}</p>
                    <p><strong>Trading Code:</strong> {{ $request->clients->trading_code }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Account No:</strong> {{ $request->ac_no }}</p>
                    <p><strong>Withdraw Date:</strong> {{ date('d M, Y', strtotime($request->withdraw_date)) }}</p>
                </div>
            </div>

            <hr>

            <h6 class="mb-3"><strong>Transaction Details</strong></h6>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Amount:</strong> {{ number_format($request->amount, 2) }} BDT</p>
                    <p><strong>Status:</strong>
                        <span class="badge badge-{{ $request->status == 'pending' ? 'warning' : ($request->status == 'approved' ? 'success' : 'danger') }}">
                            {{ ucfirst($request->status) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Category:</strong> {{ ucfirst($request->category) }}</p>
                    <p><strong>In Words:</strong> {{ ucfirst(numberToWords($request->amount)) . ' taka only' }}</p>
                </div>
            </div>

            <hr>

            <h6 class="mb-3"><strong>Bank Details</strong></h6>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Bank Name:</strong> {{ $account->bank_name }}</p>
                    <p><strong>AC No:</strong>
                        {{ $request->ac_no }}
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Branch Name:</strong> {{ ucfirst($account->branch_name) }}</p>
                    <p><strong>Routing Number:</strong> {{ $request->clients->routing_number ?? 'N/A' }}</p>
                </div>
            </div>
            <hr>

            <h6 class="mb-3"><strong>Approval Details</strong></h6>
            <div class="row">
                <div class="col-md-6">
                    <p>
                        <strong>Created By:</strong>
                        {{ name($request->created_by) }}
                        <mark style="background-color: teal;color:#fff;border-radius:4px; padding:1px;">
                            account
                        </mark>
                    </p>
                    <p><strong>CEO:</strong> {{ $request->ceo ?? 'N/A' }}</p>
                    <p><strong>CEO Status:</strong>
                        <span class="badge badge-{{ $request->ceostatus == 'assign' ? 'warning' : ($request->ceostatus == 'approved' ? 'success' : 'danger') }}">
                            {{ ucfirst($request->ceostatus) }}
                        </span>
                    </p>
                    <p><strong>MD:</strong> {{ $request->MD ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Audit By:</strong>
                        {{ name($request->approved_by) }}
                        <mark style="background-color: teal;color:#fff;border-radius:4px; padding:1px;">
                            audit
                        </mark>
                    </p>
                    <p><strong>Approved By:</strong>
                        {{ name($request->approved_by) }}
                        <mark style="background-color: teal;color:#fff;border-radius:4px; padding:1px;">
                            audit
                        </mark>
                    </p>
                    <p><strong>Declined By:</strong> {{ $request->declined_by ?? 'N/A' }}</p>
                    <p><strong>MD Status:</strong>
                        <span class="badge badge-{{ $request->mdstatus == 'assign' ? 'warning' : ($request->mdstatus == 'approved' ? 'success' : 'danger') }}">
                            {{ ucfirst($request->mdstatus ?? 'Not assign') }}
                        </span>
                    </p>
                </div>
            </div>

            <hr>

            <h6 class="mb-3"><strong>Additional Files</strong></h6>
            <div class="row">
                <div class="col-md-6">
                    @if($request->portfolio_file != null)
                        <p>
                            <strong>Portfolio File:</strong>
                            <a href="{{ asset('storage/'.$request->portfolio_file) }}" target="_blank" class="btn btn-sm btn-secondary">
                                View Portfolio
                            </a>
                        </p>
                    @else
                        <p><strong>Portfolio File:</strong> Not Available</p>
                    @endif
                </div>
                <div class="col-md-6">
                    @if($request->bank_slip)
                        <p><strong>Bank Slip:</strong> <a href="{{ asset($request->bank_slip) }}" target="_blank" class="btn btn-sm btn-secondary">View Bank Slip</a></p>
                    @else
                        <p><strong>Bank Slip:</strong> Not Available</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer" style="width: 60%;">
            <div class="card">
                <div class="card-body">
                    @if (auth()->user()->role === 'ceo')
                        <p class="text-success">
                            <strong>N.B : </strong> When you approved this withdraw request,then managing director assign for this automatically.
                        </p>
                    @else
                        <p class="text-success">
                            <strong>N.B : </strong> When you approved this withdraw request,then account assign for this automatically.
                        </p>
                    @endif
                    <form action="{{ route('admin.updateReqStatus') }}" method="post">
                        @csrf
                        <input type="hidden" name="req_id" id="reqId" value="{{ $request->id }}">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option selected disabled value="">Select</option>
                                <option value="approved">Approve</option>
                                <option value="processing">Processing</option>
                                <option value="deny">Deny</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
<div id="statusFooter" class="status-footer">
    <p class="footer-text">Thank you for using ANC Securities. For inquiries, please contact our support.</p>
</div>
