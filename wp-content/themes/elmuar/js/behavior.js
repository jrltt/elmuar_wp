'use strict';

/*window.addEventListener("resize", function(){
    // fire when above 1203
    if (document.documentElement.clientWidth > 480) {
      console.log('Greater!');
    }
    // fire when below 1203
    else {
      console.log('Smaller!');
      var flkty = new Flickity( '#carousel', {
       // options
       cellAlign: 'left',
       contain: true
     });
    }
}, true);*/

(function($) {
  $('.menu-item a[href*="#"]:not([href="#"])').click(function() {
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
  // $('.zoomTarget').zoomTo({
  //   root: $('.projects')
  // });
})(jQuery);

var body = document.querySelector('body');
if (classie.hasClass(body, 'page-template-parcour')) {
  var toggles = document.querySelector('div.tailor-toggles');
  for (var i = 0; i <= 1; i++) {
    classie.toggleClass(toggles.children[i].children[0], 'is-active');
    classie.toggleClass(toggles.children[i].children[1], 'show--text');
  }
}
// var elem = document.querySelector('.carousel');
// var flkty = new Flickity( elem, {
//   // options
//   cellAlign: 'left',
//   contain: true
// });
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

/*menuButton.addEventListener('click', function (e) {
  menuButton.classList.toggle('is-active');
  e.preventDefault();
});*/
