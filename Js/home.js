$(document).ready(function(){
  //autoplay:true,
  //autoplayTimeout:6000,
  if($('.item_viewed_slider1').length){
    var viewedSlider1 = $('.item_viewed_slider1');
    viewedSlider1.owlCarousel({
      loop:true,
      margin:30,
      nav:false,
      dots:false,
      responsive:{
        0:{items:1},
        575:{items:2},
        768:{items:3},
      }
    });

    if($('.prev1').length){
      var prev = $('.prev1');
      prev.on('click', function(){
        viewedSlider1.trigger('prev.owl.carousel');
      });
    }

    if($('.next1').length){
      var next = $('.next1');
      next.on('click', function(){
        viewedSlider1.trigger('next.owl.carousel');
      });
    }
  }

  if($('.item_viewed_slider2').length){
    var viewedSlider2 = $('.item_viewed_slider2');
    viewedSlider2.owlCarousel({
      loop:true,
      margin:30,
      nav:false,
      dots:false,
      responsive:{
        0:{items:1},
        575:{items:2},
        768:{items:3},
      }
    });

    if($('.prev2').length){
      var prev = $('.prev2');
      prev.on('click', function(){
        viewedSlider2.trigger('prev.owl.carousel');
      });
    }

    if($('.next2').length){
      var next = $('.next2');
      next.on('click', function(){
        viewedSlider2.trigger('next.owl.carousel');
      });
    }
  }
});