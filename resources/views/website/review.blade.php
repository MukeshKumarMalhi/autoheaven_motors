@extends('layouts.app')
@section('title','Reviews')

@section('content')

<!-- section 1 - title -->
<div class="pt-r10 bg-center-url" style="background-image: url('{{ asset('web_asset/images/bg-car-title-img.png') }}');">
    <div class="container text-light">
        <div class="row">
            <div class="offset-1 offset-sm-0 col-10 col-sm-8 col-md-6 col-lg-4 cm-bg-danger-x header-title-top py-80">
                <div class="position-r">
                    <h1>Reviews</h1>
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
                <h2><span class="text-danger">Customer</span> reviews of Auto Haven</h2>
                <p>At Earlsdon Motor Company Ltd we pride ourselves on the great service we provide to all of our customers. We understand that buying a car can be a daunting prospect, so we strive to make the buying process as simple and hassle-free as possible.<br/><br/> But don't just take our word for it, see what some of our customers have to say about us... </p>
                <br/>
                <button data-toggle="modal" data-target="#write-a-review" class="btn btn-danger mr-2 mb-2">WRITE A REVIEW</button>
            </div>
        </div>
    </div>
</div>

<div class="py-4">
    <div class="container pt-80">
        <div class="clearfix">
            <div class="float-left">
                <h2 class="text-danger mb-4"><span class="text-danger">Auto</span> Haven</h2>
            </div>
            <div class="float-right">
                <div class="media">
                    <div class="mr-2"><h2 class="text-danger">{{ $reviews_avg }}.0</h2></div>
                    <div class="media-body">
                        <div class="star-rating text-danger h3" title="100%" style="display: inline-block;margin:0px;padding:0px">
                            <div class="back-stars">
                                <?php
                                  $empty = 5 - $reviews_avg;
                                  for ($i=0; $i < $reviews_avg; $i++) { ?>
                                  <i class="fas fa-star" aria-hidden="true"></i>
                                <?php
                                  }
                                  for ($j=0; $j < $empty; $j++) { ?>
                                  <i class="far fa-star" aria-hidden="true"></i>
                                <?php
                                  }
                                ?>
                            </div>
                        </div>
                        <p class="small">Based on {{ count($reviews) }} customer reviews</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slick-four slick-bottom row mb-4">
          <?php foreach ($reviews as $key => $value): ?>
            <div class="item col-md-12">
              <div class="bg-white border">
                <div class="text-left p-3">
                  <div class="mb-3">
                    <div class="star-rating text-danger" title="100%" style="display: inline-block;margin:0px;padding:0px">
                      <div class="back-stars">
                        <?php
                          $empty = 5 - $value->rating_number;
                          for ($i=0; $i < $value->rating_number; $i++) { ?>
                          <i class="fas fa-star" aria-hidden="true"></i>
                        <?php
                          }
                          for ($j=0; $j < $empty; $j++) { ?>
                          <i class="far fa-star" aria-hidden="true"></i>
                        <?php
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                  <h4>{{ $value->rating_title }}</h4>
                  <p>{{ $value->rating_desc }}</p>
                  <p class="mb-0"><span class="text-danger">By</span> {{ ucwords($value->full_name) }}</p>
                  <p class="mb-0"><span class="text-danger">Date</span> <?php echo date('d/m/Y',strtotime($value->created_at)); ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- <div class="row mt-5 pt-5">
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

<!-- Modal -->
<div class="modal fade" id="write-a-review">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body p-4">
        <div class="review_respose"></div>
        <form id="review-form" class="review_form" method="post" role="form" novalidate>
            <h3 class="text-danger text-center mb-4">How would you rate Autohaven Motors Company Ltd</h3>
            <div class="form-group">
              <input type="text" name="rating_title" class="form-control" placeholder="Title of your review" required>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="rating_desc" rows="5" placeholder="Describe your experience Share the details of your experience and help other car buyers make the right choice." required></textarea>
            </div>
            <div class="row">
                    <div class="form-group col-sm-6">
                        <input type="text" name="full_name" class="form-control" placeholder="Full name" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <input type="text" name="email" class="form-control" placeholder="Email address" required>
                    </div>
                </div>
                <h4 class="text-danger">Stars Ratings</h4>
                <div class="bs-radio-ratings form-group d-table h2 ">
                    <label class="bs-radio-inline"><input type="radio" name="rating_number" value="1"></label>
                    <label class="bs-radio-inline"><input type="radio" name="rating_number" value="2"></label>
                    <label class="bs-radio-inline"><input type="radio" name="rating_number" value="3"></label>
                    <label class="bs-radio-inline"><input type="radio" name="rating_number" value="4"></label>
                    <label class="bs-radio-inline"><input type="radio" name="rating_number" value="5"></label>
                </div>
                <p class="bs-radio-ratings-text">Above click stars</p>
                <h4 class="text-danger">I confirm that my review...</h4>
                <!-- <div class="form-group">
                    <div class="form-check bs-custom-checkbox mb-2">
                        <input type="checkbox" name="confirm[]" class="form-check-input" id="individuals" value="confirmed">
                        <label class="form-check-label d-inline" for="individuals">Doesn't name any individuals.</label>
                    </div>
                </div> -->
                <div class="form-group">
                    <div class="form-check bs-custom-checkbox mb-2">
                        <input type="checkbox" name="confirm" class="form-check-input" id="by-submitting-the-review" value="confirmed">
                        <label class="form-check-label d-inline" for="by-submitting-the-review">By Submitting the review I certify that this rating is based on my genuine experience of services with this dealer. I have no personal or business affiliation with the dealership, past or present. I have read and accepted the moderation rules and how my rating will be used.</label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-danger review-btn submit_button_review">Submit review</button>
                </div>
        </form>
        <div class="loader" style="display:none;"><i class="fas fa-sync fa-spin fa-3x fa-fw"></i></div>
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

  $(".bs-radio-ratings input[type='radio']").on('change', function() {
    var showsec = $("input[name=rating_number]:checked").val();

          if(showsec == '1'){
             $('.bs-radio-ratings-text').text('Terrible');
         }else if(showsec == '2'){
            $('.bs-radio-ratings-text').text('Poor');
         }else if(showsec == '3'){
             $('.bs-radio-ratings-text').text('Average');
         }else if(showsec == '4'){
             $('.bs-radio-ratings-text').text('Good');
         }else if(showsec == '5'){
             $('.bs-radio-ratings-text').text('Excellent');
         }
     });

  $('.review_form').on('submit', function(event){
    event.preventDefault();

    $.ajax({
      url:"{{ url('/store_review_form') }}",
      method:"POST",
      data:new FormData(this),
      dataType:"JSON",
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        if(data.failure){
          $(".loader").hide();
          $('.submit_button_review').prop('disabled', false);
          $(".modal-body form").css('opacity','1');
          $('.review_respose').append('<div class="mx-auto" style="width:80%; text-align: center;"><h2 class="text-danger">'+data.failure[0]+'</h2></div>');
        }else if (data.success) {
          $(".loader").hide();
          $(".review_form")[0].reset();
          $(".modal-body form").css('opacity','1');
          $('.submit_button_review').prop('disabled', false);
          $('.review_respose').append('<div class="mx-auto" style="width:80%; text-align: center;"><h2 class="text-danger">'+data.success+'</h2><p>We will aim to get back to you as soon as possible.</p></div>');
          // $('.modal-body').css('text-align', 'center');
          setTimeout(function(){ $('#write-a-review').modal('hide'); },3000);
          setTimeout(function(){ $('body').removeClass('modal-open'); },3000);
          setTimeout(function(){ $('.modal-backdrop').remove(); },3000);
          location.reload();
        }
      },
    });
  });

  $(function() {
    var form2 = $('#review-form');
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
            $('.submit_button_review').prop('disabled', true);
            $(".loader").show();
            $(".modal-body form").css('opacity','0.5');
          },
    });
  });
});
</script>
<style media="screen">
.form-control{
  border-radius: 5px;
}
.btn{
  border-radius: 5px;
}
.modal-body{position: relative;}
.modal-body .loader{position:absolute;width:100%; display:block;left:50%;top:50%;transform: translate(-50%,-50%);text-align:center; z-index: 1;}
</style>
@endsection
