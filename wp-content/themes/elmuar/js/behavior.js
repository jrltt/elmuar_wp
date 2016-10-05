'use strict';

console.log('hello bro!!1');

// window.addEventListener("resize", function(){
//     // fire when above 1203
//     if (document.documentElement.clientWidth > 480) {
//       console.log('Greater!');
//     }
//     // fire when below 1203
//     else {
//       console.log('Smaller!');
//       var flkty = new Flickity( '#carousel', {
//        // options
//        cellAlign: 'left',
//        contain: true
//      });
//     }
// }, true);
//
(function($) {
  $('.menu-item a[href*="#"]:not([href="#"])').click(function() {
    console.log('hoal');
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
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
})(jQuery);

var body = document.querySelector('body');
if (classie.hasClass(body, 'page-template-parcour')) {
  var toggles = document.querySelector('div.tailor-toggles');
  for (var i = 0; i <= 1; i++) {
    classie.toggleClass(toggles.children[i].children[0], 'is-active');
    classie.toggleClass(toggles.children[i].children[1], 'show--text');
  }
}