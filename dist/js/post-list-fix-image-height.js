document.addEventListener("DOMContentLoaded", function (event) {
  function IsImageOk(img) {
    //source: https://i.canthack.it/detecting-broken-images-js.html
      if (!img.complete) {
          return false;
      }
      if (typeof img.naturalWidth != "undefined" && img.naturalWidth == 0) {
          return false;
      }
      return true;
  }

  console.log("fixing the height of $(.items-wrapper .item-container) elements to prevent white gaps");
  var respond=function(){
    if($(document).width()<994){
      $(".items-wrapper .item-container").each(function(){
        var $imgel=$(this).find('img');
        $imgel.css({height:""});
      });
    }else{
      $(".items-wrapper .item-container").each(function(){
        //two possible cases:
        //the picture was already loaded to this point, or not.
        //if loaded, we want it to apply the effect right away ("loaded" listener
        //won't be triggered again. If not, we want to set a trigger for when
        //it loads.
        //there is no native way to know whether the picture has loaded or not, thus IsImageOk()
        var $imgel=$(this).find('img');
        var $this=$(this);
        if(IsImageOk($imgel[0])){
          if($(this).css("height")>$imgel.css("height")){
            $imgel.css({height:""});
            //twice because text re-wraps, wich may make the container bigger
            $imgel.css({height:$(this).css("height")});
            $imgel.css({height:$(this).css("height")});
          }
        }else{
          $(this).on("load",function(){
            $this.attr("ready","true");
            updateFillElement($(this));
            self.fill.update();
          });
        }


      });
    }
  }

  $(window).on("resize", respond);
  //
  // $(document).ready(function(){
  //   console.log("rerespond");
  //   //sometimes the respond doesn't work, as if it was too early to do it.
  //   //This is a hack to get it working regardless
  //   setTimeout(respond,300);
  // });
  respond();
});
