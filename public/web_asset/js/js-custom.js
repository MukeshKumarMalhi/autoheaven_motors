jQuery(document).ready(function($){

	// $st_owl = $('.owl-carousel.bs-carousel-1');
	// $st_owl.owlCarousel({
	//     loop:true,
	//     margin:15,
	//     nav:true,
	//     navText: ["<div><i class='far fa-angle-left fa-2x px-2'></i></div>","<div><i class='far fa-angle-right fa-2x px-2'></i></div"],
	//     autoplay:true,
	//     dots: false,
	//     responsiveClass:true,
	//     responsive:{
	//         0:{items:2,},
	//         768:{items:3,}
	//     }
	// });


	$('.slick-one').slick({
		dots: true,
		infinite: false,
		speed: 600,
		autoplay: true,
  		autoplaySpeed: 2000,
		slidesToShow: 1,
		slidesToScroll: 1,
	});
	$('.slick-row-two').slick({
		dots: true,
		infinite: false,
		speed: 600,
		autoplay: true,
  		autoplaySpeed: 2000,
		slidesToShow: 1,
		slidesToScroll: 1,
		rows:2,
		// vertical:true,
		// verticalSwiping:true,
	});





	$('.slick-four').slick({
		dots: true,
		infinite: false,
		speed: 600,
		autoplay: true,
		autoplaySpeed: 2000,
		slidesToShow: 4,
		slidesToScroll: 4,
		// responsive: [
		// 	{
		// 		breakpoint: 1024,
		// 		settings: {
		// 			slidesToShow: 3,
		// 			slidesToScroll: 3,
		// 		}
		// 	},
		// 	{
		// 		breakpoint: 600,
		// 		settings: {
		// 			slidesToShow: 2,
		// 			slidesToScroll: 2,
		// 			dots: false,
		// 		}
		// 	},
		// 	{
		// 		breakpoint: 480,
		// 		settings: {
		// 			slidesToShow: 1,
		// 			slidesToScroll: 1,
		// 			dots: false,
		// 		}
		// 	},
		// ],
	});



	$('[data-fancybox="cars-gallery"]').fancybox({
		thumbs : {
			autoStart : true,
			hideOnClose: false
		}
	});

	$('.click-fancybox').on('click', function() {
	  $.fancybox.open( $('[data-fancybox="cars-gallery"]'), {
				thumbs : {
				autoStart : true,
				hideOnClose: false
			}
	  });
	});

	// (Search A Car) Filter by:
	$( "#slider-range-price" ).slider({
        range: true, min: 100000, max: 500000, values: [ 100000, 300000 ],step: 5000,
        create: function() {
            var $max = $(this).slider('values', 1);
            var $min = $(this).slider('values', 0);
            var $num1 =  100000;
            $( "#input-price3tot" ).val($num1 + $max - $min);
            $( "#input-price3tot-text" ).text($num1 + $max - $min);
        },
        slide: function( event, ui ) {
            var $max_min = ui.values[1] - ui.values[0];
            var $num2 =  100000;
            $( "#input-price3tot" ).val($max_min + $num2);
            $( "#input-price3tot-text" ).text($max_min + $num2);
        }
    });

    $( "#slider-range-engine" ).slider({
        range: true, min: 2, max: 9, values: [ 1, 4 ]
    });

    $( "#slider-range-year" ).slider({
        range: true, min: 1, max: 20, values: [ 1, 15 ]
    });

    $(document).ready(function(){
	  $('.bs-radio-ratings .bs-radio-inline').on('mouseover', function(){
	      var onStar = parseInt($(this).find("input").attr('value'), 10);
	        $(this).parent().children('.bs-radio-inline').each(function(e1){
	            if (e1 < onStar) {
	                $(this).addClass('hover');
	            }else {
	                $(this).removeClass('hover');
	            }
	    });
	  }).on('mouseout', function(){
	        $(this).parent().children('.bs-radio-inline').each(function(e1){
	            $(this).removeClass('hover');
	        });
	  });
	  $('.bs-radio-ratings .bs-radio-inline').on('click', function(){
	      var onStar = parseInt($(this).find("input").attr('value'), 10);
	      var stars = $(this).parent().children('.bs-radio-inline');
	      for (i = 0; i < stars.length; i++) {
	          $(stars[i]).removeClass('selected');
	      }
	      for (i = 0; i < onStar; i++) {
	          $(stars[i]).addClass('selected');
	      }
	  });
	});

});////ready
