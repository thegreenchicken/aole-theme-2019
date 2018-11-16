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
        $("body.page .item-post-thumbnail-container").each(function () {
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
        var anchory=0;
        ParallaxItem.list.push(this);
        anchory=parseInt( $itm.css("top") );

        $itm.attr("data-parallax",zlevel);
        console.log("apply parallax to ", $itm);


        // $itm.css("border", "solid 3px red");

        this.scroll=function(event){
            if (zlevel == 0) return;
            $itm.css("top", anchory - (event.top / zlevel)+"px");
            // console.log(event);
        }
    }
    ParallaxItem.list=[];

    $(".item-calendar-container,body.page .item-post-thumbnail-container").each(function () {
        new ParallaxItem($(this), 10);
    });

    var pinterval=setInterval(function(){
        //these take longer to appear...
        $(".section-post-header-container .deco-noise").each(function () {
            new ParallaxItem($(this), Math.random(5)-6);
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