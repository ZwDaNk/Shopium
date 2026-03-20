<?php
  // PHP Stuff
  error_reporting(0);
  session_start();
  
  // Branding Stuff
  include("colors.php");
  $sitename = "Minish";
  $company = "Oddity POLTERGEIST";
  $icon = "/media/branding/icon.png"; // (/media/branding/icon.png)
  $currency = "Drink";
  $currencies = "Drinks"; // (this is for plural)
  $currencyicon = "/media/branding/currency.png"; // (/media/branding/currency.png)
  
  // Access Key
  $key = "ThisWasIntendedToBeSliderIn2023NowItsMinishOrStarishOrAnotherThing";

  // Inclusions
  include("db.php");
  include("fun/randomquote.php");
  include("fun/randomvideo.php");
  include("security/siteaccess.php");
  include("functions/profile.php");
  
  // Title
  if(!$title){
    $pagetitle = $sitename;
  }else{
    $pagetitle = $title." - ".$sitename;
  }
  
  // Alert Function
  function alert($color,$content,$closeable) {
    $_alert = '
      <div class="alert alert-'.$color.' alert-dismissible fade show" role="alert">
  '.$content;
    
  if($closeable == true) {
    $_alert .= '
  <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>';
    
    }
    
    $_alert .= '
</div>
      ';
    
    return $_alert;

}
  
  // Login Helpers
  if (isset($_SESSION['id'])) {
    $loggedin = true;
    $userId = $_SESSION['id'];

    $selectQuery = "SELECT * FROM users WHERE id = :id";
    $selectStatement = $pdo->prepare($selectQuery);
    $selectStatement->bindParam(':id', $userId, PDO::PARAM_INT);
    $selectStatement->execute();

    $u = $selectStatement->fetch(PDO::FETCH_ASSOC);
    
    // Securiti
    
    if($_SESSION['id'] !== $u['id']){
      unset($_SESSION['id']);
      unset($_SESSION['username']);
      header("Location: /");
      exit;
      }
  }
  
  // Get Alert
    $selectQuery = "SELECT * FROM alert ORDER BY id DESC LIMIT 1";
    $selectStatement = $pdo->query($selectQuery);

    $alert = $selectStatement->fetch(PDO::FETCH_ASSOC);

?>
