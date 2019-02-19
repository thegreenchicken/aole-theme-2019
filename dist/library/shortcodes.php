<?php
function test_shortcode($a){

  return "hello!".json_encode($a);
}

add_shortcode('hello_hello', 'test_shortcode');

function counter_shortcode($a){
  $val=$a['value'];
  if(!$val){
    $val=$a[0];
  }
  return '<div class="counter-widget '.$a['class'].'" style="'.$a['style'].'">'.$val.'</div>';
}

add_shortcode('counter', 'counter_shortcode');


function icon($a){
  $val=$a['icon'];
  if(!$val){
    $val=$a[0];
  }
  return '<span style="'.$a['style'].'" class="'.$val.' '.$a['class'].'"></span>';
}

add_shortcode('icon', 'icon');


function signup_form($a){
  $mod = get_theme_mod('aole_2019_shortcodes');

  $cont=$mod["signup_form"];

  if($cont){
    return $cont;
  }else{
    return "<!--could not execute [signup_form] shortcode: a page titled '[signup_form]' does not exist.-->";
  }
}

add_shortcode('signup_form', 'signup_form');


?>
