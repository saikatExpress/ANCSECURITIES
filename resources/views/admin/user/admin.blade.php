@extends('admin.layout.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <x-sub-header/>
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold">Admin</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
            <p style="text-align: right;">
                <a class="btn btn-sm btn-primary" href="{{ route('create.user') }}">
                    Create User
                </a>
                <a class="btn btn-sm btn-success" href="{{ route('user.list') }}">
                    User List
                </a>
                <a class="btn btn-sm btn-success" href="{{ route('active.user') }}">
                    Active User
                </a>
            </p>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Admin List</h4>
                </div>
                <div class="card-boy">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Signature</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Whatsapp</th>
                                <th>Joined On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="bo-table-body">
                            @foreach ($admins as $user)
                                <tr class="list-item">
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        <img style="width: 55px;height:55px;border-radius:4px;box-shadow:0 0 10px;" src="{{ asset('storage/user_photo/profile/' . $user->profile_image) }}" alt="">
                                    </td>
                                    <td>
                                        <img style="width: 55px;height:55px;border-radius:4px;box-shadow:0 0 10px;" src="{{ asset('storage/user_photo/signature/' . $user->signature) }}" alt="">
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{ $user->mobile }}
                                    </td>
                                    <td>
                                        <a href="https://api.whatsapp.com/send?phone=880{{ $user->whatsapp }}" target="_blank">
                                            {{ $user->whatsapp }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $user->created_at->format('d-M-Y') }}
                                    </td>
                                    @if ($user->status === 'active')
                                        <td>
                                            <label for="" class="btn btn-sm btn-success">Active</label>
                                        </td>
                                    @else
                                        <td>
                                            <label for="" class="btn btn-sm btn-danger">Deactive</label>
                                        </td>
                                    @endif
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary userBtn"
                                            data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}" data-mobile="{{ $user->mobile }}"
                                            data-whatsapp="{{ $user->whatsapp }}" data-status="{{ $user->status }}"
                                            data-role="{{ $user->role }}" data-profileImage="{{ $user->profile_image }}"
                                            data-signature="{{ $user->signature }}"
                                            data-toggle="modal" data-target="#userModal">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="userModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit User</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="userId" id="userId">
                        <div class="form-group">
                            <label for="">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" id="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Mobile <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="mobile" id="mobile">
                            @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Whatsapp <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="whatsapp" id="whatsapp">
                            @error('whatsapp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="fileInputsContainer">
                            <div class="form-group">
                                <label for="">Upload Image</label>
                                <input type="file" name="profile_image" id="profile_image" class="form-control">
                                @error('profile_image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="profileImg">
                                    <img style="width: 85px;height:85px;border-radius:4px;box-shadow:0 0 10px;" id="profileImg" alt="">
                                </div>
                            </div>
                        </div>

                        <div id="fileInputsContainer">
                            <div class="form-group">
                                <label for="">Upload Signature</label>
                                <input type="file" name="signature" id="signature" class="form-control">
                                @error('signature')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="signatureImg">
                                    <img style="width: 85px;height:85px;border-radius:4px;box-shadow:0 0 10px;" src="" id="signatureImg" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="" disabled selected>Select</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" disabled selected>Select</option>
                                <option value="active">Active</option>
                                <option value="deactive">Deactive</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Info</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('admin/assets/js/watch.js') }}"></script>
    <script src="{{ asset('admin/assets/js/admin.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
@endsection
