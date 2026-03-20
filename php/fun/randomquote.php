<?php

function randomquote(){

$quotes = array(
    '𓍝',
    'FAT FISH',
    'meow root beer no',
    'FIRE IN THE HOLE',
    'git pull some bitches',
    'i will cut your head off >w<',
    'oak',
    'wtf is vupa shirt bug',
    '1 monthly concurrent player',
    'go devplop',
    'new jork',
    'georga',
    'florda',
    'oddity wins best server award',
    'wrong button',
    'whats douseful stuff',
    'do useful backend...',
    'do the phpmyadmin',
    'Death',
    'site-trunk.zip',
    'Mudder',
    'free bobux generator 2024',
    'german dash 2.2',
    'shush kitten',
    'bro joine d',
    'eu sou o bacon hair',
    'Fun Stuff!',
    'Yup!',
    '2021 download no hindi subtitles',
    'Howdy fellow gamers',
    '~]NEW=]',
    'spies from orc mafia hq',
    'I\'m emo',
    'my mom',
    'obama bin laden',
    'never buying used computers again',
    'The Place To Not Be',
    'wrong gc',
    'nice opinion.'
    );
  
    $randomquote1 = array_rand($quotes);
    
    $randomquote = $quotes[$randomquote1];
    
    return $randomquote;

}

?>
