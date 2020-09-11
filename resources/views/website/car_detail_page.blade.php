@extends('layouts.app')
@section('title','Details page')

@section('content')
<!-- section 1 - title -->
<div class="pt-r10 bg-center-url" style="background-image: url('{{ asset('web_asset/images/bg-car-title-img.png') }}');">
    <div class="container text-light">
        <div class="row">
            <div class="offset-1 offset-sm-0 col-10 col-sm-8 col-md-6 col-lg-4 cm-bg-danger-x header-title-top py-80">
                <div class="position-r">
                    <h1>Used Car</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- section 1-->

<div class="py-4">
    <div class="container">
        <div class="mb-3"><a href="{{ url('/used-cars') }}"><i class="far fa-chevron-double-left"></i> View all our used cars</a></div>
        <div class="row">
            <div class="col-md-7 col-lg-9 mb-3">
                <!-- <div class="float-right">
                    <span class="text-gold">
                        <div class="star-rating text-gold" title="100%" style="display: inline-block;margin:0px;padding:0px">
                            <div class="back-stars">
                                <i class="far fa-star" aria-hidden="true"></i>
                                <i class="far fa-star" aria-hidden="true"></i>
                                <i class="far fa-star" aria-hidden="true"></i>
                                <i class="far fa-star" aria-hidden="true"></i>
                                <i class="far fa-star" aria-hidden="true"></i>
                                <div class="front-stars" style="width: 100%">
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                    <i class="fas fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </span>
                    <strong>(1,025)</strong>
                </div> -->
                <h3 class="font-weight-bold">{{ $car_detail->category_name }} {{ $car_detail->model }} {{ $car_detail->name }} {{ $car_detail->engine_size }} {{ $car_detail->number_of_doors }}dr</h3>
                <!-- <h5 class="font-weight-normal">FSH+12 MONTHS MOT</h5> -->
            </div>
        </div>

        <div class="row">
            <div class="col-md-7 col-lg-9 mb-3">
                <div class="bs-gallery-box text-light link-light mb-3 pt-2">
                    <div>
                        <span data-src="<?php echo asset('storage/'.$car_detail->featured_image); ?>" data-fancybox="cars-gallery"><img src="<?php echo asset('storage/'.$car_detail->featured_image); ?>" class="img-fluid w-100" alt="" /></span>
                        <?php
                          if($car_detail->car_images != null){
                            foreach ($car_detail->car_images as $key => $value){
                        ?>
                        <span data-src="<?php echo asset('storage/'.$value); ?>" data-thumb="<?php echo asset('storage/'.$value); ?>" data-fancybox="cars-gallery"></span>
                        <?php
                            }
                          }
                          ?>
                    </div>
                    <div class="clearfix bs-gallery-bottom-box">
                        <span class="float-left click-fancybox"><i class="fal fa-camera"></i>@if($car_detail->car_images != null) View photos ({{ count($car_detail->car_images) }}) @endif</span>
                        <span class="float-right"><i class="fal fa-star"></i></span>
                    </div>
                </div>
                <?php
                  $category_name = strtolower(str_replace(' ', '-', $car_detail->category_name));
                  $car_model = strtolower(str_replace(' ', '-', $car_detail->model));
                  $car_id = $car_detail->id;
                  $car_de = $category_name."-".$car_model."_".$car_id;
                ?>
                <div class="row align-items-end mb-4">
                  <div class="col-md-4">
                    <a href="{{ url('/used-cars') }}/finance/{{ $car_de }}" class="btn btn-outline-dark btn-block mt-2 mr-2">Apply for finance</a>
                  </div>
                  <div class="col-md-4">
                    <a href="{{ url('/used-cars') }}/part-exchange/{{ $car_de }}" class="btn btn-danger btn-block mt-2 mr-2">Part excange enquiry</a>
                  </div>
                  <div class="col-md-4">
                    <a class="btn btn-danger btn-block mt-2 mr-2 text-white">Get a insurance quote</a>
                  </div>
                </div>


                <h3 class="text-danger">This car comes with</h3>
                <p>{{ $car_detail->description }}</p>

                <hr>

                <h3>Key facts</h3>

                <div class="row text-center">
                    <div class="col-6 col-lg-3">
                        <div class="border p-3 mb-3">
                            <p class="mb-1">Model year:</p>
                            <h3 class="text-danger">{{ $car_detail->model_year }}</h3>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="border p-3 mb-3">
                            <p>Fuel type:</p>
                            <h3 class="text-danger">{{ $car_detail->fuel_type }}</h3>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="border p-3 mb-3">
                            <p>Mileage:</p>
                            <h3 class="text-danger">{{ number_format($car_detail->mileage) }}</h3>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="border p-3 mb-3">
                            <p>Transmission:</p>
                            <h3 class="text-danger">{{ $car_detail->gearbox_type }}</h3>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="border p-3 mb-3">
                            <p>Engine size:</p>
                            <h3 class="text-danger">{{ $car_detail->engine_size }}L</h3>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="border p-3 mb-3">
                            <p>Colour:</p>
                            <h3 class="text-danger">{{ $car_detail->colour }}</h3>
                        </div>
                    </div>
                </div>

                <p>{{ $car_detail->car_history }}</p>


                <!-- Vehicle summary -->
                <div class="card mb-3 bs-collapse-danger">
                    <div class="card-header bg-white">
                      <h4 class="bs-fa-chevron-collapse mb-0 text-danger link-danger">
                        <a data-toggle="bs-collapse" class="collapsed d-block" href="#vehicle-summary">
                           <span class="float-right"><i class="far" aria-hidden="true"></i></span> Vehicle Summary</a>
                        </h4>
                    </div>
                    <div id="vehicle-summary" class="collapse" aria-expanded="false">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 border table-right-last">
                                    <tbody>
                                    <tr>
                                        <th>Body style</th>
                                        <td>{{ $car_detail->body_style }}</td>
                                    </tr>
                                    <tr>
                                        <th>Engine size</th>
                                        <td itemprop="vehicleEngine">{{ $car_detail->vehicle_summaries['engine_size_cc'] ? $car_detail->vehicle_summaries['engine_size_cc']." cc" : "" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fuel type</th>
                                        <td itemprop="fuelType">{{ $car_detail->fuel_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>Number of doors</th>
                                        <td itemprop="numberOfDoors">{{ $car_detail->number_of_doors ? $car_detail->number_of_doors." doors" : "" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Number of seats</th>
                                        <td itemprop="vehicleSeatingCapacity">{{ $car_detail->number_of_seats ? $car_detail->number_of_seats." seats" : "" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gearbox type</th>
                                        <td itemprop="vehicleTransmission">{{ $car_detail->gearbox_type }}</td>
                                    </tr>
                                    <tr>
                                        <th>CO2 emissions</th>
                                        <td>{{ $car_detail->vehicle_summaries['co2_emissions'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Insurance group</th>
                                        <td>{{ $car_detail->vehicle_summaries['co2_emissions'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Standard manufacturer's warranty (miles)</th>
                                        <td>{{ $car_detail->vehicle_summaries['standard_manufacturers_warranty_miles'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Standard manufacturer's warranty (years)</th>
                                        <td>{{ $car_detail->vehicle_summaries['standard_manufacturers_warranty_years'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Standard paintwork guarantee</th>
                                        <td>{{ $car_detail->vehicle_summaries['standard_paintwork_guarantee'] }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Performance & economy -->
                <div class="card mb-3 bs-collapse-danger">
                    <div class="card-header bg-white">
                      <h4 class="bs-fa-chevron-collapse mb-0 text-danger link-danger">
                        <a data-toggle="bs-collapse" class="collapsed d-block" href="#performance-economy">
                           <span class="float-right"><i class="far" aria-hidden="true"></i></span> Performance & economy</a>
                        </h4>
                    </div>
                    <div id="performance-economy" class="collapse" aria-expanded="false">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 border table-right-last">
                                    <tbody><tr>
                                        <th>Fuel consumption (urban)</th>
                                        <td>{{ $car_detail->performance_economies['fuel_consumption_urban'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fuel consumption (extra urban)</th>
                                        <td>{{ $car_detail->performance_economies['fuel_consumption_extra_urban'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fuel consumption (combined)</th>
                                        <td itemprop="fuelConsumption">{{ $car_detail->performance_economies['fuel_consumption_combined'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>0 - 60 mph</th>
                                        <td>{{ $car_detail->performance_economies['zero_sixty_mph'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Top speed</th>
                                        <td>{{ $car_detail->performance_economies['top_speed'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Cylinders</th>
                                        <td>{{ $car_detail->performance_economies['cylinders'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Valves</th>
                                        <td>{{ $car_detail->performance_economies['valves'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Engine power</th>
                                        <td>{{ $car_detail->performance_economies['engine_power'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Engine torque</th>
                                        <td>{{ $car_detail->performance_economies['engine_torque'] }}</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dimensions -->
                <div class="card mb-3 bs-collapse-danger">
                    <div class="card-header bg-white">
                      <h4 class="bs-fa-chevron-collapse mb-0 text-danger link-danger">
                        <a data-toggle="bs-collapse" class="collapsed d-block" href="#dimensions">
                           <span class="float-right"><i class="far" aria-hidden="true"></i></span> Dimensions</a>
                        </h4>
                    </div>
                    <div id="dimensions" class="collapse" aria-expanded="false">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-right-last mb-0 border">
                                    <tbody><tr>
                                        <th>Height</th>
                                        <td>{{ $car_detail->dimension['height'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Height inclusive of roof rails</th>
                                        <td>{{ $car_detail->dimension['height_inclusive_of_roof_rails'] ? $car_detail->dimension['height_inclusive_of_roof_rails'] : "No details available" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Length</th>
                                        <td>{{ $car_detail->dimension['length'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Wheelbase</th>
                                        <td>{{ $car_detail->dimension['wheelbase'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Width</th>
                                        <td>{{ $car_detail->dimension['width'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Width including mirrors</th>
                                        <td>{{ $car_detail->dimension['width_including_mirrors'] ? $car_detail->dimension['width_including_mirrors'] : "No details available" }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fuel tank capacity</th>
                                        <td>{{ $car_detail->dimension['fuel_tank_capacity'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Minimum kerb weight</th>
                                        <td>{{ $car_detail->dimension['minimum_kerb_weight'] }}</td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Interior/exterior -->
                <div class="card mb-3 bs-collapse-danger">
                    <div class="card-header bg-white">
                      <h4 class="bs-fa-chevron-collapse mb-0 text-danger link-danger">
                        <a data-toggle="bs-collapse" class="collapsed d-block" href="#interior-exterior">
                           <span class="float-right"><i class="far" aria-hidden="true"></i></span> Interior/exterior</a>
                        </h4>
                    </div>
                    <div id="interior-exterior" class="collapse" aria-expanded="false">
                        <div class="card-body pb-1">
                            <div class="table-responsive">
                              <div class="row no-gutters">
                                <div class="col-lg-6">
                                  <table class="table table-striped mb-0 border mb-3" style="table-layout: fixed;">
                                      <thead>
                                      <tr>
                                          <th>Interior features</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          if($car_detail->interior_features != null){
                                            foreach ($car_detail->interior_features as $key => $interior){
                                        ?>
                                          <tr>
                                              <td>{{ $interior }}</td>
                                          </tr>
                                        <?php
                                         }
                                        }
                                        ?>
                                      </tbody>
                                  </table>
                                </div>
                                <div class="col-lg-6">
                                  <table class="table table-striped mb-0 border mb-3" style="table-layout: fixed;">
                                      <thead>
                                      <tr>
                                          <th>Exterior features</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          if($car_detail->exterior_features != null){
                                            foreach ($car_detail->exterior_features as $key => $exterior){
                                        ?>
                                          <tr>
                                              <td>{{ $exterior }}</td>
                                          </tr>
                                        <?php
                                         }
                                        }
                                        ?>
                                      </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Safety -->
                <div class="card mb-3 bs-collapse-danger">
                    <div class="card-header bg-white">
                      <h4 class="bs-fa-chevron-collapse mb-0 text-danger link-danger">
                        <a data-toggle="bs-collapse" class="collapsed d-block" href="#safety">
                           <span class="float-right"><i class="far" aria-hidden="true"></i></span> Safety</a>
                        </h4>
                    </div>
                    <div id="safety" class="collapse" aria-expanded="false">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0 border">
                                    <tbody>
                                      <?php
                                        if($car_detail->safeties != null){
                                          foreach ($car_detail->safeties as $key => $safet){
                                      ?>
                                        <tr>
                                            <td>{{ $safet }}</td>
                                        </tr>
                                      <?php
                                       }
                                      }
                                      ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <p><strong>Please note</strong><br/>This includes MPG figures which are calculated under European Standards, in test conditions, and will vary under normal driving conditions. The information displayed above describes the typical specification of the most recent model of this vehicle. It is not the exact specification for the actual vehicle being offered for sale which may vary. Specifications for older models may also vary. Please contact us prior to purchase to confirm the exact specification of this vehicle.</p>
            </div>
            <div class="col-md-5 col-lg-3 mb-3">
                <div class="border text-center p-3 mb-3">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <p class="mb-1">Price</p>
                            <h3> £2,950</h3>
                        </div>
                        <div class="col">
                            <img src="{{ asset('web_asset/images/at-pi-revise-indicator-fair.svg') }}" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>

                <div class="bg-danger text-center link-light text-light p-3 mb-3">
                    <h3>07857 229579</h3>
                    <p class="mb-1">Find us</p>
                </div>

                <div class="enquiry_form">
                <form id="EnquiryFormComponent" method="post" role="form" class="py-4 mb-4 enquiry_data_form">
                    <!-- make breaker -->
                    <h4>Enquire about this vehicle</h4>
                    <div class="form-group">
                        <input type="text" id="sideEnquiryName" name="name" placeholder="Your Full Name *" class="formText form-control" required>
                        <input type="hidden" name="car_id" value="{{ $car_detail->id }}">
                        <input type="hidden" name="category_name" value="{{ $car_detail->category_name }}">
                        <input type="hidden" name="model" value="{{ $car_detail->model }}">
                    </div>
                    <div class="form-group">
                        <input type="text" id="sideEnquiryTel" name="phone" placeholder="Your Phone Number *" class="formTelephone form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="sideEnquiryEmail" name="email" placeholder="Your Email Address *" class="formEmail form-control" required>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="sideEnquiryMessage" name="info_message" rows="6" cols="1" placeholder="Your message"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="customEnquiryFormComponent_submit1" class="btn btn-danger btn-block submit_enquiry_button">Submit enquiry</span></button>
                    </div>
                    <p><small>By submitting this enquiry, you agree to sending your details to us and any third parties we use to process enquiries so that we may contact you regarding your enquiry.</small></p>
                </form>
                <div class="loader" style="display:none;"><i class="fas fa-sync fa-spin fa-3x fa-fw"></i></div>
            </div>
            </div>
        </div>
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

        <div class="row mt-5">
            <div class="col-md-7 offset-1">
                <h2>Buy Sell Your <span class="text-danger">Car Quickly & Easily</span></h2>
                <p>Labore dolore magna aliqua minim ipsum veniamquis nostrud exercitation</p>
            </div>
            <div class="col-md-4 text-center">
                <a href="{{ url('/sell-your-car') }}" class="btn btn-lg btn-danger">GET REGISTERED</a>
                <p>Call Us For Booking Vehicle</p>
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

  $('.enquiry_data_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('/store_enquiry_form') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
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

  $(function() {
      var form2 = $('#EnquiryFormComponent');
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
