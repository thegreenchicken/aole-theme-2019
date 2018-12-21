'use strict'

if(!window.categorizer){
  window.categorizer={};
}

document.addEventListener("DOMContentLoaded", function (event) {
    //get the after-hash data to apply the filter accordingly.
    var urlRequestedSelection=decodeURIComponent( window.location.hash ).replace(/^\#/,"").split("/");
    if(!urlRequestedSelection[0]) urlRequestedSelection=false;

    var itemSelector=".item-container";
    var wrapperSelector='.items-wrapper';
    var useMasonry=$().masonry!=undefined;
    // var masonry=
    var updateMasonry=function(){}
    if(useMasonry) updateMasonry=function(){
      $(wrapperSelector).masonry({
        itemSelector: itemSelector+", .classifier-menu",
        columnWidth: itemSelector+":not(.disappear)",
        // percentPosition: true
      })
    }



    console.log("categorizer.js");
    var CategoryButton=function(myClassifier,category){
      var $el= $(`<a href="#${category}" class="tag" data-category="${category}">${category} </a>`);
      CategoryButton.list.push($el);
      this.appendTo=function($to){
        return $to.append($el);
      }
      this.removeClass=function(string){
        return $el.removeClass(string);
      }
      this.attr=function(str){
        return $el.attr(str);
      }
      myClassifier.onAfterFilterAndDisplay(function(filterEvent){
        if(filterEvent.category==category){
          $el.addClass("active");
        }else{
          $el.removeClass("active");
        }
      });
      $el.on("click",function(){
        var activeState=$el.hasClass("active");
        var tag=false;
        //opposite of activestate because it only becomes active if it is active and vice-versa.
        myClassifier.filterAndDisplay((!activeState)?category:false,tag);
      });
      return this;
    }
    CategoryButton.list=[];

    var TagButton=function(myClassifier,category,tag){
      var count = (myClassifier.monofilter(category,tag)).length;
      var $el= $(`<a href="#${category}/${tag}" class="tag" data-category="${category}" data-item="${tag}">${tag} <span class="count">${count}<span></a>`);
      TagButton.list.push($el);
      this.appendTo=function($to){
        return $to.append($el);
      }
      this.removeClass=function(string){
        return $el.removeClass(string);
      }
      this.attr=function(str){
        return $el.attr(str);
      }
      myClassifier.onAfterFilterAndDisplay(function(filterEvent){


        if(filterEvent.category==category && filterEvent.tag==tag){
          $el.addClass("active");
        }else{
          $el.removeClass("active");
        }
        if(filterEvent.category==category){
          $el.addClass("undisappear");
          $el.removeClass("disappear");
        }else{
          $el.addClass("disappear");
          $el.removeClass("undisappear");

        }
      });

      $el.on("click",function(){
        var activeState=$el.hasClass("active");
        //opposite of activestate because it only becomes active if it is active and vice-versa.
        myClassifier.filterAndDisplay((!activeState)?category:false,tag);

      });

      return this;
    }
    TagButton.list=[];

    var ClassifiedContainer=function($item){

      var items=this.classifiedItems=[];
      var $selectionMenu=$('<div class="classifier-menu"></div>');
      var $catSelectionMenu=$('<div class="category-menu"></div>');
      var $tagSelectionMenu=$('<div class="tag-menu"><p></p></div>');

      var self=this;
      var attributes=this.attributes={};

      var categoryButtons=[];


      var categorizerAppended=false;

      var _afterFilterAndDisplayCallback=[];
      this.onAfterFilterAndDisplay=function(cb){
        if(typeof cb == 'function'){
          _afterFilterAndDisplayCallback.push(cb);
        }
      }
      this.filterAndDisplay=function(category,tag){

        //------------------------------------------------------
        // self.monofilter(category,tag,function(res){
        //   //"this" is the classifiableItem
        //   this.setAppearState(res.match);
        // });
        //------------------------------------------------------



        //each tag has a category, if the user presses one of these categories,
        //the items get sorted according to their tag on that selected category.
        //sort items by their tags in this category of $tagSelectionMenu
        var sortedByTagsOfCategory={};
        var appendLast=[];

        self.monofilter(category,tag,function(res){
          //// NOTE: "this" is a classifiableItem (=res.item)
          // console.log("category",category,res);
          var itags=res.item.attributes[category];
          if(res.match){
            if(itags?itags[0]:false){
              //make the item appear under other title than the selected tag, if possible
              //in this way, its belonging to other tags is expressed
              var stag=itags[0];
              if(stag===tag){
                if(itags[1]){
                  stag=itags[1];
                }
              }
              //add it to the array for later sort of the item DOM element
              if(!sortedByTagsOfCategory[stag]) sortedByTagsOfCategory[stag]=[];
              sortedByTagsOfCategory[stag].push(this);
            }else{
              //add it under the "others" title
              appendLast.push(this);
            }
          }

          this.setAppearState(res.match);

          this.detach();
        });

        sortedByTagsOfCategory["others"]=appendLast;

        $(".classifiable-container .item-categorizer-tag-title").remove();
        for(var dispTag in sortedByTagsOfCategory){
          console.log(dispTag,":",sortedByTagsOfCategory[dispTag]);
          if(sortedByTagsOfCategory[dispTag].length)
            $(".classifiable-container").append('<h3 class="item-categorizer-tag-title">'+dispTag+'</h3>');
          for(var item of sortedByTagsOfCategory[dispTag]){
            item.reattach();
          }
        }

        for(var cb of CategoryButton.list){
          cb.removeClass("active");
        }





        self.updateDom();

        for(cb of _afterFilterAndDisplayCallback){
          cb({category:category,tag:tag});
        }
      }
      this.updateDom=function(){
        if(! categorizerAppended){

          for(var category in attributes){
            new CategoryButton(self,category).appendTo($catSelectionMenu);

            // console.log("C",attributes[category]);
            for(var tag of attributes[category]){
              new TagButton(self,category,tag).appendTo($tagSelectionMenu);

            }
          }
          $item.prepend($selectionMenu);
          $selectionMenu.append($catSelectionMenu);
          $selectionMenu.append($tagSelectionMenu);
          // console.log("appenced");'s
          categorizerAppended=true;
        }
        if(useMasonry) updateMasonry();
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
          // console.log(thisList);

        });
        var $reattach=$item.parent();
        this.detach=function(){
          $item.detach();
        }
        this.reattach=function(){
          $item.appendTo($reattach);
        }
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
          if(categoryHas===false){
            return true;
          }else if(self.attributes[categoryHas]){
            if(val===false){
              return true;
            }else if(self.attributes[categoryHas].indexOf(val)!==-1)
              return true
            else
              return false;
          }else{
            //didn't even have matching category
            return false;
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

    if(urlRequestedSelection){

    }


});
