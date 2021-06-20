/*$(document).ready(function (){
    $("li.nav-item > div").click( function (){

    //$("li.nav-item div.lien > div").addClass("active");
    //$("div.car").show()
    //id = EventSource
    alert("hello"+this.id)
})
})*/

$(document).ready(function (){
    $("li.nav-item > div").click( function (){
        $(".lien a").css('font-size','20px');
        $("#"+this.id+" a").css('font-size','25px');
        $(".car").css('display','none');
        $("#"+this.id+" .car").css('display','block');

})
})
$(function () {
    $(document).scroll(function () {
      var $sociel=$(".products");
      $sociel.toggleClass('scrollen', $(this).scrollTop() > 700);
      var $social=$(".order");
      $social.toggleClass('scrolled', $(this).scrollTop() > 700);
      
    });
  });
  $(document).ready(function(){
    $(".supplement").on('click',function(){
      let id = $(this).attr('data-id')
      $("#supp_"+id).toggle(700);
    });
 })
 $(document).ready(function(){
    $(".composant").on('click',function(){
      let id = $(this).attr('data-id')
      $("#com_"+id).toggle(700);
    });
 })
$(document).ready(function(){
    $(".increase").on('click',function() {
        let id = $(this).attr('data-id');
        var currentVal = parseInt($('.quantite_'+id).val());
        if (currentVal != NaN && (currentVal + 1) <= 10) {
          $('.quantite_'+id).val(currentVal + 1);
        }
    });
      $(".decrease").on('click',function() {
        let id = $(this).attr('data-id');
        var currentVal = parseInt($('.quantite_'+id).val());
        if (currentVal != NaN && currentVal != 0) {
          $('.quantite_'+id).val(currentVal - 1);
        }
    });

});