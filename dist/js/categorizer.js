/*
later move these functions into annonymity, to prevent scope contamination
*/
function selectTag(tagCategory,tagValue){

}
document.addEventListener("DOMContentLoaded", function (event) {
    console.log("categorizer.js");

    selectTag=function(tagCategory,tagValue){
        ClassifiedItem.each(function(classifiedItem){
          this.appearIf(tagCategory,tagValue);
        });
    }
    var ClassifiedContainer=function($item){
      var items=this.classifiedItems=[];
      var $selectionMenu=$('<div class="classifier-menu"></div>');
      var self=this;
      var attributes=this.attributes={};
      var tagButtons=[];
      this.updateDom=function(){
        for(var category in attributes){
          console.log("C",attributes[category]);
          for(var tag of attributes[category]){
            console.log("t");
            var btn= $(`<div class="tag" data-category="${category}" data-item="${tag}">${tag}</div>`);
            $selectionMenu.append(btn);
            tagButtons.push(btn);

            btn.on("click",function(){
              var category=$(this).attr('data-category');
              var tag=$(this).attr('data-item');
              console.log("monofilter",category,tag);
              self.monofilter(category,tag);
              for(var tb of tagButtons){
                tb.removeClass("active");
              }
              $(this).addClass("active");
            });
          }
        }
        $item.prepend($selectionMenu);
      }
      /*example: filter([[hairdos,"waves"],[random:"tag a"]]) */
      this.andFilter=function(catValuePairs){
        var ln=0;
        for(var pair of catValuePairs){
          var category=pair[0];
          var tag=pair[1];
          for(var item of items){
            //if first iteration, appeared state of items is ignored
            //otherwise, non-matching items are ignored, because
            // we are calculating an intersection of the filter criteria
            console.log("Category",category,"tag",tag,item.isAppeared);
            if(ln==0 || item.isAppeared )
              item.appearIf(category,tag);
          }
          ln++;
        }
      }
      // not used for now, and untested, but just to illustrate the function.
      //if there are way too many items in the future, this could be used to
      //find possts based in more than one criteria.
      this.orFilter=function(catValuePairs){
        var ln=0;
        for(var tagCategory in catValuePairs){
          for(var itmno in items){
            //if first iteration, appeared state of items is ignored
            //otherwise, already matching items are ignored, because
            // we are calculating an additive of the filter criteria
            if(ln==0 || !items[itmno].isAppeared )
              items[itmno].appearIf(tagCategory,catValuePairs[tagCategory]);
          }
          ln++;
        }
      }
      this.monofilter=function(tagCategory,catValue){
        self.andFilter([[tagCategory,catValue]]);
      }

      $item.find(".classifiable-item").each(function(){
        var nci=new ClassifiedItem($(this));
        items.push( nci );
        for(var cat in nci.attributes){
          if(!self.attributes[cat]) self.attributes[cat]=[];
          var taglist=nci.attributes[cat];
          for(var tag of taglist){
            if(self.attributes[cat].indexOf(tag)==-1) self.attributes[cat].push(tag);
          }
        }
      });
      this.updateDom();

    }
    var ClassifiedItem = function ($item) {
        // console.log("classified item",$item);
        if (!ClassifiedItem.list) ClassifiedItem.list = [];
        ClassifiedItem.list.push(this);
        var self = this;
        this.isAppeared=true;
        this.attributes = {};
        $item.find(".classifiable-attributes").each(function () {
          $attrList=$(this);
          var name=$attrList.attr("name");
          // console.log(name);

          var thisList = self.attributes[name] = [];
          $attrList.find('li').each(function(){
            $li=$(this);
            var txt=$li.text();
            if(txt) thisList.push( txt.toLowerCase() );
          });
          console.log(thisList);

        });
        this.appear=function(){
            // $item.fadeIn();
            self.isAppeared=true;
            $item.css("display","");
        }
        this.disappear=function(){
            // $item.fadeOut();
            self.isAppeared=false;
            $item.css("display","none");
        }
        this.appearIf=function(categoryHas,val){
          if(self.attributes[categoryHas]){
            if(self.attributes[categoryHas].indexOf(val)!==-1)
                self.appear();
            else
                self.disappear();
          }else{
            //didn't even have the category
            self.disappear();
          }
        }
    }
    ClassifiedItem.list = [];
    ClassifiedItem.each=function(cb){
        for(var itmno in ClassifiedItem.list){
          cb.call(ClassifiedItem.list[itmno],ClassifiedItem.list[itmno],itmno);
        }
    }

    $(".classifiable-container").each(function () {
        new ClassifiedContainer($(this));
    });


});
