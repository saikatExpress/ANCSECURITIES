@extends('user.layout.app')

@section('content')
<div class="container my-5">
    <h2 class="text-center mb-4">Photo Gallery</h2>
    <div class="row">
        <!-- Repeat this block for each image in your gallery -->
        <div class="col-md-4 mb-4">
            <a href="path/to/large-image1.jpg" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
                <img src="https://letsenhance.io/static/8f5e523ee6b2479e26ecc91b9c25261e/1015f/MainAfter.jpg" class="img-fluid rounded shadow">
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="path/to/large-image2.jpg" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
                <img src="https://letsenhance.io/static/8f5e523ee6b2479e26ecc91b9c25261e/1015f/MainAfter.jpg" class="img-fluid rounded shadow">
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="path/to/large-image3.jpg" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
                <img src="https://letsenhance.io/static/8f5e523ee6b2479e26ecc91b9c25261e/1015f/MainAfter.jpg" class="img-fluid rounded shadow">
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="path/to/large-image3.jpg" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
                <img src="https://letsenhance.io/static/8f5e523ee6b2479e26ecc91b9c25261e/1015f/MainAfter.jpg" class="img-fluid rounded shadow">
            </a>
        </div>
        <div class="col-md-4 mb-4">
            <a href="path/to/large-image3.jpg" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
                <img src="https://letsenhance.io/static/8f5e523ee6b2479e26ecc91b9c25261e/1015f/MainAfter.jpg" class="img-fluid rounded shadow">
            </a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include Bootstrap and Lightbox JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
<script>
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });
</script>
@endsection
