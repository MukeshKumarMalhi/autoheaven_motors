@extends('layouts.app')
@section('title','Finance')

@section('content')

<!-- section 1 - title -->
<div class="pt-r10 bg-center-url" style="background-image: url('{{ asset('web_asset/images/bg-car-title-img.png') }}');">
    <div class="container text-light">
        <div class="row">
            <div class="offset-1 offset-sm-0 col-10 col-sm-8 col-md-6 col-lg-4 cm-bg-danger-x header-title-top py-80">
                <div class="position-r">
                    <h1>Finance</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section 1-->
<div class="pt-r10 bg-center-url" style="background-image: url('{{ asset('web_asset/images/bg-finance-img1.jpg') }}');">
    <div class="container py-80">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-1">HELPS YOU TO FIND YOUR NEXT CAR EASILY</p>
                <h2><span class="text-danger">Finance</span></h2>
                <p>Are you looking for car, van or motorbike finance? With 20+ years
                    in the trade, ShoKarz Finance with their experienced team can
                    cater for all circumstances. <br/> <br/>

                    If you are looking for a no deposit finance deal on your next car,
                    van or motorbike, they can help! You can apply on-line 24/7
                    using the finance application form. <br/> <br/>

                    Apply online at https://www.shokarz.com/
                    If you prefer to talk to a member of the team, they are available
                    7 days per week on 01926 498 434. Office opening hours from
                    9-6 Monday to Friday, 9-5 Saturday & 11-3 on Sunday.</p>
            </div>
        </div>
    </div>
</div>
<div class="py-4">
    <div class="container">
        <h2><span class="text-danger">Contact</span> Details</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididu et dolore magna aliqua. Ut enim ad minim veniam, Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididu et dolore magna aliqua. Ut enim ad minim veniam,</p>
        <div class="enquiry_form">
          <form id="steps-form" role="form" class="finance_form" method="post" novalidate>
              <div class="row">
                  <div class="form-group col-sm-6 col-md-4">
                      <input type="text" name="name" class="form-control" placeholder="Full name" required>
                  </div>
                  <div class="form-group col-sm-6 col-md-4">
                      <input type="email" name="email" class="form-control" placeholder="Email address" required>
                  </div>
                  <div class="form-group col-sm-6 col-md-4">
                      <input type="tel" name="phone" class="form-control" placeholder="Phone number" required>
                  </div>
              </div>
              <div class="form-group">
                  <textarea class="form-control" rows="5" name="info_message" placeholder="Additional information" required></textarea>
              </div>
              <div class="form-group clearfix">
                  <button type="submit" class="btn btn-lg btn-danger submit_enquiry_button">Send</button>
                  <div class="float-right"><img src="{{ asset('web_asset/images/ssl-secure.png') }}" class="img-fluid" alt=""></div>
              </div>
          </form>
          <div class="loader" style="display:none;"><i class="fas fa-sync fa-spin fa-3x fa-fw"></i></div>
      </div>
        <script type="text/javascript">
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
                        $('.submit_enquiry_button').prop('disabled', true);
                        $(".loader").show();
                        $(".enquiry_form form").css('opacity','0.5');
                      },
                });
            });
        </script>
    </div>
</div>
<!-- <div class="py-4">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-7 offset-1">
                <h2>Buy Sell Your <span class="text-danger">Car Quickly & Easily</span></h2>
                <p>Labore dolore magna aliqua minim ipsum veniamquis nostrud exercitation</p>
            </div>
            <div class="col-md-4 text-center">
                <a href="/sell-your-car" class="btn btn-lg btn-danger">GET REGISTERED</a>
                <p>Call Us For Booking Vehicle</p>
            </div>
        </div>
    </div>
</div> -->

<script type="text/javascript">
$(document).ready(function(){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.finance_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('/store_finance_form') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      // beforeSend: function () {
      //    $('.enquiry_form').append('<div class="loader"><i class="fas fa-sync fa-spin fa-3x fa-fw"></i></div>');
      //    $('.submit_enquiry_button').prop('disabled', true);
      //    $(".enquiry_form .loader").show();
      //    $(".enquiry_form form").css('opacity','0.5');
      //  },
      success:function(data){
        if(data.failure){
          $(".loader").hide();
          $(".enquiry_form form").css('opacity','1');
          $('.enquiry_form').html('');
          $('.enquiry_form').append('<h2 class="text-danger">'+data.failure[0]+'</h2>');
        }else if (data.success) {
          $(".loader").hide();
          $(".enquiry_form form").css('opacity','1');
          $('.enquiry_form').html('');
          $('.enquiry_form').append('<div class="mx-auto" style="width:80%;"><h2 class="text-danger">'+data.success+'</h2><p>We will aim to get back to you as soon as possible.</p></div>');
          $('.enquiry_form').css('text-align', 'center');
        }
      },
    });
  });
});
</script>
<style media="screen">
.form-control{
  border-radius: 5px;
}
.enquiry_form{position: relative;}
.enquiry_form .loader{position:absolute;width:100%; display:block;left:50%;top:40%;transform: translate(-50%,-50%);text-align:center; z-index: 1;}
</style>
@endsection
