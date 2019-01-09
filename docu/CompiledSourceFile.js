var fs = require('fs');
var path = require('path');

function CompiledSourceFile(filename,onReady){
  var fileSource="";
  var outputHtml="";
  var self=this;
  this.readyState=false;

  this.sourcePath=filename;
  this.pathParts = filename.split(/(?:\/|\\)/gi);

  fs.readFile(filename, function read(err, data) {
    if (err) {
        throw err;
    }
    fileSource = data.toString('utf8');
    self.readyState=true;

    if (typeof onReady == "function") {
      onReady.call(self);
    }

    var everythingReady=true;
    CompiledSourceFile.each(function () {
      if (this.readyState == false) everythingReady=false;
    })
    if(everythingReady){
      CompiledSourceFile.ready();
    }else{
      // console.log("...");
    }


  });
  this.recompile=function(){
    var docuMatch=/<@docu([\W\w]*?)@\/>/g;
    // console.log(rawSource);
    var m = fileSource.match(docuMatch);
    if(m){
      m=m.map(function(a){
        return a.replace(docuMatch,"$1");
      });
    }
    fileContents=m;
  }
  this.getContents=function(){
    self.recompile();
    return fileContents;
  }

  CompiledSourceFile.list.push(this);
}

CompiledSourceFile.list=[];
CompiledSourceFile.each=function(cb){
  for (var itm of CompiledSourceFile.list){
    cb.call(itm);
  }
}

CompiledSourceFile.ready=function(){
  console.log("all queued files were loaded");
}

module.exports=CompiledSourceFile;
