@extends('user.layout.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@section('content')

<section id="main-container" class="main-container">
  <div class="container">

    <div class="row text-center">
      <div class="col-12">
        <h2 class="section-title">Reaching our Office</h2>
        <h3 class="section-sub-title">Find Our Location</h3>
      </div>
    </div>


    <div class="row">
      <div class="col-md-4">
        <div class="ts-service-box-bg text-center h-100">
          <span class="ts-service-icon icon-round">
            <i class="fas fa-map-marker-alt mr-0"></i>
          </span>
          <div class="ts-service-box-content">
            <h4>Visit Our Office</h4>
            <p>Al Haj Tower,4th floor(Level-03),82 Mothijheel C/A, Dhaka -1100, Bangladesh.</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="ts-service-box-bg text-center h-100">
          <span class="ts-service-icon icon-round">
            <i class="fa fa-envelope mr-0"></i>
          </span>
          <div class="ts-service-box-content">
            <h4>Email Us</h4>
            <p>ancsecuritieslimited@gmail.com</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="ts-service-box-bg text-center h-100">
          <span class="ts-service-icon icon-round">
            <i class="fa fa-phone-square mr-0"></i>
          </span>
          <div class="ts-service-box-content">
            <h4>Call Us</h4>
            <p>(+88) 01844-547916</p>
          </div>
        </div>
      </div>

    </div>

    <div class="gap-60"></div>

    <div class="google-map">
      <div id="map" class="map" data-latitude="23.7279609" data-longitude="90.3362455" data-marker="{{ asset('user/assets/theme/images/marker.png') }}" data-marker-name="Constra"></div>
    </div>

    <div class="gap-40"></div>

    <div class="row">
      <div class="col-md-12">
        <h3 class="column-title">We love to hear</h3>

        <form id="contactform" action="{{ route('contact.store') }}" method="post">
            @csrf
          <div class="error-container"></div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Name</label>
                <input class="form-control form-control-name" name="name" id="name" placeholder="" type="text">
                <span class="text-sm text-danger" id="nameErr"></span>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Email</label>
                <input class="form-control form-control-email" name="email" id="email" placeholder="" type="email">
                <span class="text-sm text-danger" id="emailErr"></span>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Subject</label>
                <input class="form-control form-control-subject" name="subject" id="subject" placeholder="">
                <span class="text-sm text-danger" id="subErr"></span>
                @error('subject')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>
          <div class="form-group">
            <label>Message</label>
            <textarea class="form-control form-control-message" name="message" id="message" placeholder="" rows="10"></textarea>
            <span class="text-sm text-danger" id="messageErr"></span>
            @error('message')
                <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="text-right"><br>
            <button class="btn btn-primary solid blank" type="submit">Send Message</button>
          </div>
        </form>
        <div>
            <h6 class="text-success" id="messageSuccesMsg"></h6>
        </div>
        <div id="contactLoader" style="display: none;">
            <img style="width: 50px; height:50px; border-radius:50%; box-shadow:0 0 10px rgba(0,0,0,0.1);" src="{{ asset('auth/new-loader.gif') }}" alt="">
        </div>
      </div>

    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function(){
        $('#contactform').on('submit', function(e){
            e.preventDefault();

            var name = $('#name').val().trim();
            var email = $('#email').val().trim();
            var subject = $('#subject').val().trim();
            var message = $('#message').val().trim();

            $('#nameErr').html('');
            $('#emailErr').html('');
            $('#subErr').html('');
            $('#messageErr').html('');

            if(name == ''){
                $('#nameErr').html('Name is required..*');
                return;
            }

            if(email == ''){
                $('#emailErr').html('Email is required..*');
                return;
            }

            if(subject == ''){
                $('#subErr').html('Subject must be is required..*');
                return;
            }

            if(message == ''){
                $('#messageErr').html('Message is required..*');
                return;
            }

            var data = $(this).serialize();
            data += '&_token={{ csrf_token() }}';

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data:data,
                beforeSend: function(){
                    $('#contactLoader').show();
                },
                complete: function(){
                    $('#contactLoader').hide();
                },
                success: function(response){
                    $('#contactform')[0].reset();
                    $('#messageSuccesMsg').html('Message Sent successfully..!');
                },
                error: function(error){
                    console.log(error);
                }
            });
        });
    });
</script>
@endsection
