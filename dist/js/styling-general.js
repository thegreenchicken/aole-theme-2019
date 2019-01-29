/*
this script contains various styling features, such as the constrained proportion pictures, parallax effects, ellipsis of text, etc.
*/
var stylingGeneralJs = new (function () {

    /*!
     * jQuery.ellipsis
     * https://github.com/jjenzz/jquery.ellipsis
     * --------------------------------------------------------------------------
     * Copyright (c) 2013 J. Smith (@jjenzz)
     * Dual licensed under the MIT and GPL licenses:
     * https://www.opensource.org/licenses/mit-license.php
     * http://www.gnu.org/licenses/gpl.html
     *
     * adds a class to the last 'allowed' line of text so you can apply
     * text-overflow: ellipsis;
     */
    // (function (a) { if (typeof define === "function" && define.amd) { define(["jquery"], a) } else { a(jQuery) } }(function (d) { var c = "ellipsis", b = '<span style="white-space: nowrap;">', e = { lines: "auto", ellipClass: "ellip", responsive: false }; function a(h, q) { var m = this, w = 0, g = [], k, p, i, f, j, n, s; m.$cont = d(h); m.opts = d.extend({}, e, q); function o() { m.text = m.$cont.text(); m.opts.ellipLineClass = m.opts.ellipClass + "-line"; m.$el = d('<span class="' + m.opts.ellipClass + '" />'); m.$el.text(m.text); m.$cont.empty().append(m.$el); t() } function t() { if (typeof m.opts.lines === "number" && m.opts.lines < 2) { m.$el.addClass(m.opts.ellipLineClass); return } n = m.$cont.height(); if (m.opts.lines === "auto" && m.$el.prop("scrollHeight") <= n) { return } if (!k) { return } s = d.trim(m.text).split(/\s+/); m.$el.html(b + s.join("</span> " + b) + "</span>"); m.$el.find("span").each(k); if (p != null) { u(p) } } function u(x) { s[x] = '<span class="' + m.opts.ellipLineClass + '">' + s[x]; s.push("</span>"); m.$el.html(s.join(" ")) } if (m.opts.lines === "auto") { var r = function (y, A) { var x = d(A), z = x.position().top; j = j || x.height(); if (z === f) { g[w].push(x) } else { f = z; w += 1; g[w] = [x] } if (z + j > n) { p = y - g[w - 1].length; return false } }; k = r } if (typeof m.opts.lines === "number" && m.opts.lines > 1) { var l = function (y, A) { var x = d(A), z = x.position().top; if (z !== f) { f = z; w += 1 } if (w === m.opts.lines) { p = y; return false } }; k = l } if (m.opts.responsive) { var v = function () { g = []; w = 0; f = null; p = null; m.$el.html(m.text); clearTimeout(i); i = setTimeout(t, 100) }; d(window).on("resize." + c, v) } o() } d.fn[c] = function (f) { return this.each(function () { try { d(this).data(c, (new a(this, f))) } catch (g) { if (window.console) { console.error(c + ": " + g) } } }) } }));


    var squareElementsSelector = null;
    var $squareElements = false;

    var self = this;

    this.makeSquare = function (props) {
        var selectorString=props.selector;
        if (selectorString !== undefined) {
            squareElementsSelector = selectorString;
            $squareElements = $(squareElementsSelector);
            console.log("scripting the height of ", $squareElements);
        }
        return squareElementsSelector;
    }

    // this.makeSquare.add = function (props) {
    //     var selector=props.selector;
    //     squareElementsSelector += ", " + selector;
    //     $squareElements = $(squareElementsSelector);
    //     console.log("scripting the height of ", $squareElements);
    // }

    this.makeSquare.update = function () {
        $squareElements.each(function () {
            // console.log(this);
            // $(this).css("height", $(this).width());
            $(this).css("height", $(this).css("width"));
            // $(this).attr("
        });
    }
    var $fillElements=false;
    var fillSelector=false;
    this.fill=function(props){
      fillSelector=props.selector;
      self.fill.update();
    }


    this.fill.update=function(){
      if(!fillSelector)return;
      // console.log("fupdate");
      if(!$fillElements){
        $fillElements=$(fillSelector);
        $fillElements.each(function(){
          $(this).on("load",function(){
            var $this=$(this);
            $this.attr("ready","true");
            $this.css({width:"initial",height:"initial"});
            var imgW = parseInt($this.width());
            var imgH = parseInt($this.height());
            myRatio=(imgW/imgH);
            $this.attr("data-original-ratio",myRatio);
            $this.attr("data-original-width",imgW);
            $this.attr("data-original-height",imgH);

            self.fill.update();
          });
        });
        console.log("apply fill to ",$fillElements);
      }
      $fillElements.each(function(){
          var $this=$(this);
          var refH = $this.parent().height();
          var refW = $this.parent().width();

          var refRatio = refW/refH;
          if(!refRatio) return;

          var myRatio=parseFloat($this.attr("data-original-ratio"));

          if(myRatio){
            if ( myRatio < refRatio ) {
              $(this).removeClass("full-height");
              $(this).addClass("full-width");
              // $this.css({
              //   width:refH*myRatio+"px",
              //   height:refH+"px"
              // });
            } else {
              $(this).removeClass("full-width");
              $(this).addClass("full-height");
              // $this.css({
              //   width:refW*myRatio+"px",
              //   height:refW+"px"
              // });
            }
          }

      })
    }




    // this.ellipsis = function (props) {
    //     // $('.overflow').ellipsis();
    //     // $('.one-line').ellipsis({ lines: 1 });
    //     // $('.two-lines').ellipsis({ lines: 2 });
    //     // $('.box--responsive').ellipsis({ responsive: true });
    //     $(props.selector).ellipsis(props);
    // }

    this.update = function () {
        self.makeSquare.update();
        // self.ellipsis.update();
        self.fill.update();
    }

    return this;
});

