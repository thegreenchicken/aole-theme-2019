<?php

$output=Array("status"=>200);

if(! defined('wp_base_loaded')){
    define('wp_base_loaded', true);
    define('WP_USE_THEMES', false);
    include '../../../../wp-load.php';
    // include getenv('HTTP_HOST')."wp-load.php";
}

// echo "b";
// function isSiteAdmin()
// {
//     return in_array('administrator', wp_get_current_user()->roles);
// }
//
// print_r isSiteAdmin();
// print_r(wp_get_current_user());


$availabeInput = Array(
  "scope",//I couldn't find info of how to query events, so I guess we'll go with every event..
  "limit",
  "order",
);
$availableReturn = Array(
  "event_id",
  "guid",
  "slug",
  "name",
  "start_time",
  "start_date",
  // "notes",
  "post_id",
  "event_slug",
  "event_owner",
  "event_name",
  "event_start_time",
  "event_start_date",
  // "post_content",
  // "recurrence_id",
  // "blog_id",
  // "group_id",
  // "event_attributes",
);
$query=Array();
foreach ($_GET as $key => $value) {
  if(in_array($key,$availabeInput)){
    $query[$key]=$value;
  }
}

$events=EM_Events::get($query) ;

foreach($events as $key => $event){
  foreach($availableReturn as $var){
    if($event->{$var}){
      $output[$key][$var]=$event->{$var};
    }
  }
}

echo json_encode($output);
?>
