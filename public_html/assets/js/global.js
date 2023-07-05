jQuery(document).ready(function(){

  jQuery('.toggle-nav').click(function(e){
    e.stopPropagation();
    console.log('test');
    jQuery(this).toggleClass('active');
    jQuery('header#global nav').toggleClass('active');
  });

	jQuery('header#global nav ul.nav li.nav-item a.nav-link').click(function(e){
    e.stopPropagation();
    jQuery('.toggle-nav').toggleClass('active');
    jQuery('header#global nav').toggleClass('active');
  });

  $(document).keyup(function(e) {
     if (e.keyCode == 27) { // escape key maps to keycode `27`
      jQuery('.toggle-nav').removeClass('active');
      jQuery('header#global nav').removeClass('active');
    }
  });

  // Close nav on outside click
  // jQuery(document).one('click', function closeMenu (e){
  //   if(jQuery('header#global nav').has(e.target).length === 0){
  //     jQuery('.toggle-nav').removeClass('active');
  //     jQuery('header#global nav').removeClass('active');
  //   } else {
  //     jQuery(document).one('click', closeMenu);
  //   }
  // });

	// Dropdowns
	jQuery('.menu-toggle').on('click', function() {
		jQuery(this).toggleClass('menu-active');
    var current_dropdown = jQuery(this).next('.sub-menu');
    jQuery('.sub-menu').not(current_dropdown).removeClass('active');
    current_dropdown.toggleClass('active');
    current_dropdown.slideToggle();
	});

	jQuery('.sub-menu li.nav-item a').on('click', function() {
		jQuery(this).parent().parent().parent('.sub-menu.active').removeClass('active');
		jQuery('header#global nav').removeClass('active');
	});

  // Show/hide
  $('.hidden-el').hide();
  $('.toggle-hidden-el').on('click', function(){
    $(this).toggleClass('hidden-opened');
    $(this).next('.hidden-el').toggle();
  });
});

// Back to top button
jQuery(window).scroll(function() {
	var height = jQuery(window).scrollTop();
	if (height > 300) {
		jQuery('#top').fadeIn();
	} else {
		jQuery('#top').fadeOut();
	}
});

// Sliders

// if($('.splide-slider').length > 0) {
//   var elms = document.getElementsByClassName( 'splide-slider' );
//   for ( var i = 0; i < elms.length; i++ ) {
//     new Splide( elms[ i ] , {
//       type: 'slide',
//       perPage: 1,
//       pagination: false,
//       rewind: false,
//       drag: false,
//       lazyLoad: 'sequential',
//     }).mount();
//   }
// }

// if($('.splide-carousel').length > 0) {
//   var elms = document.getElementsByClassName( 'splide-carousel' );
//   for ( var i = 0; i < elms.length; i++ ) {
//     new Splide( elms[ i ] , {
//       type   : 'slide',
//       perPage: 4,
//       perMove: 1,
//       gap: '1.5rem',
//       pagination: false,
//     }).mount();
//   }
// }

if($('[data-fancybox="gallery"]').length > 0) {
  $('[data-fancybox="gallery"]').fancybox({
    toolbar: "true",
    buttons: [
      //"zoom",
      //"share",
      //"slideShow",
      //"fullScreen",
      //"download",
      //"thumbs",
      "close"
    ],
    protect: true,
    idleTime: false,
    btnTpl: {
      close:
      '<button data-fancybox-close class="fancybox-button fancybox-button--close" title="Close">' +
      '<svg xmlns="http://www.w3.org/2000/svg" width="18.971" height="18.97" viewBox="0 0 18.971 18.97"><path id="close" d="M176.677-845.908l-7.778-7.778-7.778,7.778a1,1,0,0,1-1.415,0,1,1,0,0,1,0-1.414l7.778-7.778-7.778-7.778a1,1,0,0,1,0-1.414,1,1,0,0,1,1.415,0l7.778,7.778,7.778-7.778a1,1,0,0,1,1.415,0,1,1,0,0,1,0,1.414l-7.778,7.778,7.778,7.778a1,1,0,0,1,0,1.414,1,1,0,0,1-.707.293A1,1,0,0,1,176.677-845.908Z" transform="translate(-159.414 864.585)" fill="#af9164"/></svg>' +
      "</button>",
      // Arrows
      arrowLeft:
        '<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="Prev">' +
        '<div><svg xmlns="http://www.w3.org/2000/svg" width="19.971" height="36.97" viewBox="0 0 19.971 36.97"><path id="angle-left" d="M176.41-828.469l-16.97-16.97a1.486,1.486,0,0,1-.439-1.076,1.483,1.483,0,0,1,.439-1.076l16.97-16.97a1.489,1.489,0,0,1,1.061-.439,1.487,1.487,0,0,1,1.06.439,1.489,1.489,0,0,1,.44,1.062,1.49,1.49,0,0,1-.44,1.059l-15.924,15.925,15.924,15.925a1.489,1.489,0,0,1,.44,1.062,1.49,1.49,0,0,1-.44,1.059,1.487,1.487,0,0,1-1.06.439A1.489,1.489,0,0,1,176.41-828.469Z" transform="translate(-159 865)" fill="#fff"/></svg></div>' +
        "</button>",

      arrowRight:
        '<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="Next">' +
        '<div><svg xmlns="http://www.w3.org/2000/svg" width="19.971" height="36.97" viewBox="0 0 19.971 36.97"><path id="angle-right" d="M159.439-828.469a1.488,1.488,0,0,1-.439-1.062,1.485,1.485,0,0,1,.439-1.059l15.925-15.926-15.925-15.924A1.488,1.488,0,0,1,159-863.5a1.489,1.489,0,0,1,.439-1.059A1.489,1.489,0,0,1,160.5-865a1.491,1.491,0,0,1,1.061.439l16.97,16.97a1.49,1.49,0,0,1,.439,1.076,1.491,1.491,0,0,1-.439,1.076l-16.97,16.97a1.491,1.491,0,0,1-1.061.439A1.489,1.489,0,0,1,159.439-828.469Z" transform="translate(-159 865)" fill="#fff"/></svg></div>' +
        "</button>",
    }
  });
}

var vh = window.innerHeight * 0.01;
// Then we set the value in the --vh custom property to the root of the document
document.documentElement.style.setProperty('--vh', `${vh}px`);

// We listen to the resize event
// window.addEventListener('resize', () => {
//   // We execute the same script as before
//   var vh = window.innerHeight * 0.01;
//   document.documentElement.style.setProperty('--vh', `${vh}px`);
// });
