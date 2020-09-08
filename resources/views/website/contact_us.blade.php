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
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididu et dolore magna aliqua. Ut enim ad minim veniam, Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididu et dolore magna aliqua. Ut enim ad minim veniam,</p>
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
                    <h6 class="font-weight-normal">Call Us Today!</h6>
                    <a class="font-weight-bold" href="tel:+17553028549">+1 755 302 8549</a>
                </div>
            </div>
            <div class="media mb-4">
                <div class="pr-2">
                    <div class="fa-cm-circle border rounded-circle border-dark text-danger"><i class="fas fa-envelope"></i></div>
                </div>
                <div class="media-body">
                    <h6 class="font-weight-normal">Email Us!</h6>
                    <a class="font-weight-bold" href="mailto:support@autohaven.com">support@autohaven.com</a>
                </div>
            </div>
            <div class="media mb-4">
                <div class="pr-2">
                    <div class="fa-cm-circle border rounded-circle border-dark text-danger"><i class="fas fa-map-marker-alt"></i></div>
                </div>
                <div class="media-body">
                    <h6 class="font-weight-normal">Location</h6>
                    <a class="font-weight-bold" href="https://www.google.com/maps?ll=34.093027,-118.016801&z=16&t=m&hl=en&gl=US&mapclient=embed&q=Fairview+St+El+Monte,+CA+91732+USA"> Fairview Ave, El Monte, CA 91732</a>
                </div>
            </div>
            <div class="media mb-4">
                <div class="pr-2">
                    <div class="fa-cm-circle border rounded-circle border-dark text-danger"><i class="fas fa-clock"></i></div>
                </div>
                <div class="media-body">
                    <h6 class="font-weight-normal">Opening Time</h6>
                    <p class="font-weight-bold"> 9:00am to 6:00pm | Mon to Fri</p>
                </div>
            </div>
            <div class="mb-4">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.0825059376534!2d-118.01898938453874!3d34.093026780594855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2d9f98036ef47%3A0x962605a9ff27fd75!2sFairview%20St%2C%20El%20Monte%2C%20CA%2091732%2C%20USA!5e0!3m2!1sen!2s!4v1599030195883!5m2!1sen!2s" width="100%" height="400" frameborder="0" style="border:0;width:100%;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
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
