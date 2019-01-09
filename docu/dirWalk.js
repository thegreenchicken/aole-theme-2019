var fs = require('fs');
var path = require('path');

var directoryWalk = function(directoryName,callback) {
  fs.readdir(directoryName, function(e, files) {
    if (e) {
      console.log('Error: ', e);
      return;
    }

    files.forEach(function(file) {
      var fullPath = path.join(directoryName,file);
      var skip=false;
      for(var rx of directoryWalk.ignore){
        if(fullPath.match(rx)){
          skip=true;
        }
      }
      if(!skip)
        fs.stat(fullPath, function(e, f) {
          if (e) {
            console.log('Error: ', e);
            return;
          }
          if (f.isDirectory()) {
            directoryWalk(fullPath,callback);
          } else {
            callback(fullPath);
          }
        });
    });

  });
};

directoryWalk.ignore=[];

module.exports=directoryWalk;
