<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">

  </head>
  <link rel = "stylesheet"
     type = "text/css"
     href = "../style.css" />
  <body>
    <img class="annotable" src="<?php echo $_GET['img'] ?>"/>
  </body>
  <script src="<?php echo $_GET['data'] ?>"></script>
  <script src="../jquery-3.3.1.min.js"></script>
  <script src="../jquery-ui.min.js"></script>
  <script src="../annotator.js"></script>
</html>
