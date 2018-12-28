
'use strict'


console.log("d3anim script");
document.addEventListener("DOMContentLoaded", function(event) {
    var placecurve = [];
    var keys;
    var len;
    var playing;
    var assetUrl = "/assets/d3Animation";
    var width = window.innerWidth - 10,
        height = window.innerHeight - 30;

    var logooutersizeglobal = 5,
        outerring = (height / 100) * 70;
    var innerring = (outerring / 100) * 5;
    var strokecolor = 'rgb(0, 94, 184)';


    var placelistShort = ["ARTS", "BIZ", "CHEM", "ELEC", "ENG", "SCI", "Others"]
    //    var placecurve = [];

    var angle;
    //    var keys;
    //    var len;



    var svg = d3.select('#d3anim')
        .append("svg")
        .attr('width', width)
        .attr('height', height);


    var addr = vars.templateUrl + assetUrl + "/data-for-animation.csv";
    d3.csv(addr, function(error, dataset) {
        if (error) console.log(error);
        try {

          console.log('loaded file');

          var data = dataset;

          angle = 2 * Math.PI / data.length;
          var points_place = [];

          var place_len = data.length;
          keys = d3.keys(data["0"]).slice(1);
          len = keys.length;
          createGraph(data);

        } catch (e) {
            console.log(e);
        }


    })



    function createGraph(data) {
        d3.selectAll("path").remove();
        d3.selectAll("text").remove();
        d3.selectAll("image").remove();

        for (var t = 0; t < keys.length; t++) {

            var points_place = [];

            var BGScale = d3.scaleLinear()
                .domain([0, d3.max(data, function(d, i) {
                    var length = keys.length - 1;
                    return data[i.toString()][keys[length]];
                })])
                .range([0, outerring / 2]);
            var angle_place = 2 * Math.PI / data.length;

            for (var i = 0; i < data.length; i++) {
                points_place.push([]);
                var sx = width / 2 + Math.cos(angle * i) * (parseInt(BGScale(data[i.toString()][keys[t]])) + (innerring) * logooutersizeglobal / 5);
                var sy = height / 2 + Math.sin(angle * i) * (parseInt(BGScale(data[i.toString()][keys[t]])) + (innerring) * logooutersizeglobal / 5);
                points_place[i].push(sx);
                points_place[i].push(sy);
            }


            svg.selectAll("text")
                .data(placelistShort)
                .enter()
                .append("text")
                .text(function(d) {
                    return d;
                })
                .attr("x", function(d, i) {
                    return width / 2 + Math.cos(angle * i) * (outerring / 2 + (innerring) * logooutersizeglobal / 5);
                })
                .attr("y", function(d, i) {
                    return height / 2 + Math.sin(angle * i) * (outerring / 2 + (innerring) * logooutersizeglobal / 5);
                })
                .attr('class', 'school')
                .attr("font-family", "Poppins")
                .attr("font-size", '1vw')
                .attr("fill", "white")
                .attr("text-anchor", "middle");

            svg.append("text")
                .attr("class", "date")
                .attr("font-family", "Poppins")
                .attr("font-size", '1vw')
                .attr('font-weight', '700')
                .attr("fill", "#ffffff")
                .attr("x", width / 2)
                .attr("y", height / 2 + 10)
                .attr("text-anchor", "middle");


            var path1 = svg.append('path')
                .attr("class", "place_curve" + t)
                .data([points_place])
                .attr('d', d3.line().curve(d3.curveCardinalClosed))
                .attr('stroke-width', 2)
                .attr('fill', "none")
                .attr('stroke', strokecolor);



            placecurve.push(d3.select(".place_curve" + t).attr('d'));

            d3.select(".place_curve" + t).remove();
        }


        svg.append('path')
            .attr("class", "animate")
            .attr('d', placecurve[0])
            .attr('stroke-width', 2)
            .attr('fill', "none")
            .attr('stroke', strokecolor);

        for (var f = 0; f < placecurve.length; f++) {
            svg.append('path')
                .attr("id", "curve" + f)
                .attr('d', placecurve[f])
                .attr('stroke-width', 2)
                .attr('fill', "none")
                .attr('stroke', strokecolor)
                .attr("opacity", 0);
        }

        play(0);
    }



    function play(indx) {
        d3.select(".animate")
            .transition()
            .delay(1000)
            .duration(300)
            .attr('d', placecurve[(indx) % len])
            .on("start", function() {
                var ind = (indx) % len;
                d3.select(".date").text(keys[indx]);

                if (ind == 0) {
                    ind = 0;
                } else {
                    ind--;
                }
                d3.select("#curve" + ind)
                    .attr("opacity", 1)
                    .transition()
                    .duration(300)
                    .attr("opacity", 0.2)
            })
            .on('end', function() {
                var k = indx + 1;
                if (k < len)
                    play(k);
            });
    };
});
