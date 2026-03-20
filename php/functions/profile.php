<?php
  
  include_once($_SERVER['DOCUMENT_ROOT']."/php/config.php");
  
  $defaultblurb = "Hello, ".$sitename."!";
  
  function profilecurrencycount($id, $blurb){
    
    global $pdo;
    
    global $currencyicon;
    
    $selectQuery = "SELECT * FROM users WHERE id = :id";
    $selectStatement = $pdo->prepare($selectQuery);
    $selectStatement->bindParam(':id', $id, PDO::PARAM_INT);
    $selectStatement->execute();

    $blurber = $selectStatement->fetch(PDO::FETCH_ASSOC);
    
    return str_replace("!{myCurrency}",'<img src="'.$currencyicon.'" style="height: 1.5rem; vertical-align: top;"> '.number_format($blurber['currency']),$blurb);
  
  }

?>