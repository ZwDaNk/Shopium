<?php $title = "Dashboard"; include("php/head.php");

if (!isset($_SESSION['id'])) {
    header("Location: /");
    exit();
}

?>
<br>
  <div class="row mt-5">
    <div class="col" style="text-align: center;">
<div class="card bg-dark">
  <div class="card-header">
    Hello, <?=htmlspecialchars($u['username']);?>!
  </div>
  <div class="card-body">
    <img src="https://goblox.space/images/NewFrontPageGuy.png" style="height: 15rem;">
  </div>
</div>
</div>
    
    <div class="col" style="text-align: center;">
      
      
      <div class="card bg-dark mb-3">
  <div class="card-header">
    Your Feed
  </div>
        <div class="card-body">
          <div class="row">
            <div class="col-9">
          <input type="text" class="form-control" placeholder="What's new, <?=htmlspecialchars($u['username']);?>?">
            </div>
            
            <div class="col-1" style="padding-left: 0px;">
          <input type="submit" class="btn btn-<?=$maincolor;?>" value="Submit">
            </div>
            
            </div>
          
        </div>
</div>
      


</div>
    
    
    <div class="col" style="text-align: center;">
      
      
<div class="card bg-dark mb-3">
  <div class="card-header">
    Recently Played
  </div>
        <div class="card-body">
          
          <?=randomquote();?>
            
            </div>
          
        </div>
</div>

</div>

</div>


<?php include("php/footer.php"); ?>