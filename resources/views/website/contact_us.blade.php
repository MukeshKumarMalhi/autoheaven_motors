@extends('layouts.app')
@section('title','Contact Us')

@section('content')

<!-- section 1 - title -->
<div class="pt-r10 bg-center-url" style="background-image: url('{{ ('web_asset/images/bg-car-title-img.png') }}');">
    <div class="container text-light">
        <div class="row">
            <div class="offset-1 offset-sm-0 col-10 col-sm-8 col-md-6 col-lg-4 cm-bg-danger-x header-title-top py-80">
                <div class="position-r">
                    <h1>Contact Us</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section 1-->
<div class="container py-80">
    <div class="row">
        <div class="col-md-6">
            <p class="mb-1">HELPS YOU TO FIND YOUR NEXT CAR EASILY</p>
            <h2><span class="text-danger">Lets</span>  We talk</h2>
            <p>At AUTOHAVEN MOTORS LIMITED, we stock a range of used cars at great prices.</p>
            <p>If for any reason you can't find what you're looking for in stock, please contact us and we will be happy to help you find the right car.</p>
            <div class="mt-5 contact_container">

                 <form id="steps-form" novalidate class="contact_us_form" role="form" method="post">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Full name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control" placeholder="Phone number" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email address" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="8" name="info_message" placeholder="Message" required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger send_button">Send</button>
                    </div>
                </form>
                <div class="loader" style="display:none;"><i class="fas fa-sync fa-spin fa-3x fa-fw"></i></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="media mb-4">
                <div class="pr-2">
                    <div class="fa-cm-circle border rounded-circle border-dark text-danger"><i class="fas fa-phone"></i></div>
                </div>
                <div class="media-body">
                    <h6 class="font-weight-bold">Call Us Today!</h6>
                    <a class="font-weight-bold">07967 881489</a>
                </div>
            </div>
            <div class="media mb-4">
                <div class="pr-2">
                    <div class="fa-cm-circle border rounded-circle border-dark text-danger"><i class="fas fa-envelope"></i></div>
                </div>
                <div class="media-body">
                    <h6 class="font-weight-bold">Email Us!</h6>
                    <a class="font-weight-bold">Sales@autohavenmotors.co.uk</a>
                </div>
            </div>
            <div class="media mb-4">
                <div class="pr-2">
                    <div class="fa-cm-circle border rounded-circle border-dark text-danger"><i class="fas fa-map-marker-alt"></i></div>
                </div>
                <div class="media-body">
                    <h6 class="font-weight-bold">Location</h6>
                    <a class="font-weight-bold" href="https://www.google.com/maps/place/29+Salisbury+Rd,+High+Wycombe+HP13+6UL,+UK/@51.6391342,-0.7336998,17z/data=!3m1!4b1!4m5!3m4!1s0x4876604b4afb024b:0x33b77a10ec7eb3b0!8m2!3d51.6391342!4d-0.7315111"> 29 Salisbury Rd High Wycombe HP13 6UL UK</a>
                </div>
            </div>
            <div class="media mb-4">
                <div class="pr-2">
                    <div class="fa-cm-circle border rounded-circle border-dark text-danger"><i class="fas fa-clock"></i></div>
                </div>
                <div class="media-body">
                    <h6 class="font-weight-bold">Opening Time</h6>
                    <p class="font-weight-bold">Monday to Sunday | Appointment Only</p>
                </div>
            </div>
            <div class="mb-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2476.1303696207633!2d-0.7336997841182175!3d51.63913750888318!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876604b4afb024b%3A0x33b77a10ec7eb3b0!2s29%20Salisbury%20Rd%2C%20High%20Wycombe%20HP13%206UL%2C%20UK!5e0!3m2!1sen!2sus!4v1599733093624!5m2!1sen!2sus" width="100%" height="400" frameborder="0" style="border:0;width:100%;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.contact_us_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('/store_contact_us_form') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        if(data.failure){
          $(".loader").hide();
          $(".contact_container form").css('opacity','1');
          $('.contact_container').html('');
          $('.contact_container').append('<h2 class="text-danger">'+data.failure[0]+'</h2>');
        }else if (data.success) {
          $(".loader").hide();
          $(".contact_container form").css('opacity','1');
          $('.contact_container').html('');
          $('.contact_container').append('<h2 class="text-danger">'+data.success+'</h2>');
          $('.contact_container').append('<p>We will aim to get back to you as soon as possible.</p>');
          $('.contact_container').css('text-align', 'center');
        }
      },
    });
  });

});

$(function() {
    var form2 = $('#steps-form');
        form2.validate({
                  errorElement: 'span',
                  errorClass: 'help-block',
                  highlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-group').addClass("has-error");
                  },
                  unhighlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-group').removeClass("has-error");
                  },
                  rules: {
                      phone: {
                        number: true,
                      },
                      email: {
                        email:true,
                      },
                 },
                messages: {
                       name: "Name can not be blank ",
                       email: {
                           required: "Email can not be blank",
                           email: "Your email address must be in the format of name@domain.com"
                       },
                       phone: {
                           required: "Number can not be blank",
                           number: "Please enter a number"
                       },
               },
               submitHandler: function(form) {
                  $('.send_button').prop('disabled', true);
                  $(".loader").show();
                  $(".contact_container form").css('opacity','0.5');
                },
        });
    });
</script>
<style media="screen">
.form-control{
  border-radius: 5px;
}
.contact_container{position: relative;}
.contact_container .loader{position:absolute;width:100%; display:block;left:50%;top:40%;transform: translate(-50%,-50%);text-align:center; z-index: 1;}
</style>
@endsection
