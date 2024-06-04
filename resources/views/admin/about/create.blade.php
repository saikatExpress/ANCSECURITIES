@extends('admin.layout.app')
<style>
    .image-preview {
        max-width: 200px;
        max-height: 200px;
        margin-top: 10px;
    }
    .image-preview-container {
        display: flex;
        flex-wrap: wrap;
    }
    .image-preview-item {
        margin: 10px;
        position: relative;
    }
    .remove-button {
        position: absolute;
        top: 5px;
        right: 5px;
        cursor: pointer;
    }
    .about_head{
        text-align: center;
        font-weight: 600;
        font-size: 30px;
        color: teal;
        text-decoration: underline;
        padding: 5px 8px 5px;
    }

    .about_page{
        width: 95%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 5px 8px 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 4px;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <strong class="text-sm text-success fw-bold">Admin</strong>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">{{ $pageTitle }}</li>
            </ol>
            <p style="text-align: right;">
                <a class="btn btn-sm btn-primary" href="{{ route('form.list') }}">
                    Form List
                </a>
            </p>
        </section>

        <section class="content">

            @if(session('message'))
                <div class="alert alert-success" id="successAlert">
                    {{ session('message') }}
                </div>
            @endif

            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Create About</h3>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="box-body">
                            <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ $about->title }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Quote</label>
                                    <input type="text" class="form-control" name="block_quote" value="{{ $about->block_quote }}">
                                    @error('block_quote')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control">{{ $about->description }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div id="fileInputsContainer">
                                    <div class="form-group">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="images[]" class="form-control" onchange="previewImage(this)">
                                         @error('images')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-secondary" onclick="addFileInput()">Add More</button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                            <div id="imagePreviewsContainer" class="image-preview-container"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="about_head">About Page</h4>

                        <div class="about_page">
                            <div>
                                <h2>Title : </h2>
                                <p>
                                    {{ $about->title }}
                                </p>
                                <h2>Quote : </h2>
                                <blockquote>{{ $about->block_quote }}</blockquote>
                                <h2>
                                    Description :
                                </h2>
                                <p>
                                    {{ $about->description }}
                                </p>
                            </div>
                            @php
                                $filenames = explode(',', $about->about_images);
                            @endphp
                            @foreach ($filenames as $filename)
                                <div style="margin-bottom: 10px;">
                                    <img style="width: 100px;height:100px; border-radius:4px;margin-left:10px;" src="{{ asset('storage/about_images/' . $filename) }}" alt="{{ $filename }}" style="max-width: 300px;">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Show the alert message
            $('#successAlert').show();

            // Hide the alert message after 3 seconds
            setTimeout(function() {
                $('#successAlert').fadeOut('slow');
            }, 3000);
        });
    </script>

    <script>
        function addFileInput() {
            // Create a new div for the file input
            var newDiv = document.createElement('div');
            newDiv.classList.add('form-group');

            // Create a new file input
            var newFileInput = document.createElement('input');
            newFileInput.type = 'file';
            newFileInput.name = 'images[]';
            newFileInput.classList.add('form-control');
            newFileInput.onchange = function() {
                previewImage(this);
            };

            // Add the file input to the div
            newDiv.appendChild(newFileInput);

            // Append the div to the container
            document.getElementById('fileInputsContainer').appendChild(newDiv);
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Create a new image element
                    var newImage = document.createElement('img');
                    newImage.src = e.target.result;
                    newImage.classList.add('image-preview');

                    // Create a new div for the image preview
                    var newImageDiv = document.createElement('div');
                    newImageDiv.classList.add('image-preview-item');

                    // Add the image to the div
                    newImageDiv.appendChild(newImage);

                    // Create a remove button
                    var removeButton = document.createElement('button');
                    removeButton.textContent = 'Remove';
                    removeButton.classList.add('btn', 'btn-danger', 'remove-button');
                    removeButton.onclick = function() {
                        newImageDiv.remove();
                        input.value = ''; // Clear the file input value
                    };

                    // Add the remove button to the div
                    newImageDiv.appendChild(removeButton);

                    // Append the div to the preview container
                    document.getElementById('imagePreviewsContainer').appendChild(newImageDiv);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
