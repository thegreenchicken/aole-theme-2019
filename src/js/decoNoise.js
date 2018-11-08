(function(){
    var imgels = [];
    var imgstr = "<img>";
    var piclist=[
        "../dist/res-noise-pics/path1.png",
        "../dist/res-noise-pics/path2.png",
        "../dist/res-noise-pics/path3.png",
        "../dist/res-noise-pics/path4.png",
        "../dist/res-noise-pics/path5.png",
        "../dist/res-noise-pics/path6.png",
    ];
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
        nimg.attr( "src", piclist[Math.floor(Math.random()*piclist.length)] );
        nimg.css({
            // width: "100px",
            // height: "100px",
            // border: "solid 1px red",
            position: "absolute",
            display: "block",
            width:(Math.random()*70+70)+"px"
        });
        $appendto.prepend(nimg);
        this.frame = function () {
            pos.x += speed.x;
            pos.y += speed.y;
            nimg.css("left", pos.x + "%");
            nimg.css("top", pos.y + "%");
        }

        this.frame();
        return this;
    }
    $(".section-post-header-container").each(function () {
        console.log(this);

        $(this).css({ position: "relative" });

        for (var a = 0; a < 3; a++) {
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
})();