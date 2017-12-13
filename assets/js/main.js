(function($) {
  'use strict';

  $('.lightslider').lightSlider({
    item:1,
    loop:true,
    easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
    speed:600,
    onSliderLoad: function() {
      $('.lightslider').removeClass('cS-hidden');
    }
  });
})(jQuery);
