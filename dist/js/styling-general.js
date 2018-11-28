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
    (function (a) { if (typeof define === "function" && define.amd) { define(["jquery"], a) } else { a(jQuery) } }(function (d) { var c = "ellipsis", b = '<span style="white-space: nowrap;">', e = { lines: "auto", ellipClass: "ellip", responsive: false }; function a(h, q) { var m = this, w = 0, g = [], k, p, i, f, j, n, s; m.$cont = d(h); m.opts = d.extend({}, e, q); function o() { m.text = m.$cont.text(); m.opts.ellipLineClass = m.opts.ellipClass + "-line"; m.$el = d('<span class="' + m.opts.ellipClass + '" />'); m.$el.text(m.text); m.$cont.empty().append(m.$el); t() } function t() { if (typeof m.opts.lines === "number" && m.opts.lines < 2) { m.$el.addClass(m.opts.ellipLineClass); return } n = m.$cont.height(); if (m.opts.lines === "auto" && m.$el.prop("scrollHeight") <= n) { return } if (!k) { return } s = d.trim(m.text).split(/\s+/); m.$el.html(b + s.join("</span> " + b) + "</span>"); m.$el.find("span").each(k); if (p != null) { u(p) } } function u(x) { s[x] = '<span class="' + m.opts.ellipLineClass + '">' + s[x]; s.push("</span>"); m.$el.html(s.join(" ")) } if (m.opts.lines === "auto") { var r = function (y, A) { var x = d(A), z = x.position().top; j = j || x.height(); if (z === f) { g[w].push(x) } else { f = z; w += 1; g[w] = [x] } if (z + j > n) { p = y - g[w - 1].length; return false } }; k = r } if (typeof m.opts.lines === "number" && m.opts.lines > 1) { var l = function (y, A) { var x = d(A), z = x.position().top; if (z !== f) { f = z; w += 1 } if (w === m.opts.lines) { p = y; return false } }; k = l } if (m.opts.responsive) { var v = function () { g = []; w = 0; f = null; p = null; m.$el.html(m.text); clearTimeout(i); i = setTimeout(t, 100) }; d(window).on("resize." + c, v) } o() } d.fn[c] = function (f) { return this.each(function () { try { d(this).data(c, (new a(this, f))) } catch (g) { if (window.console) { console.error(c + ": " + g) } } }) } }));


    var squareElementsSelector = null;
    var $squareElements = false;

    var self = this;

    this.makeSquare = function (selectorString) {
        if (selectorString !== undefined) {
            squareElementsSelector = selectorString;
            $squareElements = $(squareElementsSelector);
            console.log("scripting the height of ", $squareElements);
        }
        return squareElementsSelector;
    }

    this.makeSquare.add = function (selector) {
        squareElementsSelector += ", " + selector;
        $squareElements = $(squareElementsSelector);
        console.log("scripting the height of ", $squareElements);
    }

    this.makeSquare.update = function () {
        $squareElements.each(function () {
            // console.log(this);
            $(this).css("height", $(this).width());
            // $(this).attr("
        });
    }


 
    
    this.ellipsis = function (props) {
        // $('.overflow').ellipsis();
        // $('.one-line').ellipsis({ lines: 1 });
        // $('.two-lines').ellipsis({ lines: 2 });
        // $('.box--responsive').ellipsis({ responsive: true });
        $(props.selector).ellipsis(props);
    }
    

    this.update = function () {
        self.makeSquare.update();
        // self.ellipsis.update();
    }

    return this;
});

stylingGeneralJs.makeSquare("body.page .item-post-thumbnail-container, .square");
stylingGeneralJs.ellipsis({selector:".post-title-container", responsive: true, lines:2 });

document.addEventListener("DOMContentLoaded", function (event) {

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
        $(".item-calendar-container,body.page .item-post-thumbnail-container, .parallax").each(function () {
            var zlevel = -0.1;
            var $zindex = parseFloat($(this).attr("parallax-z"));
            if ($zindex) {
                // console.log($zindex );
                zlevel = $zindex;
            }
            new ParallaxItem($(this), zlevel);
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
