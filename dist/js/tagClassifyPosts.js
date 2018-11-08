/*
later move these functions into annonymity, to prevent scope contamination
*/
function selectTag(superTagValue,tagValue){

}
document.addEventListener("DOMContentLoaded", function (event) {
    console.log("tagClassifyPosts.js");

    selectTag=function(superTagValue,tagValue){
        ClassifiedItem.each(function(classifiedItem){
            // console.log(classifiedItem);
            var ithas=false;
            if(classifiedItem.attributes[superTagValue]){
                if (classifiedItem.attributes[superTagValue].indexOf(tagValue)!==-1){
                    ithas=true;
                }/*else{
                    console.log("tag false", classifiedItem.attributes[superTagValue].indexOf(tagValue));
                }*/
            }/*else{
                console.log("supertag false");
            }*/
            console.log(ithas);
            classifiedItem.appearIf(ithas);
        });
    }
    var ClassifyButton = function (superTagValue,tagValue){
        var $item = $('<div class="button button-tag-selector">');
        this.$item=$item;
        $item.on("click",function(){
            selectTag(superTagValue,tagValue);
        });
    }
    var ClassifiedItem = function ($item) {
        // console.log("classified item",$item);
        if (!ClassifiedItem.list) ClassifiedItem.list = [];
        ClassifiedItem.list.push(this);
        var self = this;
        this.attributes = {};
        $item.find(".classifiable-attributes").each(function () {
            self.attributes = JSON.parse($(this).text());
            console.log(self.attributes);
        });
        this.appear=function(){
            // $item.fadeIn();
            $item.css("display","block");
        }
        this.disappear=function(){
            // $item.fadeOut();
            $item.css("display","none");
        }
        this.appearIf=function(val){
            if(val) 
                self.appear();
            else
                self.disappear();
        }
    }
    ClassifiedItem.list = [];
    ClassifiedItem.each=function(cb){
        for(var itmno in ClassifiedItem.list){
            cb(ClassifiedItem.list[itmno],itmno);
        }
    }

    $(".classifiable-container").each(function () {
        $(this).find(".classifiable-item").each(function(){
            new ClassifiedItem($(this));
        });
    });


});