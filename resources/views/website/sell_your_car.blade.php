@extends('layouts.app')
@section('title','Sell your vehicle')

@section('content')

<!-- section 1 - title -->
<div class="pt-r10 bg-center-url" style="background-image: url('{{ asset('web_asset/images/bg-car-title-img.png') }}');">
    <div class="container text-light">
        <div class="row">
            <div class="offset-1 offset-sm-0 col-10 col-sm-8 col-md-6 col-lg-4 cm-bg-danger-x header-title-top py-80">
                <div class="position-r">
                    <h1>Sell Your Car</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section 1-->
<div class="pt-r10 bg-center-url" style="background-image: url('{{ asset('web_asset/images/bg-car-img1.jpg') }}');">
    <div class="container py-80">
        <div class="row">
                <div class="col-md-6">
                <p class="mb-1">HELPS YOU TO FIND YOUR NEXT CAR EASILY</p>
                <h2><span class="text-danger">Sell</span> Your Car</h2>
                <p>Are you looking to sell your car fast? We will value your car within 24 hours and will buy quickly.<br/><br/>We take our time to analyse the information provided. This ensures the price we send is inline with current market conditions. Our online valuation is fair and we often give more money than other car buying companies once we have seen the vehicle.<br/><br/> Whether you want to use the money as a deposit on your next vehicle or you just want some extra cash, at Earlsdon Motor Company Ltd we offer a great, no obligation vehicle buying service.<br/><br/> No admin fees like other companies and we aim to complete the whole process within 30 minutes from you arriving to vehicle inspection, completing all paperwork and payment.<br/><br/> If you would like to sell your car to us, then tell us as much about your vehicle as you can using the form below and a member of our team will get back to you as soon as possible.</p>
                <br/>
                <a href="#" class="btn btn-danger mr-2 mb-2">View Details</a>   <a href="#">25 Photos</a>
            </div>
        </div>
    </div>
</div>
<div class="py-4">
    <div class="container sell_container">
            <ul id="stepform-check" class="list-unstyled">
                <li class="step1-p active"><h4 class="font-weight-bold text-danger mb-2">1. Your vehicle details</h4></li>
                <li class="step2-p"><h4 class="font-weight-bold text-danger mb-2">2. Vehicle condition</h4></li>
                <li class="step3-p"><h4 class="font-weight-bold text-danger mb-2">3. Contact details</h4></li>
            </ul>
            <form id="steps-form" class="sell_your_car_form" role="form" method="post" novalidate>
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
                        <div class="col-sm-6 col-md-4"></div>
                        <div class="form-group col-sm-6 col-md-8">
                            <textarea class="form-control" rows="5" name="vehicle_come_with_specify" placeholder="Did your vehicle come with any optional extras? If so, please specify" required></textarea>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <h4 class="font-weight-bold text-danger mb-2">Service history</h4>
                            <div class="form-group">
                                <div class="form-check bs-custom-radio mb-2">
                                    <input type="radio" name="service_history" checked class="form-check-input" value="full_service_history" id="Full-service-history">
                                    <label class="form-check-label d-inline" for="Full-service-history">Full service history</label>
                                </div>
                                <div class="form-check bs-custom-radio mb-2">
                                    <input type="radio" name="service_history" class="form-check-input" value="partial_service_history" id="Partial-service-history">
                                    <label class="form-check-label d-inline" for="Partial-service-history">Partial service history</label>
                                </div>
                                <div class="form-check bs-custom-radio mb-2">
                                    <input type="radio" name="service_history" class="form-check-input" value="first_service_not_due" id="First-service-not-due">
                                    <label class="form-check-label d-inline" for="First-service-not-due">First service not due</label>
                                </div>
                                <div class="form-check bs-custom-radio mb-2">
                                    <input type="radio" name="service_history" class="form-check-input" value="no_service_history" id="No-service-history">
                                    <label class="form-check-label d-inline" for="No-service-history">No service history</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-lg btn-block btn-danger step-next">Continue to Step 1</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="step2">
                    <div class="row" >
                        <div class="form-group col-sm-6 col-md-8">
                            <div class="form-group">
                                <select class="form-control" name="vehicle_condition" required>
                                    <option value="" disabled selected>Vehicle Condition </option>
                                    <option value="no">No damage</option>
                                    <option value="minor">Minor damage</option>
                                    <option value="medium">Medium damage</option>
                                    <option value="major">Major damage</option>
                                    <option value="needs_replacement">Needs replacement</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" name="vehicle_damage_condition_description" placeholder="Describe any damage to the vehicle in as much detail as possible" required></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="form-group">
                                <button type="button" class="btn btn-lg  btn-danger step-previous">previous to Step 1</button>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-lg  btn-danger step-next ">Continue to Step 2</button>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="step3">
                    <div class="row">
                        <div class="form-group col-sm-6 col-md-8">
                            <div class="form-group">
                                <input type="text" name="full_name" class="form-control" placeholder="Full name" required>
                            </div>
                            <div class="form-group">
                              <input type="text" name="phone_number" class="form-control" placeholder="Phone number" required>
                            </div>
                            <div class="form-group">
                              <input type="text" name="email_address" class="form-control" placeholder="Email address" required>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                          <div class="form-group">
                              <button type="button" class="btn btn-lg  btn-danger step-previous submit_button">previous to Step 2</button>
                          </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-danger step-next submit_button">Submit</button>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
            <div class="loader" style="display:none;"><i class="fas fa-sync fa-spin fa-3x fa-fw"></i></div>


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
                                $(".sell_container form").css('opacity','0.5');
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
        </script>
    </div>
