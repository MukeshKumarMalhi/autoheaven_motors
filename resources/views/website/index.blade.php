@extends('layouts.app')
@section('title','Home')

@section('content')
<!-- section 1-->
<div class="pt-r10 bg-center-url" style="background-image: url('{{ asset('web_asset/images/bg-car-img.png') }}');">
    <div class="container text-light">
        <div class="row">
            <div class="offset-1 offset-sm-0 col-10 col-sm-8 col-md-6 col-lg-4 py-100 py-md-150 cm-bg-danger-x">
                <div class="position-r">
                    <h5>LUXURY UNLEASHED</h5>
                    <h1>Premium Cars Dealers</h1>
                    <br/><br/>
                    <div class="text-center">
                        <a href="{{ url('/used-cars') }}" class="btn btn-dark">View More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- section 2 -->
<div class="container py-5 position-r">
    <div class="link-light text-light bg-dark py-5 px-3 px-lg-5 cm-search-box">
    <h2>Search By Cars</h2>
      <form method="get" role="form" action="{{ url('/used-cars/search-results') }}" id="cars_search_form">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                  <div class="form-group col-sm-6 selectBox">
                    <select class="form-control make">
                    </select>
                    <div class="this_make" style="display: none;">
                      <input type="text" class="form-control this_make" id="make"><span class="cross_btn"></span>
                    </div>
                  </div>
                  <div class="form-group col-sm-6 selectBox">
                    <select class="form-control model" style="background-color: #fff;" disabled>
                    </select>
                    <div class="this_model" style="display: none;">
                      <input type="text" class="form-control this_model" id="model"><span class="cross_btn"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-sm-6 selectBox">
                    <select class="form-control min_price">
                    </select>
                    <div class="this_min_price" style="display: none;">
                      <input type="text" class="form-control this_min_price" id="min_price"><span class="cross_btn"></span>
                    </div>
                  </div>
                  <div class="form-group col-sm-6 selectBox">
                    <select class="form-control max_price">
                    </select>
                    <div class="this_max_price" style="display: none;">
                      <input type="text" class="form-control this_max_price" id="max_price"><span class="cross_btn"></span>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <button type="submit" id="quickSearchComponent_submit1" style="border-radius: 5px;" class="btn btn-danger btn-block qa-search-now search_engine_button">Search our cars</button>
                </div>
            </div>
          </div>
      </form>
    </div>
