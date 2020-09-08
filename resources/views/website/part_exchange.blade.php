@extends('layouts.app')
@section('title','Part Exchange')

@section('content')

<!-- section 1 - title -->
<div class="pt-r10 bg-center-url" style="background-image: url('{{ ('web_asset/images/bg-car-title-img.png') }}');">
    <div class="container text-light">
        <div class="row">
            <div class="offset-1 offset-sm-0 col-10 col-sm-8 col-md-6 col-lg-4 cm-bg-danger-x header-title-top py-80">
                <div class="position-r">
                    <h1>Part Exchange Your Vehicle Today</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section 1-->

    <div class="container py-80">
        <div class="mb-5">
            <p class="mb-1">HELPS YOU TO FIND YOUR NEXT CAR EASILY</p>
            <h1><span class="text-danger">Part Exchange</span> Your Vehicle Today</h1>
            <p>If you already have a vehicle you may consider opting for a part exchange. A part exchange allows you to put the value of your old vehicle towards the cost of your new one and if you're thinking of purchasing your next vehicle on finance, a part exchange could cover your deposit and even reduce your monthly payments.</p>
            <br/>
        </div>
        <div class="bg-danger p-5 text-light link-light bg-center-url" style="background-image: url('{{ asset('web_asset/images/bg-red-car-img.png') }}');">
            <div class="row">
                <div class="col-md-6">
                    <h2>Get a quote on your current vehicle</h2>
                    <p>If you already have a vehicle you may consider opting for a part exchange. A part exchange allows you to put the value of your old vehicle towards the cost of your new one and if you're thinking of purchasing your next vehicle on finance, a part exchange could cover your deposit and even reduce your monthly payments.</p>
                    <button class="btn btn-light text-danger font-weight-bold" data-toggle="bs-collapse" data-target="#get-a-quote">Get a quote</button>
                </div>
            </div>
        </div>
    </div>

<div id="get-a-quote" class="py-4 collapse">

    <div class="container part_container">
            <ul id="stepform-check" class="list-unstyled">
                <li class="step1-p active"><h4 class="font-weight-bold text-danger mb-2">1. Your vehicle details</h4></li>
                <li class="step2-p"><h4 class="font-weight-bold text-danger mb-2">2. Your contact details</h4></li>
            </ul>
            <form id="steps-form" class="part_exchange_form" role="form" method="post" novalidate>
              @csrf
                <section class="active step1">
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-4">
                            <select class="form-control" name="vehicle_type" required>
                                <option value="" disabled selected>Vehicle type</option>
                                <option value="Car">Car</option>
                                <option value="Bike">Bike</option>
                                <option value="Van">Van</option>
                                <option value="Caravan">Caravan</option>
                                <option value="Motorhome">Motorhome</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <input type="text" name="company" class="form-control" placeholder="Make" required>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <input type="text" name="model" class="form-control" placeholder="Model" required>
                        </div>
                       <div class="form-group col-sm-6 col-md-4">
                            <input type="text" name="vehicle_reg" class="form-control" placeholder="Vehicle registration" required>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <input type="text" name="mileage" class="form-control" placeholder="Mileage" required>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <input type="text" name="condition" class="form-control" placeholder="condition" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-lg btn-danger step-next">Continue to Step 2</button>
                    </div>
                </section>

                <section class="step2">
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-4">
                            <input type="text" name="full_name" class="form-control" placeholder="Full name" required>
                        </div>
                        <div class="form-group col-sm-6 col-md-4">
                            <input type="tel" name="phone_number" class="form-control" placeholder="Phone number" required>
                        </div>
                       <div class="form-group col-sm-6 col-md-4">
                            <input type="email" name="email_address" class="form-control" placeholder="Email address" required>
                      </div>
                    </div>
                    <h4 class="font-weight-bold text-danger mb-2 d-md-inline-block">Best time to call you?</h4>
                    <div class="form-group d-md-inline-block">
                                <div class="form-check form-check-inline bs-custom-radio mb-2">
                                    <input type="radio" name="best_time_to_call" checked class="form-check-input" value="morning" id="morning">
                                    <label class="form-check-label d-inline" for="morning">Morning</label>
                                </div>
                                <div class="form-check form-check-inline bs-custom-radio mb-2">
                                    <input type="radio" name="best_time_to_call" class="form-check-input" value="afternoon" id="Afternoon">
                                    <label class="form-check-label d-inline" for="Afternoon">Afternoon</label>
                                </div>
                                <div class="form-check form-check-inline bs-custom-radio mb-2">
                                    <input type="radio" name="best_time_to_call" class="form-check-input" value="evening" id="Evening">
                                    <label class="form-check-label d-inline" for="evening">Evening</label>
                                </div>
                            </div>

                    <p>By submitting this enquiry, you agree to sending your details to us and any third parties we use to process enquiries so that we may contact you regarding your enquiry</p>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-danger submit_button">Submit</button>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-lg  btn-danger step-previous submit_button">previous to Step 1</button>
                    </div>
                </section>
            </form>
            <div class="loader" style="display:none;"><i class="fas fa-sync fa-spin fa-3x fa-fw"></i></div>
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
                <a href="#" class="btn btn-lg btn-danger">GET REGISTERED</a>
                <p>Call Us For Booking Vehicle</p>
            </div>
        </div>
    </div>
</div> -->

<script type="text/javascript">
$(function() {
    var form2 = $('#steps-form');
    $(".step-next").click(function(){
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
                    $('.submit_button').prop('disabled', true);
                    $(".loader").show();
                    $(".part_container form").css('opacity','0.5');
                  },
            });
            if (form2.valid() === true){
              if ($('.step1').is(":visible")){
                current_fs = $('.step1');
                next_fs = $('.step2');
                step_fs = $("#stepform-check li.step2-p");
              }else if($('.step2').is(":visible")){
                current_fs = $('.step2');
                next_fs = $('.step3');
                  step_fs = $("#stepform-check li.step3-p");
              }
                next_fs.show();
                current_fs.hide();
                step_fs.addClass("active")
            }
    });
    $('.step-previous').click(function(){
        if($('.step2').is(":visible")){
            current_fs = $('.step2');
            next_fs = $('.step1');
            step_prs_fs = $("#stepform-check li.step2-p");
        }else if ($('.step3').is(":visible")){
            current_fs = $('.step3');
            next_fs = $('.step2');
            step_prs_fs = $("#stepform-check li.step3-p");
        }
        next_fs.show();
        current_fs.hide();
        step_prs_fs.removeClass("active")
    });
});

$(document).ready(function(){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.part_exchange_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('/store_part_exchange') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        if(data.failure){
          $(".loader").hide();
          $(".part_container form").css('opacity','1');
          $('.part_container').html('');
          $('.part_container').append('<h2 class="text-danger">'+data.failure[0]+'</h2>');
        }else if (data.success) {
          $(".loader").hide();
          $(".part_container form").css('opacity','1');
          $('.part_container').html('');
          $('.part_container').append('<h2 class="text-danger">'+data.success+'</h2>');
          $('.part_container').append('<p>We will aim to get back to you as soon as possible.</p>');
          $('.part_container').css('text-align', 'center');
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
.part_container{position: relative;}
.part_container .loader{position:absolute;width:100%; display:block;left:50%;top:40%;transform: translate(-50%,-50%);text-align:center; z-index: 1;}
</style>
@endsection
