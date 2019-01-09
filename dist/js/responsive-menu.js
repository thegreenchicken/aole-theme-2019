/*
this script causes the main menu to switch between mobile and desktop versions. The disctinction however, is done by screen width.
*/
document.addEventListener("DOMContentLoaded", function (event) {
  var mouse={}
  var $mainMenu=$(".header-container");//.main-menu-container"
  var isCollapsed=false;
  function sizeUpdateFn(){
    if($(window).width() < 550){
      if(!isCollapsed){
        isCollapsed=true;
        console.log("menu collapse");
        $mainMenu.addClass("collapsed");
        $mainMenu.removeClass("active");

      }
    }else{
      if(isCollapsed){
        isCollapsed=false;

        console.log("menu expand");

        $mainMenu.removeClass("collapsed");
      }
    }
  }
  $(document).on("scroll", function (event) {
      var doc = document.documentElement;
      var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);
      if (top > 10) {
        $mainMenu.addClass("sticky-scrolled");
      } else {
        $mainMenu.removeClass("sticky-scrolled");
      }
  });

  $(window).on("resize", sizeUpdateFn);
  $mainMenu.on("click",function(){
    $mainMenu.toggleClass("active");
  });
  $mainMenu.on("drag",console.log);
  sizeUpdateFn();

});
