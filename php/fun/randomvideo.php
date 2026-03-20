<?php

function randomvideo(){

$videos = array(
    'T3Y92rZoSkc', // summoning garfield.exe at 3 am
    '6XAWgVmWZ7o', // roblox 2012 admin panel footage
    );
  
    $randomvideo1 = array_rand($videos);
    
    $randomvideo = $videos[$randomvideo1];
    
    return $randomvideo;

}

?>