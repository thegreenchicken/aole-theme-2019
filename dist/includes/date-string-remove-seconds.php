<?php
function string_remove_seconds($str){
  // echo $str;
  return join(":",array_slice( explode(":",$str),0,2 ));
}
?>
