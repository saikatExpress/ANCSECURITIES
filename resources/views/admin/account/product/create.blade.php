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
            <a href="" class="btn btn-sm btn-primary">
                Product List
            </a>
        </p>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add Product</h3>

                @if(session('message'))
                    <div class="alert alert-success" id="successAlert">{{ session('message') }}</div>
                @endif

                @if(session('errors'))
                    <div class="alert alert-danger errorAlert">{{ session('errors') }}</div>
                @endif

            </div>
            <form action="{{ route('product.store') }}" method="POST">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="">Product Head</label>
                        <input type="text" name="product_head" class="form-control">
                        @error('product_head')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="name" class="form-control">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="product-type">Product Type</label>
                        <select class="form-control" id="product-type" name="product_type" required>
                            <option value="" disabled selected>Select Product Type</option>
                            <option value="Computer">Computer</option>
                            <option value="Router">Router</option>
                            <option value="Food Item">Food Item</option>
                            <option value="Chair">Chair</option>
                            <option value="Table">Table</option>
                        </select>
                        @error('product_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product-model">Product Model</label>
                        <input type="text" class="form-control" id="product-model" name="product_model" required>
                        @error('product_model')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product-quantity">Quantity</label>
                        <input type="number" class="form-control" id="product-quantity" name="quantity" required>
                        @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="assign-to">Assign To</label>
                        <select class="form-control" id="assign-to" name="assign_to">
                            <option value="" disabled selected>Select Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                        @error('assign_to')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<script src="{{ asset('admin/assets/js/watch.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#successAlert').show();

        setTimeout(function() {
            $('#successAlert').fadeOut('slow');
        }, 3000);

        $('.errorAlert').show();

        setTimeout(function() {
            $('.errorAlert').fadeOut('slow');
        }, 3000);
    });
</script>
@endsection
