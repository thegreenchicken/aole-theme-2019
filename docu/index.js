//idea: being able to explore every file, see their comments and the code
//also to generate html files explaining the code
//it would need to use the readme.md's as the main folder explanation and then take the comment per file and display it as the documentation for that file.

var fs = require('fs');

var directoryWalk=require("./dirWalk.js");
var CompiledSourceFile=require("./CompiledSourceFile");

directoryWalk.ignore=[
  /node_modules(?:\/|\\)/,
  /\.git(?:\/|\\)/,
  /\.\.(?:\/|\\)docu(?:\/|\\)/
];

var contents={};
var sources="";

CompiledSourceFile.ready=function(){
  console.log("everything is ready");
  CompiledSourceFile.each(function(){
    /*
    contents{
      readme:"readme of the index, md parsed if the extensiton is md",
      "whatever file.php":{
        source:"source code",
        comments:{<line-number>:comments content},
      }
      folder:{
        readme:"",
        "whatever file.php":{}
      }
      [...]
    }

    this contents gets written to a json or js file,
    then there is simply an index.js that takes this structure and makes a pretty html file out of it.
    */

    console.log(this.getContents());
  });
}

directoryWalk("../",function(fullPath){
  console.log(fullPath);
  new CompiledSourceFile(fullPath,function(){
    const fs = require('fs');
    // console.log("  >> ",this.pathParts);
  });
});

// fs.writeFile(this.destinationPath, this.getHtml(), function (err) {
//   if (err) {
//     return console.log(err);
//   }

//   console.log("The file was saved!");
// });
