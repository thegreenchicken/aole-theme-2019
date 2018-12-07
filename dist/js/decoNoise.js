function hideThis(domel){
    console.log(domel);
    domel.style.display = 'none';
    console.log('hiding an image because its link was broken', domel);

}
document.addEventListener("DOMContentLoaded", function (event) {
    console.log("decoNoise.js");
    var imgels = [];
    var imgstr = '<img class="deco-noise">';

    var piclist = vars.decoNoise.pictures;

    if(!piclist[0]){
      piclist=[
          vars.templateUrl+"/res-noise-pics/path1.png",
          vars.templateUrl+"/res-noise-pics/path2.png",
          vars.templateUrl+"/res-noise-pics/path3.png",
          vars.templateUrl+"/res-noise-pics/path4.png",
          vars.templateUrl+"/res-noise-pics/path5.png",
          vars.templateUrl+"/res-noise-pics/path6.png",
      ]
    }
    var userDefinedZIndex=vars.decoNoise.zindex;
    var NoiseEl = function ($appendto) {
        imgels.push(this);
        var nimg = $(imgstr)
        var pos = {
            x: (Math.random() * 100),
            y: (Math.random() * 100)
        }
        var speed = {
            x: Math.random() - 0.5,
            y: Math.random() - 0.5
        }
        nimg.addClass("parallax");
        nimg.attr("parallax-z",((0.1 + Math.random()/2 ) * userDefinedZIndex) );
        nimg.attr("src", piclist[Math.floor(Math.random() * piclist.length)]);
        nimg.attr("onerror", "hideThis(this)" );

        nimg.css({
            // width: "100px",
            // height: "100px",
            // border: "solid 1px red",
            position: "absolute",
            display: "block",
            width: (Math.random() * 50 + 50) + "px"
        });
        $appendto.prepend(nimg);
        this.frame = function () {
            pos.x += speed.x;
            pos.y += speed.y;
            nimg.css("left", pos.x + "%");
            nimg.css("top", pos.y + "%");
            nimg.css("mix-blend-mode","overlay");
        }

        this.frame();
        return this;
    }
    $(".section-post-header-container, .deco-noise").each(function () {
        console.log(this);

        $(this).css({
            position: "relative",
            overflow: "hidden"
        });
        // $(this).children().css({
        //     position: "relative"
        // });

        for (var a = 0; a < 4; a++) {
            new NoiseEl($(this));
        }
    });
    var lastFrame = 0;
    function animate(frameTime) {
        var deltaTime = frameTime - lastFrame;
        lastFrame = frameTime;
        for (nel of imgels) {
            nel.frame(deltaTime);
        }
        // console.log("f",deltaTime);
        window.requestAnimationFrame(animate);
    }
});
