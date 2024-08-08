<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Portfolio Statement | Anc Securities</title>
    <link rel="shortcut icon" href="{{ asset('auth/ANCSECURITIES.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #007bff;
            padding: 10px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            color: #fff;
            font-size: 18px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: #0056b3;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 60px);
        }

        .upload-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .upload-box h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .file-input {
            display: none;
        }

        .file-label {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }

        .file-label:hover {
            background-color: #0056b3;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="{{ route('portfolio.list') }}">PDF List</a>
        <a href="{{ route('admin.dashboard') }}">Home</a>
        <a href="/upload-folder">Upload Folder</a>
        <a href="{{ route('delete.portfolio') }}">Delete PDF</a>
    </div>

    <div class="container">
        <div class="upload-box">
            @if (session('message'))
                <div id="flash-message" class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <h1>Upload Portfolio Statement</h1>

            <!-- Message prompting users to delete previous portfolio statement -->
            <div class="alert alert-danger" role="alert">
                Please first delete the previous portfolio statement from the menu bar and then upload a new portfolio statement.
            </div>

            <form id="uploadForm" enctype="multipart/form-data">
                <label for="pdfs" class="file-label">Choose Folder</label>
                <input type="file" name="pdfs[]" id="pdfs" class="file-input" multiple webkitdirectory accept="application/pdf">
                <button type="submit">Upload PDFs</button>
            </form>

            <div id="progress">0 / 0</div>
            <div id="loader" style="display:none;">Uploading...</div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                let files = $('#pdfs')[0].files;
                let batchSize = 10;
                let totalFiles = files.length;
                let formData, startIndex, endIndex, uploadedFiles = 0;

                function updateProgress() {
                    $('#progress').text(`${uploadedFiles} / ${totalFiles}`);
                }

                function uploadBatch(startIndex) {
                    if (startIndex >= totalFiles) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'All files uploaded successfully!',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '{{ route('admin.dashboard') }}';
                            }
                        });
                        return;
                    }

                    endIndex = Math.min(startIndex + batchSize, totalFiles);
                    formData = new FormData();

                    for (let i = startIndex; i < endIndex; i++) {
                        formData.append('pdfs[]', files[i]);
                    }

                    $.ajax({
                        url: '/upload-pdfs',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function(){
                            $('#loader').show();
                        },
                        complete: function(){
                            $('#loader').hide();
                        },
                        success: function(response) {
                            uploadedFiles += endIndex - startIndex; // Update count of uploaded files
                            updateProgress(); // Update progress
                            uploadBatch(endIndex); // Continue with the next batch
                        },
                        error: function(response) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error uploading files.'
                            });
                        }
                    });
                }

                // Initialize progress display
                $('#progress').text(`0 / ${totalFiles}`);
                uploadBatch(0);
            });

            $('.file-label').click(function() {
                $('#pdfs').click();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Check if the message exists and then fade out after 3 seconds
            $('#flash-message').delay(3000).fadeOut('slow');
        });
    </script>
</body>
</html>
