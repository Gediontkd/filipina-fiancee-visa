	window.onscroll = function() {myFunction()};

		var header = document.getElementById("myHeader");
		var sticky = header.offsetTop;

		function myFunction() {
		  if (window.pageYOffset > sticky) {
			header.classList.add("sticky");
		  } else {
			header.classList.remove("sticky");
		  }
		}
			 /*-----------------------------------
  ----------- Brands Carousel -----------
  ------------------------------------*/
		$('.logocarousel').owlCarousel({
		loop:true,
		margin:30,
		nav:false,
		dots:false,
		autoplay:true,
		responsive:{
		0:{
		items:1
		},
		320:{
		items:3
		},
		767:{
		items:3
		},
		1000:{
		items:6
		},1400:{
		items:6
		}
		}	
			});

  /*-----------------------------------
  ----------- Scroll To Top -----------
  ------------------------------------*/
    $(window).scroll(function () {
      if ($(this).scrollTop() > 1000) {
          $('#back-top').fadeIn();
      } else {
          $('#back-top').fadeOut();
      }
    });
    // scroll body to 0px on click
    $('#back-top').on('click', function () {
      $('#back-top').tooltip('hide');
      $('body,html').animate({
          scrollTop: 0
      }, 1500);
      return false;
    });		
	AOS.init({
				easing: 'ease-out-back',
				duration: 1000
			});
			
			
	$(window).on('load', function() {
	
		"use strict";
						
		/*----------------------------------------------------*/
		/*	Preloader
		/*----------------------------------------------------*/
		
		$("#loader").delay(100).fadeOut();
		$("#loader-wrapper").delay(100).fadeOut("fast");
		
	});
				/*----------------------------------------------------*/
		/*	Reviews Grid
		/*----------------------------------------------------*/

		$('.grid-loaded').imagesLoaded(function () {
	        var $grid = $('.masonry-wrap').isotope({
	            itemSelector: '.review-2',
	            percentPosition: true,
	            transitionDuration: '0.7s',
	            masonry: {
	              columnWidth: '.review-2',
	            }
	        });	        
	    });

				