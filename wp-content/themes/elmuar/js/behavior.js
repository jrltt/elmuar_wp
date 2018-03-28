'use strict';
var lightbox = {
  config : {
    gallery              : '.gallery',          // class of gallery
    galleryImage         : '.image',            // class of image within gallery
    lightboxID           : '#lightbox',         // id of lighbox to be created
    lightboxIDCustom     : '',
    lightboxEnabledClass : 'lightbox-enabled',  // class of body when lighbox is enabled
    buttonsExit          : true,                // include exit div?
    buttonsNavigation    : false,                // include navigation divs?
    containImgMargin     : 0                    // margin top and bottom to contain img
  },
  init : function(config) {
    // merge config defaults with init config
    $.extend(lightbox.config, config);
    // on click
    console.log('lightbox.config.gallery:::', lightbox.config.gallery);
    
    $(lightbox.config.gallery).find('a').on('click', function(event) {
      event.preventDefault();
      console.log($(this));
      
      lightbox.createLightbox($(this));
    });
  },
  // create lightbox
  createLightbox : function($element) {
    console.log('createLightbox::::', $element.closest('.gallery')[0].getAttribute('data-gallery-id'));
    lightbox.config.lightboxIDCustom = '#' + $element.closest('.gallery')[0].getAttribute('data-gallery-id');
    // add body class
    $('body').addClass(lightbox.config.lightboxEnabledClass);
    // remove lightbox if exists
    if ($(lightbox.config.lightboxIDCustom).length) { 
      $(lightbox.config.lightboxIDCustom).remove(); 
    }

    // add new lightbox
    $('body').append('<div id="' + lightbox.config.lightboxIDCustom.substring(1) +'"  class="lightbox"><div class="slider"></div></div>');

    // add exit div if required
    if (lightbox.config.buttonsExit) {
      $(lightbox.config.lightboxIDCustom).append('<div class="exit"></div>');
    }

    // add navigation divs if required
    if (lightbox.config.buttonsNavigation) {
      $(lightbox.config.lightboxIDCustom).append('<div class="prev"></div><div class="next"></div>');
    }
    
    // now populate lightbox
    lightbox.populateLightbox($element);
    
  },
  
  // populate lightbox
  populateLightbox: function($element) {
    var thisgalleryImage = $element.closest(lightbox.config.galleryImage);
    var thisIndex = thisgalleryImage.index();
    // add slides
    $("[data-gallery-id=" + lightbox.config.lightboxIDCustom.substring(1) + "]").children(lightbox.config.galleryImage).each(function(index, value) {
      console.log('lightbox.config.lightboxIDCustom', lightbox.config.lightboxIDCustom);

      $(lightbox.config.lightboxIDCustom + ' .slider').append('<div class="slide"><div class="frame"><div class="valign"><img src="' + $(this).find('a').attr('href') + '"></div></div></div>');
    });
    
    // now initalise flickity
    lightbox.initFlickity(thisIndex);
    
  },
  
  // initalise flickity
  initFlickity : function(thisIndex) {
    console.log($(lightbox.config.lightboxIDCustom).find('.slider'));
    
    $(lightbox.config.lightboxIDCustom).find('.slider').flickity({ // more options: https://flickity.metafizzy.co
      resize: true,
      wrapAround: false,
      prevNextButtons: true,
      pageDots: false,
      initialIndex: thisIndex
    });
    
    // make sure image isn't too tall
    lightbox.containImg();
    
    // on window resize make sure image isn't too tall
    $(window).on('resize', function() {
      lightbox.containImg();
    });
    
    // buttons
    var $slider = $(lightbox.config.lightboxIDCustom).find('.slider').flickity();
    
    $(lightbox.config.lightboxIDCustom).find('.exit').on('click', function() {
      $('body').removeClass('lightbox-enabled');
      setTimeout(function() {
        $slider.flickity('destroy');
        $(lightbox.config.lightboxIDCustom).remove();
      }, 0);
    });
    
    $(lightbox.config.lightboxIDCustom).find('.prev').on('click', function() {
      $slider.flickity('previous');
    });
    
    $(lightbox.config.lightboxIDCustom).find('.next').on('click', function() {
      $slider.flickity('next');
    });
    
    // keyboard
    $(document).keyup(function(event) {
      if ($('body').hasClass('lightbox-enabled')) {
        switch (event.keyCode) {
          case 27:
            $(lightbox.config.lightboxIDCustom).find('.exit').click();
            break;
          case 37:
            $(lightbox.config.lightboxIDCustom).find('.prev').click();
            break;
          case 39:
            $(lightbox.config.lightboxIDCustom).find('.next').click();
            break;
        }
      }
    });
  },
  // contain lightbox images
  containImg : function() {
    $(lightbox.config.lightboxIDCustom).find('img').css('maxHeight', ($(document).height() - lightbox.config.containImgMargin));
  }
};

(function($) {
  $('.menu-item a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname === this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
  
  var $container = $('.carousel' );
  var $caption = $('.caption');
  $container.on('select.flickity', function() {
    var flkty = $container.data('flickity');
    if (flkty.selectedElement !== undefined) {
      var image = $(flkty.selectedElement).children().children()[0];
      $caption.text(image.alt);
    }
  });

  lightbox.init({
    containImgMargin : 1
  }); 
})(jQuery);

var body = document.querySelector('body');
if (classie.hasClass(body, 'page-template-parcour')) {
  var toggles = document.querySelector('div.tailor-toggles');
  for (var i = 0; i <= 1; i++) {
    classie.toggleClass(toggles.children[i].children[0], 'is-active');
    classie.toggleClass(toggles.children[i].children[1], 'show--text');
  }
}

var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
    layer = document.getElementById( 'layer' ),
    showLeftPush = document.getElementById( 'showLeftPush' ),
    body = document.getElementById( 'content' ),
    menuButton = document.getElementById('menuButton');

showLeftPush.onclick = function(e) {
  e.preventDefault();
  classie.toggle( this, 'active' );
  classie.toggle( layer, 'active' );
  classie.toggle( body, 'cbp-spmenu-push-toright' );
  classie.toggle( menuLeft, 'cbp-spmenu-open' );
  classie.toggle( menuButton, 'is-active');
  disableOther( 'showLeftPush' );
};

layer.onclick = function(e) {
  e.preventDefault();
  classie.toggle( this, 'active' );
  classie.toggle( body, 'cbp-spmenu-push-toright' );
  classie.toggle( menuLeft, 'cbp-spmenu-open' );
  classie.toggle( menuButton, 'is-active');
  disableOther( 'showLeftPush' );
};

function disableOther( button ) {
  if( button !== 'showLeftPush' ) {
    classie.toggle( showLeftPush, 'disabled' );
  }
}
