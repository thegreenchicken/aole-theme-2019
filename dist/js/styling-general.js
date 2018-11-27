function throttle(func, wait, options) {
    var context, args, result;
    var timeout = null;
    var previous = 0;
    if (!options) options = {};
    var later = function () {
        previous = options.leading === false ? 0 : Date.now();
        timeout = null;
        result = func.apply(context, args);
        if (!timeout) context = args = null;
    };
    return function () {
        var now = Date.now();
        if (!previous && options.leading === false) previous = now;
        var remaining = wait - (now - previous);
        context = this;
        args = arguments;
        if (remaining <= 0 || remaining > wait) {
            if (timeout) {
                clearTimeout(timeout);
                timeout = null;
            }
            previous = now;
            result = func.apply(context, args);
            if (!timeout) context = args = null;
        } else if (!timeout && options.trailing !== false) {
            timeout = setTimeout(later, remaining);
        }
        return result;
    };
}

document.addEventListener("DOMContentLoaded", function (event) {

    console.log("styling.js");

    //keep some of the elements in the proportion of a square
    var makeSquare=throttle(function() {
        $("body.page .item-post-thumbnail-container, .square").each(function () {
            // console.log(this);
            $(this).css("height", $(this).width());
            console.log("changing the height of ",$(this));
        });
    },200);
    makeSquare();
    $(window).on("resize", makeSquare);

    //make parallax effects on some elements
    function ParallaxItem($itm,zlevel){
        
        /*
            zlevel:
            negative: slower than scroll
            positive: faster than scroll

        */
        if($itm.attr("data-parallax-applied")){
            return false;
        }
        ParallaxItem.list.push(this);
        
        var anchory=0;
        anchory=parseInt( $itm.css("top") );

        // $itm.attr("css", "fixed");
        $itm.attr("data-parallax", zlevel);
        $itm.attr("data-parallax-applied",zlevel);
        

        console.log("apply parallax to ", $itm);


        // $itm.css("border", "solid 3px red");

        this.scroll=function(event){
            if (zlevel == 0) return;
            
            $itm.css("top", anchory - ( event.top * zlevel )+"px");
            // console.log(event);
        }
    }
    ParallaxItem.list=[];

    //deconoise items come to appear later, hence the wait.
    var pinterval=setInterval(function(){
        //these take longer to appear...
        $(".item-calendar-container,body.page .item-post-thumbnail-container, .parallax").each(function () {
            var zlevel = -0.1;
            var $zindex = parseFloat($(this).attr("parallax-z"));
            if ($zindex){
                // console.log($zindex );
                zlevel = $zindex;
            }
            new ParallaxItem($(this),zlevel);
            clearInterval(pinterval);
        });
    },200);

    $(document).on("scroll",function(event){
        var doc = document.documentElement;
        var left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0);
        var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);
        for(var n in ParallaxItem.list){
            var pitem=ParallaxItem.list[n];
            pitem.scroll({top:top,left:left});
        }
    });
});