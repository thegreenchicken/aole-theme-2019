document.addEventListener("DOMContentLoaded", function (event) {
  console.log("fixing the height of $(.items-wrapper .item-container) elements to prevent white gaps");
  var respond=function(){
    if($(window).width()<769) return;
    $(".items-wrapper .item-container").each(function(){
      var $imgel=$(this).find('img');
      if($(this).css("height")>$imgel.css("height")){
        $imgel.css({height:""});
        //twice because text re-wraps, wich may make the container bigger
        $imgel.css({height:$(this).css("height")});
        $imgel.css({height:$(this).css("height")});
      }
    });
  }

  $(window).on("resize", respond);
  respond();
});
