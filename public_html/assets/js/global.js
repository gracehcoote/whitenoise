$(document).ready(function(){
  // Compensate for nav bar height
  var headerHeight = $('.navigation-bar').outerHeight();
  var navSpacerTop = headerHeight;
  $('.hero').css('padding-top', navSpacerTop + 'px');
  $('nav#global, footer#global-footer').css('padding-top', navSpacerTop - '20' + 'px');

  // Show/hide navigation
  $('.toggle-nav').click(function(e){
    e.stopPropagation();
    $(this).toggleClass('active');
    $('body, header#global, nav#global').toggleClass('active');
    var nearestNav = $(this).parents().closest('.navigation-bar');
    $(this).parents().find('.navigation-bar').not(nearestNav).fadeToggle();
    nearestNav.toggleClass('active');

    setTimeout(function () {
      $('ul.nav').toggleClass('active');
      $('.info-wrap').toggleClass('active');
    }, 500);
  });

  // Close navigation methods
	$('.navigation-bar nav ul.nav li.nav-item a.nav-link').click(function(e){
    e.stopPropagation();
    $('body, .toggle-nav, header#global, nav#global').toggleClass('active');
    $('.navigation-bar').toggleClass('fixed');
  });

  $(document).keyup(function(e) {
      if (e.keyCode == 27) { // escape key maps to keycode `27
      $('body, .toggle-nav, header#global, nav#global').removeClass('active');
      $('.navigation-bar').toggleClass('fixed');
    }
  });

  // Show footer navigation
  $('footer#global-footer .navigation-bar').hide();
  
  var footerOffset = $('footer#global-footer').offset().top;
  var footerPos = footerOffset - $(window).scrollTop();
  var revealPoint = $(window).height()/3;

  if (footerPos <= revealPoint) {
    $('footer#global-footer .navigation-bar').fadeIn();
  } else {
    $('footer#global-footer .navigation-bar').fadeOut();
  }

  $(window).scroll(function() {
    var footerOffset = $('footer#global-footer').offset().top;
    var footerPos = footerOffset - $(window).scrollTop();
    var revealPoint = $(window).height()/3;

    if (footerPos <= revealPoint) {
      $('footer#global-footer .navigation-bar').fadeIn();
    } else {
      $('footer#global-footer .navigation-bar').fadeOut();
    }
  });

  // Scroll top when using navigation
  $('header#global .toggle-nav').click(function(){
    $('html, body').animate({
      scrollTop: $('header#global').offset().top
    }, 'slow');
  });

  $('footer#global-footer .toggle-nav').click(function(){
    $('header#global .navigation-bar').fadeToggle();
    $('html, body').animate({
      scrollTop: $('footer#global-footer').offset().top
    }, 'slow');
  });

  // $(window).scroll(function() {
  //   var height = $(window).scrollTop();
  //   var halfWay = $(document).height()/2;

  //   if (height == halfway ) {
  //     $('footer#global-footer .navigation-bar').fadeIn();
  //   } else {
  //     $('footer#global-footer .navigation-bar').fadeOut();
  //   }
  // });
});

// Announcement bar

setTimeout(function () {
  $('.home #announcement-bar').slideToggle();
}, 1000);

// Back to top button
$(window).scroll(function() {
	var height = $(window).scrollTop();
	if (height > 300) {
		$('#top').fadeIn();
	} else {
		$('#top').fadeOut();
	}
});

// Show/hide (Desktop)
if($('.hidden-el:not(.hidden-mob)').length > 0) {
  $('.hidden-el:not(.hidden-mob)').hide();
  $('.hidden-el-toggle:not(.hidden-mob)').on('click', function(){
    $(this).toggleClass('hidden-opened');
    $(this).next('.hidden-el:not(.hidden-mob)').slideToggle();
  });
}

if($('.hidden-el.hidden-mob').length > 0) {
  if($(window).width() <= 667) {
    $('.hidden-el.hidden-mob').hide();
    $('.hidden-el-toggle.hidden-mob').on('click', function(){
      $(this).toggleClass('hidden-opened');
      $(this).next('.hidden-el.hidden-mob').slideToggle();
    });
  }
}

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

// Sliders 

if($('.image-slider').length > 0) {
  var elms = document.getElementsByClassName( 'image-slider' );

  for ( var i = 0; i < elms.length; i++ ) {
    new Splide( elms[ i ], {
      type: 'loop',
      rewind: false,
      lazyLoad: 'sequential',
    }).mount();
  }
}

if($('.carousel-slider').length > 0) {
  var sliders = document.getElementsByClassName('carousel-slider');

  $(sliders).each(function (index, element) {
    var splideCarousel = new Splide(element, {
      perPage: 2,
      lazyLoad: 'nearby',
      breakpoints: {
        991: {
          perPage: 1,
          // padding: '10%',
        }
      },
      perMove: 1,
      arrows: false,
      trimSpace: false,
      type: 'slide',
      pagination: false,
    });

    var bar = splideCarousel.root.querySelector('.carousel-progress-bar');

    // Store the carousel instance within the element using $'s data() method.
    $(element).data('splideCarousel', splideCarousel);

    // Updates the bar width whenever the carousel moves:
    splideCarousel.on('mounted move', function () {
      var splideCarouselInstance = $(element).data('splideCarousel');
      var end = splideCarouselInstance.Components.Controller.getEnd() + 1;
      var rate = Math.min((splideCarouselInstance.index + 1) / end, 1);
      bar.style.width = String(100 * rate) + '%';
    });

    splideCarousel.mount();
  });

  $('.carousel-slider').each(function() {
    var slider = $(this);
    var slideCount = $(this).find('.splide__slide');
      if ($(window).width() > 991) {
        if (slideCount.length < 3) {
          slider.find('.carousel-navigation').hide();
        }
      }
      if ($(window).width() < 990) {
        if (slideCount.length < 2) {
          slider.find('.carousel-navigation').hide();
        }
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
