'use strict';
var lightbox = {
  config : {
    gallery              : '.gallery',          // class of gallery
    galleryImage         : '.image',            // class of image within gallery
    contentBox           : '.custom--content-box',
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
    $(lightbox.config.gallery).find('a').on('click', function(event) {
      event.preventDefault(); 
      lightbox.createLightbox($(this));
    });
  },
  // create lightbox
  createLightbox : function($element) {
    if (!$element.closest('.gallery')[0]) {
      return;
    }
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
      $(lightbox.config.lightboxIDCustom).append('<div class="exit is-active"><div class="burger-icon"></div></div>');
    }

    // add navigation divs if required
    if (lightbox.config.buttonsNavigation) {
      $(lightbox.config.lightboxIDCustom).append('<div class="prev"></div><div class="next"></div>');
    }
    
    $(lightbox.config.lightboxIDCustom).prepend('<div class="project__title entry--content__title">'+$element.closest('.gallery')[0].getAttribute('data-gallery-title')+'</div>');

    // now populate lightbox
    lightbox.populateLightbox($element);
  },
  // populate lightbox
  populateLightbox: function($element) {
    var thisGalleryImage = $element.closest(lightbox.config.galleryImage);
    var totalItems = $element.closest('.gallery')[0].childNodes.length;
    console.log('init', totalItems);
    
    var thisIndex = thisGalleryImage.index() !== -1 ? thisGalleryImage.index() : totalItems - 1;
    
    var currentGallery = "[data-gallery-id=" + lightbox.config.lightboxIDCustom.substring(1) + "]";
    // add slides
    $(currentGallery).children(lightbox.config.galleryImage).each(function(index, value) {
      $(lightbox.config.lightboxIDCustom + ' .slider').append('<div class="slide"><div class="frame"><div class="valign"><img data-flickity-lazyload="' + $(this).find('a').attr('data-href') + '"></div></div></div>');
    });
    var contentClone = document.querySelector(currentGallery + ' ' + lightbox.config.contentBox).cloneNode(true);
    contentClone.classList.add('slide');
    $(lightbox.config.lightboxIDCustom + ' .slider').append($(contentClone));

    // now initalise flickity
    lightbox.initFlickity(thisIndex);
  },
  // initalise flickity
  initFlickity : function(thisIndex) {
    $(lightbox.config.lightboxIDCustom).find('.slider').flickity({ // more options: https://flickity.metafizzy.co
      resize: true,
      prevNextButtons: true,
      pageDots: false,
      initialIndex: thisIndex,
      imagesLoaded: true,
      lazyLoad: 1,
      adaptiveHeight: true
    });
    
    // make sure image isn't too tall
    // lightbox.containImg();
    
    // on window resize make sure image isn't too tall
    $(window).on('resize', function() {
      // lightbox.containImg();
    });
    
    // buttons
    var $slider = $(lightbox.config.lightboxIDCustom).find('.slider').flickity();
    
    $(lightbox.config.lightboxIDCustom).find('.exit').on('click', function() {
      $('body').removeClass('lightbox-enabled');
      // $(lightbox.config.lightboxIDCustom).fadeOut(400, function () {
        setTimeout(function() {
          $slider.flickity('destroy');
          $(lightbox.config.lightboxIDCustom).remove();
        }, 0);
      // });
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
  var $container = $('.carousel');
  var $caption = $('.caption');
  $container.on('select.flickity', function() {
    var flkty = $container.data('flickity');
    if (flkty.selectedElement !== undefined) {
      var image = $(flkty.selectedElement).children().children()[0];
      $caption.text(image.alt);
    }
  });
  
  var mobileFlkt = false;
  var desktopFlkt = true;
  var body = document.querySelector('body');

  $(window).resize(function () {
    if (body.classList.contains('page-template-projects')) { 
      if ($(window).width() <= 767) {
        $('.gallery').removeClass('gallery');
          $('.table__projects').flickity({ 
            imagesLoaded: true,
            prevNextButtons: true,
            pageDots: false,
            cellAlign: 'center',
            lazyLoad: 1
          });
        mobileFlkt = true;
        desktopFlkt = !desktopFlkt;
      } else {
        console.log('mobileFlkt', mobileFlkt, '\n *** desktopFlkt ', desktopFlkt);
        if (mobileFlkt) {
          $('.table__projects').flickity('destroy');
          $('.table__projects').addClass('gallery');
        }
        var anchors = $('.table__projects--child a:not(".custom--content__link"):not(".custom--content__link-main")');
        $(anchors).each(index => {
          anchors[index].childNodes[0].src = anchors[index].dataset.href2;  
        });
        
        lightbox.init({
          containImgMargin : 1
        });

        desktopFlkt = true;
        mobileFlkt = false;
      }
    }
  }).resize();
  // lightbox.init({
  //   containImgMargin : 1
  // }); 
  // setTimeout(function() {
  //   $('.table__projects').each(function () {
  //     $(this).children('.table__projects--child').each(function (i) {
  //       $(this).delay(100*i).fadeIn(250);
  //     });
  //   });
  // }, 3000);
})(jQuery);

var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
    layer = document.getElementById( 'layer' ),
    showLeftPush = document.getElementById( 'showLeftPush' ),
    content = document.getElementById( 'content' ),
    menuButton = document.getElementById('menuButton'),
    globalBody = document.body;

showLeftPush.onclick = function(e) {
  e.preventDefault();
  classie.toggle( this, 'active' );
  classie.toggle( layer, 'active' );
  classie.toggle( content, 'cbp-spmenu-push-toright' );
  classie.toggle( menuLeft, 'cbp-spmenu-open' );
  classie.toggle( menuButton, 'is-active');
  classie.toggle(globalBody, 'right-menu-open');
  disableOther( 'showLeftPush' );
};

layer.onclick = function(e) {
  e.preventDefault();
  classie.toggle( this, 'active' );
  classie.toggle( content, 'cbp-spmenu-push-toright' );
  classie.toggle( menuLeft, 'cbp-spmenu-open' );
  classie.toggle( menuButton, 'is-active');
  classie.toggle(globalBody, 'right-menu-open');
  disableOther( 'showLeftPush' );
};

function disableOther( button ) {
  if (button !== 'showLeftPush') {
    classie.toggle( showLeftPush, 'disabled' );
  }
}
