/*
this script causes the main menu to switch between mobile and desktop versions. The disctinction however, is done by screen width.
*/
document.addEventListener("DOMContentLoaded", function (event) {
  var mouse={}
  var $mainMenu=$(".main-menu-container");
  var isCollapsed=false;
  function updateFn(){
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
  $(window).on("resize", updateFn);
  $mainMenu.on("click",function(){
    $mainMenu.toggleClass("active");
  });
  $mainMenu.on("drag",console.log);
  updateFn();

});