</div>
<div class="py-4">
    <div class="container">
      <?php  if(count($preferred_cars) > 0){ ?>
        <h3 class="text-danger mb-4">Preferred Supplier List</h3>
        <div class="row">
        <?php foreach ($preferred_cars as $key => $preferred) {
            $category_name = strtolower(str_replace(' ', '-', $preferred->category_name));
            $car_model = strtolower(str_replace(' ', '-', $preferred->model));
            $car_id = $preferred->id;
            $car_detail = $category_name."-".$car_model."_".$car_id;
        ?>
          <div class="col-md-3">
            <div class="bg-white border">
              <div class="mb-1">
                <a href="{{ url('/used-cars') }}/{{ $car_detail }}">
                  <img src="<?php echo asset('storage/'.$preferred->featured_image); ?>" class="img-fluid">
                </a>
              </div>
              <div class="text-left p-2">
                <h4 class="text-danger">{{ $preferred->category_name }} {{ $preferred->model }} {{ $preferred->name }}</h4>
                <h5>£{{ number_format($preferred->price) }}</h5>
              </div>
            </div>
          </div>
          <?php
            }
          ?>
        </div>
      <?php
      }
      ?>

        <!-- <div class="row mt-5">
            <div class="col-md-7 offset-1">
                <h2>Buy Sell Your <span class="text-danger">Car Quickly & Easily</span></h2>
                <p>Labore dolore magna aliqua minim ipsum veniamquis nostrud exercitation</p>
            </div>
            <div class="col-md-4 text-center">
                <a href="#" class="btn btn-lg btn-danger">GET REGISTERED</a>
                <p>Call Us For Booking Vehicle</p>
            </div>
        </div> -->
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.sell_your_car_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('/store_sell_your_car') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        if(data.failure){
          $(".loader").hide();
          $(".sell_container form").css('opacity','1');
          $('.sell_container').html('');
          $('.sell_container').append('<h2 class="text-danger">'+data.failure[0]+'</h2>');
        }else if (data.success) {
          $(".loader").hide();
          $(".sell_container form").css('opacity','1');
          $('.sell_container').html('');
          $('.sell_container').append('<h2 class="text-danger">'+data.success+'</h2>');
          $('.sell_container').append('<p>We will aim to get back to you as soon as possible.</p>');
          $('.sell_container').css('text-align', 'center');
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
.sell_container{position: relative;}
.sell_container .loader{position:absolute;width:100%; display:block;left:50%;top:40%;transform: translate(-50%,-50%);text-align:center; z-index: 1;}
</style>
@endsection
