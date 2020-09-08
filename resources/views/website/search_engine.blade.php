  @extends('layouts.app')
  @section('title','Search results')

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
  <!-- section 2-->
  <div class="py-4">
      <div class="container">
          <div class="clearfix mb-4">
              <h2 class="font-weight-bold">Search A Car</h2>
          </div>
          <div class="row no-gutters-10">
              <div class="col-md-5 col-lg-3 mb-3">
                  <div class="">
                      <div class="form-group">
                          <h4>Filters by:</h4>
                      </div>
                      <form method="get" role="form" action="{{ url('/used-cars/search-results') }}" id="cars_search_form">
                        <div class="form-group">
                          <button type="submit" class="btn btn-danger btn-block qa-search-now search_button search_engine_button" style="border-radius: 5px;">Update search</button>
                        </div>

                        <!-- <div class="form-group">
                          <h4 class="font-weight-bold text-danger mb-2">Make</h4>
                        </div> -->
                        <div class="form-group selectBox">
                          <select class="form-control make">
                          </select>
                          <div class="this_make" style="display: none;">
                            <input type="text" class="form-control this_make" id="make"><span class="cross_btn"></span>
                          </div>
                        </div>

                      <!-- <div class="form-group">
                          <h4 class="font-weight-bold text-danger mb-2">Model</h4>
                      </div> -->

                      <div class="form-group selectBox">
                        <select class="form-control model" style="background-color: #fff; <?php if($make != 'make') echo '-webkit-appearance: menulist'; ?>" <?php if($make == 'make') echo "disabled"; ?>>
                        </select>
                        <div class="this_model" style="display: none;">
                          <input type="text" class="form-control this_model" id="model"><span class="cross_btn"></span>
                        </div>
                      </div>


                      <!-- <div class="form-group">
                          <h4 class="font-weight-bold text-danger mb-2">Price</h4>
                      </div> -->

                      <div class="form-group selectBox">
                        <select class="form-control min_price">
                        </select>
                        <div class="this_min_price" style="display: none;">
                          <input type="text" class="form-control this_min_price" id="min_price"><span class="cross_btn"></span>
                        </div>
                      </div>

                      <div class="form-group selectBox">
                        <select class="form-control max_price">
                        </select>
                        <div class="this_max_price" style="display: none;">
                          <input type="text" class="form-control this_max_price" id="max_price"><span class="cross_btn"></span>
                        </div>
                      </div>


                      <!-- <div class="form-group">
                          <h4 class="font-weight-bold text-danger mb-2">Body type</h4>
                      </div> -->

                      <div class="form-group selectBox">
                        <select class="form-control body_style">
                        </select>
                        <div class="this_body_style" style="display: none;">
                          <input type="text" class="form-control this_body_style" id="body_style"><span class="cross_btn"></span>
                        </div>
                      </div>


                      <!-- <div class="form-group">
                          <h4 class="font-weight-bold text-danger mb-2">Mileage</h4>
                      </div> -->

                      <div class="form-group selectBox">
                        <select class="form-control mileage">
                        </select>
                        <div class="this_mileage" style="display: none;">
                          <input type="text" class="form-control this_mileage" id="mileage"><span class="cross_btn"></span>
                        </div>
                      </div>


                      <!-- <div class="form-group">
                          <h4 class="font-weight-bold text-danger mb-2">Engine size</h4>
                      </div> -->

                      <div class="form-group selectBox">
                        <select class="form-control min_engine_size">
                        </select>
                        <div class="this_min_engine_size" style="display: none;">
                          <input type="text" class="form-control this_min_engine_size" id="min_engine_size"><span class="cross_btn"></span>
                        </div>
                      </div>

                      <div class="form-group selectBox">
                        <select class="form-control max_engine_size">
                        </select>
                        <div class="this_max_engine_size" style="display: none;">
                          <input type="text" class="form-control this_max_engine_size" id="max_engine_size"><span class="cross_btn"></span>
                        </div>
                      </div>


                      <!-- <div class="form-group">
                          <h4 class="font-weight-bold text-danger mb-2">Fuel type</h4>
                      </div> -->

                      <div class="form-group selectBox">
                        <select class="form-control fuel_type">
                        </select>
                        <div class="this_fuel_type" style="display: none;">
                          <input type="text" class="form-control this_fuel_type" id="fuel_type"><span class="cross_btn"></span>
                        </div>
                      </div>


                      <!-- <div class="form-group">
                          <h4 class="font-weight-bold text-danger mb-2">Gearbox type</h4>
                      </div> -->

                      <div class="form-group selectBox">
                        <select class="form-control gearbox_type">
                        </select>
                        <div class="this_gearbox_type" style="display: none;">
                          <input type="text" class="form-control this_gearbox_type" id="gearbox_type"><span class="cross_btn"></span>
                        </div>
                      </div>


                      <!-- <div class="form-group">
                          <h4 class="font-weight-bold text-danger mb-2">Year</h4>
                      </div> -->

                      <div class="form-group selectBox">
                        <select class="form-control min_year">
                        </select>
                        <div class="this_min_year" style="display: none;">
                          <input type="text" class="form-control this_min_year" id="min_year"><span class="cross_btn"></span>
                        </div>
                      </div>

                      <div class="form-group selectBox">
                        <select class="form-control max_year">
                        </select>
                        <div class="this_max_year" style="display: none;">
                          <input type="text" class="form-control this_max_year" id="max_year"><span class="cross_btn"></span>
                        </div>
                      </div>

                      <!-- <div class="form-group">
                          <h4 class="font-weight-bold text-danger mb-2">No. of doors</h4>
                      </div> -->

                      <div class="form-group selectBox">
                        <select class="form-control number_of_doors">
                        </select>
                        <div class="this_number_of_doors" style="display: none;">
                          <input type="text" class="form-control this_number_of_doors" id="number_of_doors"><span class="cross_btn"></span>
                        </div>
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-danger btn-block qa-search-now search_button search_engine_button" style="border-radius: 5px;">Update search</button>
                      </div>
                    </form>
                  </div>
              </div>
              <div class="col-md-7 col-lg-9 mb-3">
                  <!-- row box -->
                  <?php foreach ($list_cars as $key => $value) { ?>
                    <div class="container-fluid mb-5 cars-card-box">

                      <div class="row">
                          <div class="col-lg-4 pb-4 pb-lg-0">
                            <?php
                              $category_name = strtolower(str_replace(' ', '-', $value->category_name));
                              $car_model = strtolower(str_replace(' ', '-', $value->model));
                              $car_id = $value->id;
                              $car_detail = $category_name."-".$car_model."_".$car_id;
                            ?>
                            <a href="{{ url('/used-cars') }}/{{ $car_detail }}">
                              <img src="<?php echo asset('storage/'.$value->featured_image); ?>" class="img-fluid" alt="">
                            </a>
                          </div>
                          <div class="col-lg-8">
                              <div class="row">
                                  <div class="col-md-8">
                                      <h3 class="text-danger">{{ $value->category_name }} {{ $value->model }} {{ $value->engine_size }} {{ $value->number_of_doors }}dr</h3>
                                      <p>
                                        <?php
                                          $limit = 140;
                                          $summary = $value->description;
                                          if (strlen($summary) > $limit)
                                          $summary = substr($summary, 0, strrpos(substr($summary, 0, $limit), ' ')) . '...';
                                          echo $summary;
                                        ?>
                                      </p>
                                  </div>
                                  <div class="col-md-4 text-md-right">
                                      <h3 class="text-danger">£{{ number_format($value->price) }}</h3>
                                      <p>Est. Down Payment: £450/m</p>
                                  </div>
                              </div>
                              <div class="row align-items-end">
                                  <div class="col-md-8">
                                      <hr class="mt-0">
                                      <div class="row font-weight-bold no-gutters">
                                          <div class="col-sm-6">
                                              <p>Mileage: {{ number_format($value->mileage) }}km</p>
                                          </div>
                                          <div class="col-sm-6">
                                              <p>Transmission: {{ ucwords($value->gearbox_type) }}</p>
                                          </div>
                                          <div class="col-sm-6">
                                              <p>Fuel Type: {{ ucwords($value->fuel_type) }}</p>
                                          </div>
                                          <div class="col-sm-6">
                                              <p>Body Color: {{ $value->colour }}</p>
                                          </div>
                                          <div class="col-sm-6">
                                              <p>Model: {{ $value->model_year }}</p>
                                          </div>
                                          <div class="col-sm-6">
                                              <p>Engine Size: {{ $value->engine_size }}L</p>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row align-items-end">
                                <div class="col-md-6">
                                  <a href="{{ url('/used-cars') }}/finance/{{ $car_detail }}" class="btn btn-outline-dark btn-block mt-2 mr-2">Enquire About Finance</a>
                                </div>
                                <div class="col-md-6">
                                  <a href="{{ url('/used-cars') }}/{{ $car_detail }}" class="btn btn-danger btn-block mt-2 mr-2">View vehicle advert</a>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
                <?php } ?>
               <ul class="pagination justify-content-center" role="navigation">
                 {{ $list_cars->appends([
                      'make' => app('request')->input('make'),
                      'sort' => app('request')->input('sort'),
                      'model' => app('request')->input('model'),
                      ])->links() }}
               </ul>
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

    $('.sorting_data').on('change', function () {
      var sort = $(this).val();
      $('input:hidden[name="sort"]').remove();
      $('#cars_search_form').prepend("<input type='hidden' name='sort' value='"+sort+"'>");
      $('#cars_search_form').submit();
    });
    // $('a.page-link').on('click', function () {
    //   var page = $(this).text();
    //   $('input:hidden[name="page"]').remove();
    //   $('#cars_search_form').append("<input type='hidden' name='page' value='"+page+"'>");
    //   $('#cars_search_form').submit();
    // });

    function append_count_data_in_select_boxes(show_data) {

      var make = "{{ $make }}";
      var model = "{{ $model }}";
      var min_price = "{{ $min_price }}";
      var max_price = "{{ $max_price }}";
      var body_style = "{{ $body_style }}";
      var mileage = "{{ $mileage }}";
      var min_engine_size = "{{ $min_engine_size }}";
      var max_engine_size = "{{ $max_engine_size }}";
      var fuel_type = "{{ $fuel_type }}";
      var gearbox_type = "{{ $gearbox_type }}";
      var min_year = "{{ $min_year }}";
      var max_year = "{{ $max_year }}";
      var number_of_doors = "{{ $number_of_doors }}";

      var $dropdown_make = $('.make');
      var $dropdown_this_make = $('.this_make');
      $dropdown_make.html('');
      $dropdown_make.addClass('select_box');
      $dropdown_make.append($("<option>").val('').text('Make (all)'));
      var count = Object.keys(show_data.category).length;

      $.each(show_data.category, function(key, value){
        if(count == 1 && make != 'make'){
          $dropdown_make.hide();
          $dropdown_this_make.show();
          $dropdown_this_make.val(key);
          $dropdown_this_make.prop('disabled', true);
          $dropdown_this_make.css('background-color', '#fff');
          $('.this_make span').text('X');
          $('div.this_make').append("<input type='hidden' name='make' value='"+key+"'>");
        }else if (count == 1) {
          $dropdown_make.hide();
          $dropdown_this_make.show();
          $dropdown_this_make.val(key);
          $dropdown_this_make.prop('disabled', true);
          $dropdown_this_make.css('background-color', '#fff');
        }else {
          $dropdown_make.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });
      $dropdown_this_make.addClass('input_field');

      var $dropdown_model = $('.model');
      var $dropdown_this_model = $('.this_model');
      $dropdown_model.html('');
      $dropdown_model.addClass('select_box');
      $dropdown_model.append($("<option>").val('').text('Model (any)'));
      var count = Object.keys(show_data.model).length;
      $.each(show_data.model, function(key, value){
        if(count == 1 && model != 'model'){
          $dropdown_model.hide();
          $dropdown_this_model.show();
          $dropdown_this_model.val(key);
          $dropdown_this_model.prop('disabled', true);
          $dropdown_this_model.css('background-color', '#fff');
          $('.this_model span').text('X');
          $('div.this_model').append("<input type='hidden' name='model' value='"+key+"'>");
        }
        else if (count == 1) {
          $dropdown_model.hide();
          $dropdown_this_model.show();
          $dropdown_this_model.val(key);
          $dropdown_this_model.prop('disabled', true);
          $dropdown_this_model.css('background-color', '#fff');
        }
        else {
          $dropdown_model.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });
      $dropdown_this_model.addClass('input_field');

      var $dropdown_min_price = $('.min_price');
      var $dropdown_this_min_price = $('.this_min_price');
      $dropdown_min_price.html('');
      $dropdown_min_price.addClass('select_box');
      $dropdown_min_price.append($("<option>").val('').text('Min price (any)'));
      var count = Object.keys(show_data.min_price).length;
      $.each(show_data.min_price, function(key, value){
        if(count == 1 && min_price != 'min-price'){
          $dropdown_min_price.hide();
          $dropdown_this_min_price.show();
          $dropdown_this_min_price.val(key);
          $dropdown_this_min_price.prop('disabled', true);
          $dropdown_this_min_price.css('background-color', '#fff');
          $('.this_min_price span').text('X');
          $('div.this_min_price').append("<input type='hidden' name='min_price' value='"+key+"'>");
        }
        else if (count == 1) {
          $dropdown_min_price.hide();
          $dropdown_this_min_price.show();
          $dropdown_this_min_price.val(key);
          $dropdown_this_min_price.prop('disabled', true);
          $dropdown_this_min_price.css('background-color', '#fff');
        }
        else if (count > 1 && min_price != 'min-price') {
          $dropdown_min_price.hide();
          $dropdown_this_min_price.show();
          $dropdown_this_min_price.val(min_price);
          $dropdown_this_min_price.prop('disabled', true);
          $dropdown_this_min_price.css('background-color', '#fff');
        }
        else {
          $dropdown_min_price.append($("<option>").val(key).text("£"+key+" "+"("+value+")"));
        }
      });
      if(min_price != 'min-price'){
        $('.this_min_price span').text('X');
        $('div.this_min_price').append("<input type='hidden' name='min_price' value='"+min_price+"'>");
      }
      $dropdown_this_min_price.addClass('input_field');


      var $dropdown_max_price = $('.max_price');
      var $dropdown_this_max_price = $('.this_max_price');
      $dropdown_max_price.html('');
      $dropdown_max_price.addClass('select_box');
      $dropdown_max_price.append($("<option>").val('').text('Max price (any)'));
      var count = Object.keys(show_data.max_price).length;
      $.each(show_data.max_price, function(key, value){
        if(count == 1 && max_price != 'max-price'){
          $dropdown_max_price.hide();
          $dropdown_this_max_price.show();
          $dropdown_this_max_price.val(key);
          $dropdown_this_max_price.prop('disabled', true);
          $dropdown_this_max_price.css('background-color', '#fff');
          $('.this_max_price span').text('X');
          $('div.this_max_price').append("<input type='hidden' name='max_price' value='"+key+"'>");
        }
        else if (count == 1) {
          $dropdown_max_price.hide();
          $dropdown_this_max_price.show();
          $dropdown_this_max_price.val(key);
          $dropdown_this_max_price.prop('disabled', true);
          $dropdown_this_max_price.css('background-color', '#fff');
        }
        else if (count > 1 && max_price != 'max-price') {
          $dropdown_max_price.hide();
          $dropdown_this_max_price.show();
          $dropdown_this_max_price.val(max_price);
          $dropdown_this_max_price.prop('disabled', true);
          $dropdown_this_max_price.css('background-color', '#fff');
        }
        else {
          $dropdown_max_price.append($("<option>").val(key).text("£"+key+" "+"("+value+")"));
        }
      });
      if(max_price != 'max-price'){
        $('.this_max_price span').text('X');
        $('div.this_max_price').append("<input type='hidden' name='max_price' value='"+max_price+"'>");
      }
      $dropdown_this_max_price.addClass('input_field');

      var $dropdown_body_style = $('.body_style');
      var $dropdown_this_body_style = $('.this_body_style');
      $dropdown_body_style.html('');
      $dropdown_body_style.addClass('select_box');
      $dropdown_body_style.append($("<option>").val('').text('Body type (all)'));
      var count = Object.keys(show_data.body_style).length;
      $.each(show_data.body_style, function(key, value){
        if(count == 1 && body_style != 'body-type'){
          $dropdown_body_style.hide();
          $dropdown_this_body_style.show();
          $dropdown_this_body_style.val(key);
          $dropdown_this_body_style.prop('disabled', true);
          $dropdown_this_body_style.css('background-color', '#fff');
          $('.this_body_style span').text('X');
          $('div.this_body_style').append("<input type='hidden' name='body_style' value='"+key+"'>");
        }
        else if (count == 1) {
          $dropdown_body_style.hide();
          $dropdown_this_body_style.show();
          $dropdown_this_body_style.val(key);
          $dropdown_this_body_style.prop('disabled', true);
          $dropdown_this_body_style.css('background-color', '#fff');
        }
        else {
          $dropdown_body_style.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });
      $dropdown_this_body_style.addClass('input_field');

      var $dropdown_mileage = $('.mileage');
      var $dropdown_this_mileage = $('.this_mileage');
      $dropdown_mileage.html('');
      $dropdown_mileage.addClass('select_box');
      $dropdown_mileage.append($("<option>").val('').text('Mileage (any)'));
      var count = Object.keys(show_data.mileage).length;
      $.each(show_data.mileage, function(key, value){
        if(count == 1 && mileage != 'mileage'){
          $dropdown_mileage.hide();
          $dropdown_this_mileage.show();
          $dropdown_this_mileage.val(key);
          $dropdown_this_mileage.prop('disabled', true);
          $dropdown_this_mileage.css('background-color', '#fff');
          $('.this_mileage span').text('X');
          $('div.this_mileage').append("<input type='hidden' name='mileage' value='"+key+"'>");
        }
        else if (count == 1) {
          $dropdown_mileage.hide();
          $dropdown_this_mileage.show();
          $dropdown_this_mileage.val(key);
          $dropdown_this_mileage.prop('disabled', true);
          $dropdown_this_mileage.css('background-color', '#fff');
        }
        else if (count > 1 && mileage != 'mileage') {
          $dropdown_mileage.hide();
          $dropdown_this_mileage.show();
          $dropdown_this_mileage.val(mileage);
          $dropdown_this_mileage.prop('disabled', true);
          $dropdown_this_mileage.css('background-color', '#fff');
        }
        else {
          $dropdown_mileage.append($("<option>").val(key).text("Up to "+key+" miles "+"("+value+")"));
        }
      });
      if(mileage != 'mileage'){
        $('.this_mileage span').text('X');
        $('div.this_mileage').append("<input type='hidden' name='mileage' value='"+mileage+"'>");
      }
      $dropdown_this_mileage.addClass('input_field');

      var $dropdown_min_engine_size = $('.min_engine_size');
      var $dropdown_this_min_engine_size = $('.this_min_engine_size');
      $dropdown_min_engine_size.html('');
      $dropdown_min_engine_size.addClass('select_box');
      $dropdown_min_engine_size.append($("<option>").val('').text('Min engine size (any)'));
      var count = Object.keys(show_data.min_engine_size).length;
      $.each(show_data.min_engine_size, function(key, value){
        if(count == 1 && min_engine_size != 'min-engine-size'){
          $dropdown_min_engine_size.hide();
          $dropdown_this_min_engine_size.show();
          $dropdown_this_min_engine_size.val(key);
          $dropdown_this_min_engine_size.prop('disabled', true);
          $dropdown_this_min_engine_size.css('background-color', '#fff');
          $('.this_min_engine_size span').text('X');
          $('div.this_min_engine_size').append("<input type='hidden' name='min_engine_size' value='"+key+"'>");
        }
        else if (count == 1) {
          $dropdown_min_engine_size.hide();
          $dropdown_this_min_engine_size.show();
          $dropdown_this_min_engine_size.val(key);
          $dropdown_this_min_engine_size.prop('disabled', true);
          $dropdown_this_min_engine_size.css('background-color', '#fff');
        }
        else if (count > 1 && min_engine_size != 'min-engine-size') {
          $dropdown_min_engine_size.hide();
          $dropdown_this_min_engine_size.show();
          $dropdown_this_min_engine_size.val(min_engine_size);
          $dropdown_this_min_engine_size.prop('disabled', true);
          $dropdown_this_min_engine_size.css('background-color', '#fff');
        }
        else {
          $dropdown_min_engine_size.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });
      if(min_engine_size != 'min-engine-size'){
        $('.this_min_engine_size span').text('X');
        $('div.this_min_engine_size').append("<input type='hidden' name='min_engine_size' value='"+min_engine_size+"'>");
      }
      $dropdown_this_min_engine_size.addClass('input_field');

      var $dropdown_max_engine_size = $('.max_engine_size');
      var $dropdown_this_max_engine_size = $('.this_max_engine_size');
      $dropdown_max_engine_size.html('');
      $dropdown_max_engine_size.addClass('select_box');
      $dropdown_max_engine_size.append($("<option>").val('').text('Max engine size (any)'));
      var count = Object.keys(show_data.max_engine_size).length;
      $.each(show_data.max_engine_size, function(key, value){
        if(count == 1 && max_engine_size != 'max-engine-size'){
          $dropdown_max_engine_size.hide();
          $dropdown_this_max_engine_size.show();
          $dropdown_this_max_engine_size.val(key);
          $dropdown_this_max_engine_size.prop('disabled', true);
          $dropdown_this_max_engine_size.css('background-color', '#fff');
          $('.this_max_engine_size span').text('X');
          $('div.this_max_engine_size').append("<input type='hidden' name='max_engine_size' value='"+key+"'>");
        }
        else if (count == 1) {
          $dropdown_max_engine_size.hide();
          $dropdown_this_max_engine_size.show();
          $dropdown_this_max_engine_size.val(key);
          $dropdown_this_max_engine_size.prop('disabled', true);
          $dropdown_this_max_engine_size.css('background-color', '#fff');
        }
        else if (count > 1 && max_engine_size != 'max-engine-size') {
          $dropdown_max_engine_size.hide();
          $dropdown_this_max_engine_size.show();
          $dropdown_this_max_engine_size.val(max_engine_size);
          $dropdown_this_max_engine_size.prop('disabled', true);
          $dropdown_this_max_engine_size.css('background-color', '#fff');
        }
        else {
          $dropdown_max_engine_size.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });
      if(max_engine_size != 'max-engine-size'){
        $('.this_max_engine_size span').text('X');
        $('div.this_max_engine_size').append("<input type='hidden' name='max_engine_size' value='"+max_engine_size+"'>");
      }
      $dropdown_this_max_engine_size.addClass('input_field');

      var $dropdown_fuel_type = $('.fuel_type');
      var $dropdown_this_fuel_type = $('.this_fuel_type');
      $dropdown_fuel_type.html('');
      $dropdown_fuel_type.addClass('select_box');
      $dropdown_fuel_type.append($("<option>").val('').text('Fuel type (any)'));
      var count = Object.keys(show_data.fuel_type).length;
      $.each(show_data.fuel_type, function(key, value){
        if(count == 1 && fuel_type != 'fuel-type'){
          $dropdown_fuel_type.hide();
          $dropdown_this_fuel_type.show();
          $dropdown_this_fuel_type.val(key);
          $dropdown_this_fuel_type.prop('disabled', true);
          $dropdown_this_fuel_type.css('background-color', '#fff');
          $('.this_fuel_type span').text('X');
          $('div.this_fuel_type').append("<input type='hidden' name='fuel_type' value='"+key+"'>");
        }
        else if (count == 1) {
          $dropdown_fuel_type.hide();
          $dropdown_this_fuel_type.show();
          $dropdown_this_fuel_type.val(key);
          $dropdown_this_fuel_type.prop('disabled', true);
          $dropdown_this_fuel_type.css('background-color', '#fff');
        }
        else {
          $dropdown_fuel_type.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });
      $dropdown_this_fuel_type.addClass('input_field');

      var $dropdown_gearbox_type = $('.gearbox_type');
      var $dropdown_this_gearbox_type = $('.this_gearbox_type');
      $dropdown_gearbox_type.html('');
      $dropdown_gearbox_type.addClass('select_box');
      $dropdown_gearbox_type.append($("<option>").val('').text('Gearbox type (any)'));
      var count = Object.keys(show_data.gearbox_type).length;
      $.each(show_data.gearbox_type, function(key, value){
        if(count == 1 && gearbox_type != 'gearbox-type'){
          $dropdown_gearbox_type.hide();
          $dropdown_this_gearbox_type.show();
          $dropdown_this_gearbox_type.val(key);
          $dropdown_this_gearbox_type.prop('disabled', true);
          $dropdown_this_gearbox_type.css('background-color', '#fff');
          $('.this_gearbox_type span').text('X');
          $('div.this_gearbox_type').append("<input type='hidden' name='gearbox_type' value='"+key+"'>");
        }
        else if (count == 1) {
          $dropdown_gearbox_type.hide();
          $dropdown_this_gearbox_type.show();
          $dropdown_this_gearbox_type.val(key);
          $dropdown_this_gearbox_type.prop('disabled', true);
          $dropdown_this_gearbox_type.css('background-color', '#fff');
        }
        else {
          $dropdown_gearbox_type.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });
      $dropdown_this_gearbox_type.addClass('input_field');

      var $dropdown_min_year = $('.min_year');
      var $dropdown_this_min_year = $('.this_min_year');
      $dropdown_min_year.html('');
      $dropdown_min_year.addClass('select_box');
      $dropdown_min_year.append($("<option>").val('').text('Min year (any)'));
      var count = Object.keys(show_data.min_year).length;
      $.each(show_data.min_year, function(key, value){
        if(count == 1 && min_year != 'min-year'){
          $dropdown_min_year.hide();
          $dropdown_this_min_year.show();
          $dropdown_this_min_year.val(key);
          $dropdown_this_min_year.prop('disabled', true);
          $dropdown_this_min_year.css('background-color', '#fff');
          $('.this_min_year span').text('X');
          $('div.this_min_year').append("<input type='hidden' name='min_year' value='"+key+"'>");
        }
        else if (count == 1) {
          $dropdown_min_year.hide();
          $dropdown_this_min_year.show();
          $dropdown_this_min_year.val(key);
          $dropdown_this_min_year.prop('disabled', true);
          $dropdown_this_min_year.css('background-color', '#fff');
        }
        else if (count > 1 && min_year != 'min-year') {
          $dropdown_min_year.hide();
          $dropdown_this_min_year.show();
          $dropdown_this_min_year.val(min_year);
          $dropdown_this_min_year.prop('disabled', true);
          $dropdown_this_min_year.css('background-color', '#fff');
        }
        else {
          $dropdown_min_year.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });
      if(min_year != 'min-year'){
        $('.this_min_year span').text('X');
        $('div.this_min_year').append("<input type='hidden' name='min_year' value='"+min_year+"'>");
      }
      $dropdown_this_min_year.addClass('input_field');

      var $dropdown_max_year = $('.max_year');
      var $dropdown_this_max_year = $('.this_max_year');
      $dropdown_max_year.html('');
      $dropdown_max_year.addClass('select_box');
      $dropdown_max_year.append($("<option>").val('').text('Max year (any)'));
      var count = Object.keys(show_data.max_year).length;
      $.each(show_data.max_year, function(key, value){
        if(count == 1 && max_year != 'max-year'){
          $dropdown_max_year.hide();
          $dropdown_this_max_year.show();
          $dropdown_this_max_year.val(key);
          $dropdown_this_max_year.prop('disabled', true);
          $dropdown_this_max_year.css('background-color', '#fff');
          $('.this_max_year span').text('X');
          $('div.this_max_year').append("<input type='hidden' name='max_year' value='"+key+"'>");
        }
        else if (count == 1) {
          $dropdown_max_year.hide();
          $dropdown_this_max_year.show();
          $dropdown_this_max_year.val(key);
          $dropdown_this_max_year.prop('disabled', true);
          $dropdown_this_max_year.css('background-color', '#fff');
        }
        else if (count > 1 && max_year != 'max-year') {
          $dropdown_max_year.hide();
          $dropdown_this_max_year.show();
          $dropdown_this_max_year.val(max_year);
          $dropdown_this_max_year.prop('disabled', true);
          $dropdown_this_max_year.css('background-color', '#fff');
        }
        else {
          $dropdown_max_year.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });
      if(max_year != 'max-year'){
        $('.this_max_year span').text('X');
        $('div.this_max_year').append("<input type='hidden' name='max_year' value='"+max_year+"'>");
      }
      $dropdown_this_max_year.addClass('input_field');

      var $dropdown_number_of_doors = $('.number_of_doors');
      var $dropdown_this_number_of_doors = $('.this_number_of_doors');
      $dropdown_number_of_doors.html('');
      $dropdown_number_of_doors.addClass('select_box');
      $dropdown_number_of_doors.append($("<option>").val('').text('No. of doors (any)'));
      var count = Object.keys(show_data.number_of_doors).length;
      $.each(show_data.number_of_doors, function(key, value){
        if(count == 1 && number_of_doors != 'number-of-doors'){
          $dropdown_number_of_doors.hide();
          $dropdown_this_number_of_doors.show();
          $dropdown_this_number_of_doors.val(key);
          $dropdown_this_number_of_doors.prop('disabled', true);
          $dropdown_this_number_of_doors.css('background-color', '#fff');
          $('.this_number_of_doors span').text('X');
          $('div.this_number_of_doors').append("<input type='hidden' name='number_of_doors' value='"+key+"'>");
        }
        else if (count == 1) {
          $dropdown_number_of_doors.hide();
          $dropdown_this_number_of_doors.show();
          $dropdown_this_number_of_doors.val(key);
          $dropdown_this_number_of_doors.prop('disabled', true);
          $dropdown_this_number_of_doors.css('background-color', '#fff');
        }
        else {
          $dropdown_number_of_doors.append($("<option>").val(key).text(key+" doors "+"("+value+")"));
        }
      });
      $dropdown_this_number_of_doors.addClass('input_field');

    }

    function append_count_data_in_selects(show_data) {

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
          $dropdown_this_make.css('background-color', '#fff');
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
          $dropdown_this_model.css('background-color', '#fff');
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
          $dropdown_this_min_price.val(key);
          $dropdown_this_min_price.prop('disabled', true);
          $dropdown_this_min_price.css('background-color', '#fff');
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
          $dropdown_this_max_price.val(key);
          $dropdown_this_max_price.prop('disabled', true);
          $dropdown_this_max_price.css('background-color', '#fff');
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

      var $dropdown_body_style = $('.body_style');
      var $dropdown_this_body_style = $('.this_body_style');
      var hidden_body_style = $('input:hidden[name="body_style"]').val();

      $dropdown_body_style.html('');
      $dropdown_body_style.addClass('select_box');
      $dropdown_body_style.append($("<option>").val('').text('Body type (all)'));
      var count_body_style = Object.keys(show_data.body_style).length;
      $.each(show_data.body_style, function(key, value){
        if(count_body_style == 1){
          $dropdown_body_style.hide();
          $dropdown_this_body_style.show();
          $dropdown_this_body_style.val(key);
          $dropdown_this_body_style.prop('disabled', true);
          $dropdown_this_body_style.css('background-color', '#fff');
        }
        else if (count_body_style > 1 && hidden_body_style == undefined) {
          $dropdown_this_body_style.hide();
          $dropdown_body_style.show();
          $dropdown_body_style.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
        else {
          $dropdown_body_style.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });

      $dropdown_this_body_style.addClass('input_field');

      var $dropdown_mileage = $('.mileage');
      var $dropdown_this_mileage = $('.this_mileage');
      var hidden_mileage = $('input:hidden[name="mileage"]').val();

      $dropdown_mileage.html('');
      $dropdown_mileage.addClass('select_box');
      $dropdown_mileage.append($("<option>").val('').text('Mileage (any)'));
      var count_mileage = Object.keys(show_data.mileage).length;
      $.each(show_data.mileage, function(key, value){
        if(count_mileage == 1){
          $dropdown_mileage.hide();
          $dropdown_this_mileage.show();
          $dropdown_this_mileage.val(key);
          $dropdown_this_mileage.prop('disabled', true);
          $dropdown_this_mileage.css('background-color', '#fff');
        }
        else if (count_mileage > 1 && hidden_mileage == undefined) {
          $dropdown_this_mileage.hide();
          $dropdown_mileage.show();
          $dropdown_mileage.append($("<option>").val(key).text("Up to "+key+" "+"("+value+")"));
        }
        else {
          $dropdown_mileage.append($("<option>").val(key).text("Up to "+key+" miles "+"("+value+")"));
        }
      });
      $dropdown_this_mileage.addClass('input_field');

      var $dropdown_min_engine_size = $('.min_engine_size');
      var $dropdown_this_min_engine_size = $('.this_min_engine_size');
      var hidden_min_engine_size = $('input:hidden[name="min_engine_size"]').val();

      $dropdown_min_engine_size.html('');
      $dropdown_min_engine_size.addClass('select_box');
      $dropdown_min_engine_size.append($("<option>").val('').text('Min engine size (any)'));
      var count_min_engine_size = Object.keys(show_data.min_engine_size).length;
      $.each(show_data.min_engine_size, function(key, value){
        if(count_min_engine_size == 1){
          $dropdown_min_engine_size.hide();
          $dropdown_this_min_engine_size.show();
          $dropdown_this_min_engine_size.val(key);
          $dropdown_this_min_engine_size.prop('disabled', true);
          $dropdown_this_min_engine_size.css('background-color', '#fff');
        }
        else if (count_min_engine_size > 1 && hidden_min_engine_size == undefined) {
          $dropdown_this_min_engine_size.hide();
          $dropdown_min_engine_size.show();
          $dropdown_min_engine_size.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
        else {
          $dropdown_min_engine_size.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });
      $dropdown_this_min_engine_size.addClass('input_field');

      var $dropdown_max_engine_size = $('.max_engine_size');
      var $dropdown_this_max_engine_size = $('.this_max_engine_size');
      var hidden_max_engine_size = $('input:hidden[name="max_engine_size"]').val();

      $dropdown_max_engine_size.html('');
      $dropdown_max_engine_size.addClass('select_box');
      $dropdown_max_engine_size.append($("<option>").val('').text('Max engine size (any)'));
      var count_max_engine_size = Object.keys(show_data.max_engine_size).length;
      $.each(show_data.max_engine_size, function(key, value){
        if(count_max_engine_size == 1){
          $dropdown_max_engine_size.hide();
          $dropdown_this_max_engine_size.show();
          $dropdown_this_max_engine_size.val(key);
          $dropdown_this_max_engine_size.prop('disabled', true);
          $dropdown_this_max_engine_size.css('background-color', '#fff');
        }
        else if (count_max_engine_size > 1 && hidden_max_engine_size == undefined) {
          $dropdown_this_max_engine_size.hide();
          $dropdown_max_engine_size.show();
          $dropdown_max_engine_size.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
        else {
          $dropdown_max_engine_size.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });

      $dropdown_this_max_engine_size.addClass('input_field');

      var $dropdown_fuel_type = $('.fuel_type');
      var $dropdown_this_fuel_type = $('.this_fuel_type');
      var hidden_fuel_type = $('input:hidden[name="fuel_type"]').val();

      $dropdown_fuel_type.html('');
      $dropdown_fuel_type.addClass('select_box');
      $dropdown_fuel_type.append($("<option>").val('').text('Fuel type (any)'));
      var count_fuel_type = Object.keys(show_data.fuel_type).length;
      $.each(show_data.fuel_type, function(key, value){
        if(count_fuel_type == 1){
          $dropdown_fuel_type.hide();
          $dropdown_this_fuel_type.show();
          $dropdown_this_fuel_type.val(key);
          $dropdown_this_fuel_type.prop('disabled', true);
          $dropdown_this_fuel_type.css('background-color', '#fff');
        }
        else if (count_fuel_type > 1 && hidden_fuel_type == undefined) {
          $dropdown_this_fuel_type.hide();
          $dropdown_fuel_type.show();
          $dropdown_fuel_type.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
        else {
          $dropdown_fuel_type.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });

      $dropdown_this_fuel_type.addClass('input_field');

      var $dropdown_gearbox_type = $('.gearbox_type');
      var $dropdown_this_gearbox_type = $('.this_gearbox_type');
      var hidden_gearbox_type = $('input:hidden[name="gearbox_type"]').val();

      $dropdown_gearbox_type.html('');
      $dropdown_gearbox_type.addClass('select_box');
      $dropdown_gearbox_type.append($("<option>").val('').text('Gearbox type (any)'));
      var count_gearbox_type = Object.keys(show_data.gearbox_type).length;
      $.each(show_data.gearbox_type, function(key, value){
        if(count_gearbox_type == 1){
          $dropdown_gearbox_type.hide();
          $dropdown_this_gearbox_type.show();
          $dropdown_this_gearbox_type.val(key);
          $dropdown_this_gearbox_type.prop('disabled', true);
          $dropdown_this_gearbox_type.css('background-color', '#fff');
        }
        else if (count_gearbox_type > 1 && hidden_gearbox_type == undefined) {
          $dropdown_this_gearbox_type.hide();
          $dropdown_gearbox_type.show();
          $dropdown_gearbox_type.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
        else {
          $dropdown_gearbox_type.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });

      $dropdown_this_gearbox_type.addClass('input_field');

      var $dropdown_min_year = $('.min_year');
      var $dropdown_this_min_year = $('.this_min_year');
      var hidden_min_year = $('input:hidden[name="min_year"]').val();

      $dropdown_min_year.html('');
      $dropdown_min_year.addClass('select_box');
      $dropdown_min_year.append($("<option>").val('').text('Min year (any)'));
      var count_min_year = Object.keys(show_data.min_year).length;
      $.each(show_data.min_year, function(key, value){
        if(count_min_year == 1){
          $dropdown_min_year.hide();
          $dropdown_this_min_year.show();
          $dropdown_this_min_year.val(key);
          $dropdown_this_min_year.prop('disabled', true);
          $dropdown_this_min_year.css('background-color', '#fff');
        }
        else if (count_min_year > 1 && hidden_min_year == undefined) {
          $dropdown_this_min_year.hide();
          $dropdown_min_year.show();
          $dropdown_min_year.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
        else {
          $dropdown_min_year.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });
      $dropdown_this_min_year.addClass('input_field');

      var $dropdown_max_year = $('.max_year');
      var $dropdown_this_max_year = $('.this_max_year');
      var hidden_max_year = $('input:hidden[name="max_year"]').val();

      $dropdown_max_year.html('');
      $dropdown_max_year.addClass('select_box');
      $dropdown_max_year.append($("<option>").val('').text('Max year (any)'));
      var count_max_year = Object.keys(show_data.max_year).length;
      $.each(show_data.max_year, function(key, value){
        if(count_max_year == 1){
          $dropdown_max_year.hide();
          $dropdown_this_max_year.show();
          $dropdown_this_max_year.val(key);
          $dropdown_this_max_year.prop('disabled', true);
          $dropdown_this_max_year.css('background-color', '#fff');
        }
        else if (count_max_year > 1 && hidden_max_year == undefined) {
          $dropdown_this_max_year.hide();
          $dropdown_max_year.show();
          $dropdown_max_year.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
        else {
          $dropdown_max_year.append($("<option>").val(key).text(key+" "+"("+value+")"));
        }
      });
      $dropdown_this_max_year.addClass('input_field');

      var $dropdown_number_of_doors = $('.number_of_doors');
      var $dropdown_this_number_of_doors = $('.this_number_of_doors');
      var hidden_number_of_doors = $('input:hidden[name="number_of_doors"]').val();

      $dropdown_number_of_doors.html('');
      $dropdown_number_of_doors.addClass('select_box');
      $dropdown_number_of_doors.append($("<option>").val('').text('No. of doors (any)'));
      var count_number_of_doors = Object.keys(show_data.number_of_doors).length;
      $.each(show_data.number_of_doors, function(key, value){
        if(count_number_of_doors == 1){
          $dropdown_number_of_doors.hide();
          $dropdown_this_number_of_doors.show();
          $dropdown_this_number_of_doors.val(key);
          $dropdown_this_number_of_doors.prop('disabled', true);
          $dropdown_this_number_of_doors.css('background-color', '#fff');
        }
        else if (count_number_of_doors > 1 && hidden_number_of_doors == undefined) {
          $dropdown_this_number_of_doors.hide();
          $dropdown_number_of_doors.show();
          $dropdown_number_of_doors.append($("<option>").val(key).text(key+" doors "+"("+value+")"));
        }
        else {
          $dropdown_number_of_doors.append($("<option>").val(key).text(key+" doors "+"("+value+")"));
        }
      });
      $dropdown_this_number_of_doors.addClass('input_field');

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
    //   var selected_make = $('input:hidden[name="make"]').val();
    //   var selected_model = $('input:hidden[name="model"]').val();
    //   var selected_min_price = $('input:hidden[name="min_price"]').val();
    //   var selected_max_price = $('input:hidden[name="max_price"]').val();
    //   var selected_body_style = $('input:hidden[name="body_style"]').val();
    //   var selected_mileage = $('input:hidden[name="mileage"]').val();
    //   var selected_min_engine_size = $('input:hidden[name="min_engine_size"]').val();
    //   var selected_max_engine_size = $('input:hidden[name="max_engine_size"]').val();
    //   var selected_fuel_type = $('input:hidden[name="fuel_type"]').val();
    //   var selected_gearbox_type = $('input:hidden[name="gearbox_type"]').val();
    //   var selected_min_year = $('input:hidden[name="min_year"]').val();
    //   var selected_max_year = $('input:hidden[name="max_year"]').val();
    //   var selected_number_of_doors = $('input:hidden[name="number_of_doors"]').val();
    //
    //   if(selected_make == undefined){
    //     var sel_cat = "";
    //   }else {
    //     var sel_cat = spaceByhyphen(selected_make);
    //   }
    //
    //   if(selected_model == undefined){
    //     var sel_model = "";
    //   }else {
    //     var sel_model = spaceByhyphen(selected_model);
    //   }
    //
    //   if(selected_min_price == undefined){
    //     var sel_min_price = "";
    //   }else {
    //     var sel_min_price = spaceByhyphen(selected_min_price);
    //   }
    //
    //   if(selected_max_price == undefined){
    //     var sel_max_price = "";
    //   }else {
    //     var sel_max_price = spaceByhyphen(selected_max_price);
    //   }
    //
    //   if(selected_body_style == undefined){
    //     var sel_body_style = "";
    //   }else {
    //     var sel_body_style = spaceByhyphen(selected_body_style);
    //   }
    //
    //   if(selected_mileage == undefined){
    //     var sel_mileage = "";
    //   }else {
    //     var sel_mileage = spaceByhyphen(selected_mileage);
    //   }
    //
    //   if(selected_min_engine_size == undefined){
    //     var sel_min_engine_size = ""
    //   }else {
    //     var sel_min_engine_size = selected_min_engine_size;
    //   }
    //
    //   if(selected_max_engine_size == undefined){
    //     var sel_max_engine_size = ""
    //   }else {
    //     var sel_max_engine_size = selected_max_engine_size;
    //   }
    //
    //   if(selected_fuel_type == undefined){
    //     var sel_fuel_type = ""
    //   }else {
    //     var sel_fuel_type = spaceByhyphen(selected_fuel_type);
    //   }
    //
    //   if(selected_gearbox_type == undefined){
    //     var sel_gearbox_type = ""
    //   }else {
    //     var sel_gearbox_type = spaceByhyphen(selected_gearbox_type);
    //   }
    //
    //   if(selected_min_year == undefined){
    //     var sel_min_year = ""
    //   }else {
    //     var sel_min_year = spaceByhyphen(selected_min_year);
    //   }
    //
    //   if(selected_max_year == undefined){
    //     var sel_max_year = ""
    //   }else {
    //     var sel_max_year = spaceByhyphen(selected_max_year);
    //   }
    //
    //   if(selected_number_of_doors == undefined){
    //     var sel_number_of_doors = ""
    //   }else {
    //     var sel_number_of_doors = spaceByhyphen(selected_number_of_doors);
    //   }
    //
    //   var data = {
    //     'make': selected_make,
    //     'model': selected_model,
    //     'min_price': selected_min_price,
    //     'max_price': selected_max_price,
    //     'body_style': selected_body_style,
    //     'mileage': selected_mileage,
    //     'min_engine_size': selected_min_engine_size,
    //     'max_engine_size': selected_max_engine_size,
    //     'fuel_type': selected_fuel_type,
    //     'gearbox_type': selected_gearbox_type,
    //     'min_year': selected_min_year,
    //     'max_year': selected_max_year,
    //     'number_of_doors': selected_number_of_doors
    //   };
    //
    //   console.log(data);
    //
    //   $.ajax({
    //     url:"{{ url('/search-results') }}",
    //     type:"GET",
    //     data:data,
    //     dataType:"JSON",
    //     success:function(response){
    //       var urlss = "/search-results/"+sel_cat+"/"+sel_model+"/"+sel_min_price+"/"+sel_max_price+"/"+sel_body_style+"/"+sel_mileage+"/"+sel_min_engine_size+"/"+sel_max_engine_size+"/"+sel_fuel_type+"/"+sel_gearbox_type+"/"+sel_min_year+"/"+sel_max_year+"/"+sel_number_of_doors;
    //       console.log(urlss);
    //     },
    //   });
    //
    //   // window.location.href="/search-results/"+sel_cat+"/"+sel_model+"/"+sel_min_price+"/"+sel_max_price+"/"+sel_body_style+"/"+sel_mileage+"/"+sel_min_engine_size+"/"+sel_max_engine_size+"/"+sel_fuel_type+"/"+sel_gearbox_type+"/"+sel_min_year+"/"+sel_max_year+"/"+sel_number_of_doors;
    });

    $('#cars_search_form select').on('change', function(event){
      event.preventDefault();
      // $('.search_button').prop('disabled', false);
      // $('.search_button').css('cursor', 'pointer');
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
      var selected_body_style = $('input:hidden[name="body_style"]').val();
      var selected_mileage = $('input:hidden[name="mileage"]').val();
      var selected_min_engine_size = $('input:hidden[name="min_engine_size"]').val();
      var selected_max_engine_size = $('input:hidden[name="max_engine_size"]').val();
      var selected_fuel_type = $('input:hidden[name="fuel_type"]').val();
      var selected_gearbox_type = $('input:hidden[name="gearbox_type"]').val();
      var selected_min_year = $('input:hidden[name="min_year"]').val();
      var selected_max_year = $('input:hidden[name="max_year"]').val();
      var selected_number_of_doors = $('input:hidden[name="number_of_doors"]').val();

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

      if(selected_body_style == undefined){
        selected_body_style = "body_type"
      }
      if(selected_mileage == undefined){
        selected_mileage = "mileage"
      }
      if(selected_min_engine_size == undefined){
        selected_min_engine_size = "min_engine_size"
      }
      if(selected_max_engine_size == undefined){
        selected_max_engine_size = "max_engine_size"
      }
      if(selected_fuel_type == undefined){
        selected_fuel_type = "fuel_type"
      }
      if(selected_gearbox_type == undefined){
        selected_gearbox_type = "gearbox_type"
      }
      if(selected_min_year == undefined){
        selected_min_year = "min_year"
      }
      if(selected_max_year == undefined){
        selected_max_year = "max_year"
      }
      if(selected_number_of_doors == undefined){
        selected_number_of_doors = "number_of_doors"
      }

      var data = {
        'make': selected_make,
        'model': selected_model,
        'min_price': selected_min_price,
        'max_price': selected_max_price,
        'body_style': selected_body_style,
        'mileage': selected_mileage,
        'min_engine_size': selected_min_engine_size,
        'max_engine_size': selected_max_engine_size,
        'fuel_type': selected_fuel_type,
        'gearbox_type': selected_gearbox_type,
        'min_year': selected_min_year,
        'max_year': selected_max_year,
        'number_of_doors': selected_number_of_doors
      };

      console.log(data);

      $.ajax({
        url:"{{ url('get_cars_by_company') }}",
        type:"GET",
        data:data,
        dataType:"JSON",
        success:function(response){
          var response_data = JSON.parse(response);
          console.log(response_data);
          append_count_data_in_selects(response_data);
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
      var selected_body_style = $('input:hidden[name="body_style"]').val();
      var selected_mileage = $('input:hidden[name="mileage"]').val();
      var selected_min_engine_size = $('input:hidden[name="min_engine_size"]').val();
      var selected_max_engine_size = $('input:hidden[name="max_engine_size"]').val();
      var selected_fuel_type = $('input:hidden[name="fuel_type"]').val();
      var selected_gearbox_type = $('input:hidden[name="gearbox_type"]').val();
      var selected_min_year = $('input:hidden[name="min_year"]').val();
      var selected_max_year = $('input:hidden[name="max_year"]').val();
      var selected_number_of_doors = $('input:hidden[name="number_of_doors"]').val();

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

      if(selected_body_style == undefined){
        selected_body_style = "body_type"
      }
      if(selected_mileage == undefined){
        selected_mileage = "mileage"
      }
      if(selected_min_engine_size == undefined){
        selected_min_engine_size = "min_engine_size"
      }
      if(selected_max_engine_size == undefined){
        selected_max_engine_size = "max_engine_size"
      }
      if(selected_fuel_type == undefined){
        selected_fuel_type = "fuel_type"
      }
      if(selected_gearbox_type == undefined){
        selected_gearbox_type = "gearbox_type"
      }
      if(selected_min_year == undefined){
        selected_min_year = "min_year"
      }
      if(selected_max_year == undefined){
        selected_max_year = "max_year"
      }
      if(selected_number_of_doors == undefined){
        selected_number_of_doors = "number_of_doors"
      }

      var data = {
        'make': selected_make,
        'model': selected_model,
        'min_price': selected_min_price,
        'max_price': selected_max_price,
        'body_style': selected_body_style,
        'mileage': selected_mileage,
        'min_engine_size': selected_min_engine_size,
        'max_engine_size': selected_max_engine_size,
        'fuel_type': selected_fuel_type,
        'gearbox_type': selected_gearbox_type,
        'min_year': selected_min_year,
        'max_year': selected_max_year,
        'number_of_doors': selected_number_of_doors
      };

      console.log(data);

      $.ajax({
        url:"{{ url('get_cars_by_company') }}",
        type:"GET",
        data:data,
        dataType:"JSON",
        success:function(response){
          var response_data = JSON.parse(response);
          append_count_data_in_selects(response_data);
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
    color: #d90000;
  }
  .btn {
    border-radius: 5px;
  }
  </style>
  @endsection