</div>
<!-- section 3 -->
<div class="slick-one slick-dots-md-r">
  <?php
    if(count($latest_cars) == 2){
      foreach ($latest_cars as $key => $latest) {
        $category_name = strtolower(str_replace(' ', '-', $latest->category_name));
        $car_model = strtolower(str_replace(' ', '-', $latest->model));
        $car_id = $latest->id;
        $car_detail = $category_name."-".$car_model."_".$car_id;
  ?>
    <div class="pt-r10 bg-center-url bg-gredient-white-l" style="background-image: url('<?php echo asset('storage/'.$latest->featured_image); ?>');">
        <div class="container py-80">
            <div class="row align-items-center" style="min-height: 400px;">
                    <div class="col-md-6">
                    <p class="mb-1">HELPS YOU TO FIND YOUR NEXT CAR EASILY</p>
                    <h2>New Vehicle <span class="text-danger">Just Arrived...</span></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididu et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ull laboris aliquip ex a commodo consequat.</p>
                    <br/>
                    <a href="{{ url('/used-cars') }}/{{ $car_detail }}" class="btn btn-danger mr-2 mb-2">View Details</a>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
      }
    ?>
</div>
<!-- section 4 -->
<div class="bg-danger">
    <div class="container py-80">
        <div class="text-light">
            <p class="mb-1">CAR AWESOME</p>
            <h2>A Select Vehicles</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididu et dolore magna aliqua. Ut enim ad minim veniam,</p>
        </div>
        <div class="row">
            <?php
              if(count($featured_cars) == 4){
                foreach ($featured_cars as $key => $featured) {
                  $category_name = strtolower(str_replace(' ', '-', $featured->category_name));
                  $car_model = strtolower(str_replace(' ', '-', $featured->model));
                  $car_id = $featured->id;
                  $car_detail = $category_name."-".$car_model."_".$car_id;
            ?>
            <div class="col-md-6 col-lg-3 mb-4">
              <div class="bg-white cars-boxs p-3">
                <h3>{{ $featured->category_name }} {{ $featured->model }}</h3>
                <p>{{ $featured->engine_size }} {{ $featured->name }} {{ $featured->number_of_doors }}dr (a/c)</p>
                <div class="mb-4 product1-img bg-center-url" style="background-image:url('<?php echo asset('storage/'.$featured->featured_image); ?>')">
                </div>
                <div class="text-center">
                  <p>{{ number_format($featured->mileage) }}km | {{ $featured->model_year }} | {{ $featured->gearbox_type }}  | {{ $featured->fuel_type }}</p>

                  <h3 class="text-danger">£{{ number_format($featured->price) }}</h3>
                  <h5><del>£{{ number_format($featured->price) }}</del></h5>

                  <a href="{{ url('/used-cars') }}/{{ $car_detail }}" class="btn btn-outline-danger">View full specifications</a>
                </div>
              </div>
            </div>
            <?php
                }
              }
            ?>

        </div>
    </div>
</div>
<!-- section 5 -->
<div class="container py-80">
    <p class="mb-1">HELPS YOU TO FIND YOUR NEXT CAR EASILY</p>
    <h2><span class="text-danger">Services</span> We Offers</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididu
    et dolore magna aliqua. Ut enim ad minim veniam,</p>

    <div class="row text-center text-light link-light ">
        <div class="col-md">
            <!-- <a href="#"> -->
                <div class="bg-dark bg-danger-hover h-100 p-4">
                    <div><img src="web_asset/images/icon1.png" class="img-fluid"></div>
                    <p>Parts Repairing</p>
                </div>
            <!-- </a> -->
        </div>
        <div class="col-md">
            <!-- <a href="#"> -->
                <div class="bg-dark bg-danger-hover h-100 p-4">
                    <div><img src="web_asset/images/icon2.png" class="img-fluid"></div>
                    <p>Car Inspection</p>
                </div>
            <!-- </a> -->
        </div>
        <div class="col-md">
            <!-- <a href="#"> -->
                <div class="bg-dark bg-danger-hover h-100 p-4">
                    <div><img src="web_asset/images/icon3.png" class="img-fluid"></div>
                    <p>Auto Painting</p>
                </div>
            <!-- </a> -->
        </div>
        <div class="col-md">
            <!-- <a href="#"> -->
                <div class="bg-dark bg-danger-hover h-100 p-4">
                    <div><img src="web_asset/images/icon4.png" class="img-fluid"></div>
                    <p>Auto Financing</p>
                </div>
            <!-- </a> -->
        </div>
        <div class="col-md">
            <!-- <a href="#"> -->
                <div class="bg-dark bg-danger-hover h-100 p-4">
                    <div><img src="web_asset/images/icon5.png" class="img-fluid"></div>
                    <p>Vehicle Delivery</p>
                </div>
            <!-- </a> -->
        </div>
    </div>
</div>

<!-- section 6 -->
<!-- <div class="pt-r10 bg-center-url" style="background-image: url('web_asset/images/bg-car-img2.jpg');">
    <div class="container py-80">
        <div class="row">
            <div class="col-md-6 offset-md-6">
                <p class="mb-1">HELPS YOU TO FIND YOUR NEXT CAR EASILY</p>
                <h2><span class="text-danger">News</span> We Business</h2>
                <div class="slick-row-two slick-bottom row">
                    <div class="item col-md-12">
                        <div class="row mb-4">
                            <div class="col-lg-4 pb-4 pb-lg-0">
                                <img src="web_asset/images/cars/product-001.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="text-danger">Lorem ipsum dolor</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididu et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                        <h5><a href="#">READ MORE</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item col-md-12">
                        <div class="row mb-4">
                            <div class="col-lg-4 pb-4 pb-lg-0">
                                <img src="web_asset/images/cars/product-001.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="text-danger">Lorem ipsum dolor</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididu et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                        <h5><a href="#">READ MORE</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item col-md-12">
                        <div class="row mb-4">
                            <div class="col-lg-4 pb-4 pb-lg-0">
                                <img src="web_asset/images/cars/product-001.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="text-danger">Lorem ipsum dolor</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididu et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                        <h5><a href="#">READ MORE</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item col-md-12">
                        <div class="row mb-4">
                            <div class="col-lg-4 pb-4 pb-lg-0">
                                <img src="web_asset/images/cars/product-001.jpg" class="img-fluid" alt="">
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="text-danger">Lorem ipsum dolor</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididu et dolore magna aliqua. Ut enim ad minim veniam.</p>
                                        <h5><a href="#">READ MORE</a></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- section 7-->
<div class="container py-80">
    <div class="row mt-3">
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

<!-- section 8 -->
<div class="bg-grey">
    <div class="container py-80">
        <div class="text-center">
            <p class="mb-1">HELPS YOU TO FIND PERFECT CAR</p>
            <h2><span class="text-danger">Customer</span> Reviews</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed eiusmod tempor incididu et dolore magna aliqua. Ut enim ad minim veniam,</p>
        </div>
        <div class="slick-four slick-bottom row mb-4">
          <?php
            if(count($reviews) > 0){
            foreach ($reviews as $key => $review){ ?>
            <div class="item col-md-12">
                <div class="bg-white border h-100 p-4">
                    <div><i class="fas fa-quote-left fa-3x"></i></div>
                    <p>
                      <?php $limit = 144;
                      $summary = $review->rating_desc;
                      if (strlen($summary) > $limit)
                      $summary = substr($summary, 0, strrpos(substr($summary, 0, $limit), ' ')) . '...';
                      echo $summary; ?>
                    </p>
                    <div class="media">
                        <div class="pr-2">
                          <i class="fas fa-user-circle" style="font-size: 4.4em;"></i>
                        </div>
                        <div class="media-body">
                            <p><span class="text-danger">{{ ucwords($review->full_name) }}</span> <br/>Customer</p>
                        </div>
                    </div>
                </div>
            </div>
          <?php
            }
          }
          ?>
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

  function spaceByhyphen(myStr){
    // myStr=myStr.toLowerCase();
    myStr=myStr.replace(/(^\s+|[^a-zA-Z0-9 ]+|\s+$)/g,"");
    myStr=myStr.replace(/\s+/g, "-");
    return myStr;
  }

  function append_count_data_in_select_boxes(show_data) {

    var $dropdown_make = $('.make');
    var $dropdown_this_make = $('.this_make');
    var hidden_make = $('input:hidden[name="make"]').val();

    $dropdown_make.html('');
    $dropdown_make.addClass('select_box');
    $dropdown_make.append($("<option>").val('').text('Make (all)'));
    var count_make = Object.keys(show_data.category).length;
    $.each(show_data.category, function(key, value){
      if(count_make == 1){
        $dropdown_make.hide();
        $dropdown_this_make.show();
        $dropdown_this_make.val(key);
        $dropdown_this_make.prop('disabled', true);
        // $dropdown_this_make.css('background-color', '#fff');
      }
      else if (count_make > 1 && hidden_make == undefined) {
        $dropdown_this_make.hide();
        $dropdown_make.show();
        $dropdown_make.append($("<option>").val(key).text(key+" "+"("+value+")"));
      }
      else {
        $dropdown_make.append($("<option>").val(key).text(key+" "+"("+value+")"));
      }
    });
    $dropdown_this_make.addClass('input_field');

    var $dropdown_model = $('.model');
    var $dropdown_this_model = $('.this_model');
    var hidden_model = $('input:hidden[name="model"]').val();

    $dropdown_model.html('');
    $dropdown_model.addClass('select_box');
    $dropdown_model.append($("<option>").val('').text('Model (any)'));
    var count_model = Object.keys(show_data.model).length;
    $.each(show_data.model, function(key, value){
      if(count_model == 1){
        $dropdown_model.hide();
        $dropdown_this_model.show();
        $dropdown_this_model.val(key);
        $dropdown_this_model.prop('disabled', true);
        // $dropdown_this_model.css('background-color', '#fff');
      }
      else if (count_model > 1 && hidden_model == undefined) {
        $dropdown_this_model.hide();
        $dropdown_model.show();
        $dropdown_model.append($("<option>").val(key).text(key+" "+"("+value+")"));
      }
      else {
        $dropdown_model.append($("<option>").val(key).text(key+" "+"("+value+")"));
      }
    });

    $dropdown_this_model.addClass('input_field');

    var $dropdown_min_price = $('.min_price');
    var $dropdown_this_min_price = $('.this_min_price');
    var hidden_min_price = $('input:hidden[name="min_price"]').val();

    $dropdown_min_price.html('');
    $dropdown_min_price.addClass('select_box');
    $dropdown_min_price.append($("<option>").val('').text('Min price (any)'));
    var count_min_price = Object.keys(show_data.min_price).length;
    $.each(show_data.min_price, function(key, value){
      if(count_min_price == 1){
        $dropdown_min_price.hide();
        $dropdown_this_min_price.show();
        $dropdown_this_min_price.val("£"+key);
        $dropdown_this_min_price.prop('disabled', true);
        // $dropdown_this_min_price.css('background-color', '#fff');
      }
      else if (count_min_price > 1 && hidden_min_price == undefined) {
        $dropdown_this_min_price.hide();
        $dropdown_min_price.show();
        $dropdown_min_price.append($("<option>").val(key).text("£"+key+" "+"("+value+")"));
      }
      else {
        $dropdown_min_price.append($("<option>").val(key).text("£"+key+" "+"("+value+")"));
      }
    });

    $dropdown_this_min_price.addClass('input_field');


    var $dropdown_max_price = $('.max_price');
    var $dropdown_this_max_price = $('.this_max_price');
    var hidden_max_price = $('input:hidden[name="max_price"]').val();

    $dropdown_max_price.html('');
    $dropdown_max_price.addClass('select_box');
    $dropdown_max_price.append($("<option>").val('').text('Max price (any)'));
    var count_max_price = Object.keys(show_data.max_price).length;
    $.each(show_data.max_price, function(key, value){
      if(count_max_price == 1){
        $dropdown_max_price.hide();
        $dropdown_this_max_price.show();
        $dropdown_this_max_price.val("£"+key);
        $dropdown_this_max_price.prop('disabled', true);
      }
      else if (count_max_price > 1 && hidden_max_price == undefined) {
        $dropdown_this_max_price.hide();
        $dropdown_max_price.show();
        $dropdown_max_price.append($("<option>").val(key).text("£"+key+" "+"("+value+")"));
      }
      else {
        $dropdown_max_price.append($("<option>").val(key).text("£"+key+" "+"("+value+")"));
      }
    });

    $dropdown_this_max_price.addClass('input_field');
  }

  var array_cars = <?php echo json_encode($cars); ?>;
  var show_data = JSON.parse(array_cars);
  append_count_data_in_select_boxes(show_data);

  $('.search_engine_button').on('click', function(event){
    event.preventDefault();

    var get_vars = $('#cars_search_form').serializeArray();
    if(get_vars.length == 0){
      window.location.href="/used-cars";
    }else {
      $('#cars_search_form').submit();
    }
  });

  $('#cars_search_form select').on('change', function(event){
    event.preventDefault();
    $(this).hide();
    var second_class = $(this).attr('class').split(' ')[1];
    var this_value = $(this).val();
    $('.this_'+second_class).show();
    $('input.this_'+second_class).val(this_value);
    $('input.this_'+second_class).prop('disabled', true);
    $('input.this_'+second_class).css('background-color', '#fff');
    $('.this_'+second_class+' span').text('X');
    $('input:hidden[name="'+second_class+'"]').remove();
    var set_value = $.trim(this_value.replace(/\b \b/g, '-'));
    $('div.this_'+second_class).append("<input type='hidden' name='"+second_class+"' value='"+set_value+"'>");

    var selected_make = $('input:hidden[name="make"]').val();
    var selected_model = $('input:hidden[name="model"]').val();
    var selected_min_price = $('input:hidden[name="min_price"]').val();
    var selected_max_price = $('input:hidden[name="max_price"]').val();

    if(selected_make == undefined){
      selected_make = "make"
    }
    if(selected_model == undefined){
      selected_model = "model"
    }
    if(selected_min_price == undefined){
      selected_min_price = "min_price"
    }
    if(selected_max_price == undefined){
      selected_max_price = "max_price"
    }

    var data = {
      'make': selected_make,
      'model': selected_model,
      'min_price': selected_min_price,
      'max_price': selected_max_price,
    };

    $.ajax({
      url:"{{ url('get_cars_by_company_home') }}",
      type:"GET",
      data:data,
      dataType:"JSON",
      success:function(response){
        var response_data = JSON.parse(response);
        append_count_data_in_select_boxes(response_data);
      },
    });
  });

  $('#cars_search_form .cross_btn').on('click', function(event){
    event.preventDefault();
    $(this).parent().hide();
    var second_id = $(this).parent().find('input').attr('id');
    if(second_id == "make") {
      $('.model').prop('disabled', true);
      $('.model').css('-webkit-appearance', 'none');
      $('input:hidden[name="model"]').remove();
    }
    $('input:hidden[name="'+second_id+'"]').remove();
    $('input.this_'+second_id).val('');
    $('.this_'+second_id+' span').text('');
    // $('input.this_'+second_id).prop('disabled', true);
    $('.'+second_id).prop('selectedIndex',0);
    $('.'+second_id).show();

    // var par = $('.'+second_id).parent();
    // $(par).nextAll('div.selectBox').children('.input_field').hide();
    // $(par).nextAll('div.selectBox').children().children('input.input_field').val('');
    // // $(par).nextAll('div.selectBox').children('.input_field').prop('disabled', true);
    // $(par).nextAll('div.selectBox').children('.select_box').prop('selectedIndex',0);
    // $(par).nextAll('div.selectBox').children('.select_box').show();

    var selected_make = $('input:hidden[name="make"]').val();
    var selected_model = $('input:hidden[name="model"]').val();
    var selected_min_price = $('input:hidden[name="min_price"]').val();
    var selected_max_price = $('input:hidden[name="max_price"]').val();

    if(selected_make == undefined){
      selected_make = "make"
    }
    if(selected_model == undefined){
      selected_model = "model"
    }
    if(selected_min_price == undefined){
      selected_min_price = "min_price"
    }
    if(selected_max_price == undefined){
      selected_max_price = "max_price"
    }

    var data = {
      'make': selected_make,
      'model': selected_model,
      'min_price': selected_min_price,
      'max_price': selected_max_price,
    };

    $.ajax({
      url:"{{ url('get_cars_by_company_home') }}",
      type:"GET",
      data:data,
      dataType:"JSON",
      success:function(response){
        var response_data = JSON.parse(response);
        append_count_data_in_select_boxes(response_data);
      },
    });
  });

  $('.make').on('change', function(){
    $('.model').prop('disabled', false);
    $('.model').css('-webkit-appearance', 'menulist');
  });
});
</script>
<style media="screen">
.form-control{
  border-radius: 5px;
}
.model{
  -webkit-appearance: none;
}
.cross_btn{
  color: #fff;
}
</style>
@endsection