stylingGeneralJs.makeSquare({
  selector:"body.page .item-post-thumbnail-container,"
              +".items-team_members-wrapper .image-container,"
              +".square,"
              +".items-pilots-wrapper .item-paragraph-container"
});
// stylingGeneralJs.ellipsis({selector:".post-title-container", responsive: true, lines:2 });

stylingGeneralJs.fill({selector:".items-team_members-wrapper .image-container img,"
                                      +".body.page .section-post-container .item-post-thumbnail-container img, body.page .section-post-container .item-calendar-container img,"
                                      +".fill"});

document.addEventListener("DOMContentLoaded", function (event) {
    //this bit ensures that the page doesn't change size while images are getting DOMContentLoaded/
    //this removes the classic annoyance of scrolling to the desired part,
    //and then having the scroll shift because the pictures are growing after loading ended...
    //I had trouble finishing it because I cannot get the image size that would result after loading while it is loading
    // $("img").each(function(){
    //   var pregetSize=false;
    //   var sizeAttr=$(this).attr("src");
    //
    //   if(sizeAttr){
    //     var wpSizeIndicators = sizeAttr.match(/(\d{1,4})x(\d{1,4})\.\w{1,4}$/);
    //     if(wpSizeIndicators){
    //       pregetSize={
    //         w:parseInt(wpSizeIndicators[1]),
    //         h:parseInt(wpSizeIndicators[2]),
    //         ratio:sizeRatio,
    //       }
    //     }
    //   }
    //   if(pregetSize){
    //     console.log("add placeholder",pregetSize);
    //     var placeholder=$(
    //       '<div class="loading-picture-placeholder">'
    //       +'</div>'
    //     );
    //     placeholder.css({
    //       position:'relative',
    //       width:pregetSize.w,
    //       height:pregetSize.h,
    //     });
    //     $(this).before(placeholder);
    //   }
    //   console.log(pregetSize);
    // });

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

    console.log("styling.js");

    //keep some of the elements in the proportion of a square
    var updateFn = throttle(stylingGeneralJs.update, 100);

    $(window).on("resize", updateFn);
    updateFn();

    //make parallax effects on some elements
    function ParallaxItem($itm, zlevel) {

        /*
            zlevel:
            negative: slower than scroll
            positive: faster than scroll

        */
        if ($itm.attr("data-parallax-applied")) {
            return false;
        }
        ParallaxItem.list.push(this);

        var anchory = 0;
        anchory = parseInt($itm.css("top"));

        // $itm.attr("css", "fixed");
        $itm.attr("data-parallax", zlevel);
        $itm.attr("data-parallax-applied", zlevel);


        console.log("apply parallax to ", $itm);


        // $itm.css("border", "solid 3px red");

        this.scroll = function (event) {
            if (zlevel == 0) return;

            $itm.css("top", anchory - (event.top * zlevel) + "px");
            // console.log(event);
        }
    }
    ParallaxItem.list = [];

    //deconoise items come to appear later, hence the wait.
    var pinterval = setInterval(function () {
        //these take longer to appear...
        $(".parallax").each(function () {
            var zlevel = -0.1;
            var $zindex = parseFloat($(this).attr("parallax-z"));
            //if z-index is user-specified at 0, don't apply effect
            if($zindex !== 0){
              //if is not undefined, use that value
              if ($zindex ) {
                  // console.log($zindex );
                  zlevel = $zindex;
              }
              new ParallaxItem($(this), zlevel);
            }
            clearInterval(pinterval);
        });
    }, 200);

    $(document).on("scroll", function (event) {
        var doc = document.documentElement;
        var left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0);
        var top = (window.pageYOffset || doc.scrollTop) - (doc.clientTop || 0);
        for (var n in ParallaxItem.list) {
            var pitem = ParallaxItem.list[n];
            pitem.scroll({ top: top, left: left });
        }
    });
});
