$(document).ready(function(){
  $(".story").fadeIn(1000)
  // $("#slideshow > div:gt(0)").hide();

  // setInterval(function() { 
  //   $('#slideshow > div:first')
  //     .fadeOut(1000)
  //     .next()
  //     .fadeIn(1500)
  //     .end()
  //     .appendTo('#slideshow');
  // },  5000);
     

});
$(function () {
  $(document).scroll(function () {
    var $nav = $(".head");
    $nav.toggleClass('scrolled', $(this).scrollTop() > 750);
    var $sociel=$(".social");
    $sociel.toggleClass('scrollen', $(this).scrollTop() > 4200);
    var $change=$(".change");
    $change.toggleClass('scrolleh', $(this).scrollTop() > 4200);

  });
});


$(document).ready(function(){
  var root = document.getElementsByTagName( 'html' )[0]; // '0' to assign the first (and only `HTML` tag)
  root.setAttribute( 'class', 'js' );
  
  
  $(".to_fade_up").waypoint(function(){
    $(this[0,'element']).addClass("fade_up");
  }, {
    triggerOnce: true,
    offset: '75%'
  });
  
  })

$(document).ready(function(){
    $(".bstory").on('click',function(){
      $(".data").hide();
      $(".story").fadeIn(1000)
    
    });
});



$(document).ready(function(){
    $(".bteam").on('click',function(){
      $(".data").hide();
      $(".team").fadeIn(1000)
    });

});

$(document).ready(function(){
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    autoplay:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
  })
})

