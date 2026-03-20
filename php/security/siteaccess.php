<?php

if($_GET['letmein'] == $key){
  $_SESSION['revaccess'] = $key;
  echo "<img src='/media/noaccess/success/success.png'>";
  header("Refresh: 1; URL=/");
  exit;
}

if ($_SESSION['revaccess'] !== $key || !$_SESSION['revaccess']){

$imagesDir = 'media/noaccess/';

$images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

$randomImage = $images[array_rand($images)];

if(rand(1,2) == 2){

?>

<img src="<?=$randomImage;?>">
<?php }else{
?>
<iframe width="930" height="523" src="https://www.youtube.com/embed/<?=randomvideo();?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
<?php } exit; } ?>
