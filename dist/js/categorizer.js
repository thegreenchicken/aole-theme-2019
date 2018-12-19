'use strict'
var categorizer={};
document.addEventListener("DOMContentLoaded", function (event) {
    console.log("categorizer.js");

    var ClassifiedContainer=function($item){
      var items=this.classifiedItems=[];
      var $selectionMenu=$('<div class="classifier-menu"></div>');
      var $catSelectionMenu=$('<div class="category-menu"></div>');
      var $tagSelectionMenu=$('<div class="tag-menu"><p></p></div>');

      var self=this;
      var attributes=this.attributes={};
      var tagButton$=[];
      var categoryButton$=[];
      this.updateDom=function(){
        for(var category in attributes){
          var $categoryButton= $(`<a href="#${category}" class="tag" data-category="${category}">${category} </a>`);
          categoryButton$.push($categoryButton);
          $catSelectionMenu.append($categoryButton);
          $categoryButton.on("click",function(){
            var category=$(this).attr('data-category');
            // console.log("categoryfilter",category,tag);

            for(var tb of tagButton$){
              var tbcat=tb.attr("data-category");
              if(category==tbcat){
                tb.removeClass("disappear");
                tb.addClass("undisappear");
              }else{
                tb.addClass("disappear");
                tb.removeClass("undisappear");
              }
            }

            for(var cb of categoryButton$){
              cb.removeClass("active");
            }
            $(this).addClass("active");
          });



          console.log("C",attributes[category]);
          for(var tag of attributes[category]){
            console.log("t");
            var count = (self.monofilter(category,tag)).length;

            var $tagButton= $(`<a href="#${category}/${tag}" class="tag" data-category="${category}" data-item="${tag}">${tag} <span class="count">${count}<span></a>`);
            $tagSelectionMenu.append($tagButton);
            tagButton$.push($tagButton);

            $tagButton.on("click",function(){
              var category=$(this).attr('data-category');
              var tag=$(this).attr('data-item');
              console.log("tagfilter",category,tag);
              self.monofilter(category,tag,function(res){
                console.log("cb",res);
                this.setAppearState(res.match);
              });
              for(var tb of tagButton$){
                tb.removeClass("active");
              }
              $(this).addClass("active");
            });
          }
        }
        $item.prepend($selectionMenu);
        $selectionMenu.append($catSelectionMenu);
        $selectionMenu.append($tagSelectionMenu);
        // console.log("appenced");'s
      }
      /*example: filter([[hairdos,"waves"],[random:"tag a"]]) */
      var sf=function(catValuePairs,cb,bool){
        var ln=0;
        var ret=[];
        for(var pair of catValuePairs){
          var category=pair[0];
          var tag=pair[1];
          for(var item of items){
            //depending on state of "bool" this becomes either an additive or a intersective filter function
            if(ln==0 || bool==item.isAppeared ){
              if( item.matches(category,tag) ){
                ret.push(item);
                if(cb) cb.call(item,{item:item,match:[category,tag]});
              }else{
                if(cb) cb.call(item,{item:item,match:false});
              }
            }

          }
          ln++;
        }
        return ret;
      }
      this.andFilter=function(catValuePairs,cb){
        return sf(catValuePairs,cb,true);
      }
      // not used for now, and untested, but just to illustrate the function.
      //if there are way too many items in the future, this could be used to
      //find possts based in more than one criteria.
      this.orFilter=function(catValuePairs,cb){
        return sf(catValuePairs,cb,false);
      }

      this.monofilter=function(tagCategory,catValue,cb){
        return self.andFilter([[tagCategory,catValue]],cb);
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
          var $attrList=$(this);
          var name=$attrList.attr("name");
          // console.log(name);

          var thisList = self.attributes[name] = [];
          $attrList.find('li').each(function(){
            var $li=$(this);
            var txt=$li.text();
            if(txt) thisList.push( txt.toLowerCase() );
          });
          console.log(thisList);

        });
        this.appear=function(){
            // $item.fadeIn();
            self.isAppeared=true;
            // $item.css("display","");
            $item.removeClass("disappear");
            $item.addClass("undisappear");

        }
        this.disappear=function(){
            // $item.fadeOut();
            self.isAppeared=false;
            // $item.css("display","none");
            $item.addClass("disappear");
            $item.removeClass("undisappear");

        }
        this.matches=function(categoryHas,val){
          if(self.attributes[categoryHas]){
            if(self.attributes[categoryHas].indexOf(val)!==-1)
              return (true);
            else
              return (false);
          }else{
            //didn't even have the category
            return (false);
          }
        }
        this.setAppearState=function(state){
          if(state)self.appear();
          else self.disappear();
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
