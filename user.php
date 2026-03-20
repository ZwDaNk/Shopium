<?php include_once("php/db.php");
  
  if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];

    try {
        $query = "SELECT * FROM users WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':id', $userId, PDO::PARAM_INT);
        $statement->execute();

        $usr = $statement->fetch(PDO::FETCH_ASSOC);

        if($usr === false) {
            $title = "User";
            $usererror = "User not found.";
        }else{
            $title = htmlspecialchars($usr['username']);
        }
    } catch (PDOException $e) {
        $usererror = $e->getMessage();
    }
} else {
    $usererror = "Invalid or missing user ID.";
}
  
  include("php/head.php"); 


  if($usererror){?>
  <div class="card bg-dark" style="margin-top: 7rem;">
  <div class="card-header">
    Error
  </div>
  <div class="card-body">
    <h5 class="card-title"><?=$sitename;?> cannot display the user. <text class="text-muted">Please look at the error below for more information.</text></h5>
    <p class="card-text"><b>Error:</b> <code><?=$usererror;?></code></p>
    <a href="/" class="btn btn-primary">Go Home</a>
  </div>
</div>
  <?php include("php/footer.php"); exit; } 
  
  

?>

            <div class="card bg-dark mb-4">
                <div class="card-header bg-<?=$maincolor;?>">
                    <h5 class="card-title mb-0">User Profile</h5>
                </div>
                <div class="card-body">
   <div id="user-image"><img src="https://goblox.space/images/NewFrontPageGuy.png" style="max-width: 350px; width: 350px; float: left; margin-right: 1.7rem;"></div>
   <div id="user-info">
      <h3 class="mb-0"><?=htmlspecialchars($usr['username']);?></h3>
      <div class="mb-2"></div>
      <b class="mb-0">Blurb:</b> 
      <p class="mb-4"><?php if($usr['blurb']){ echo profilecurrencycount($usr['id'], htmlspecialchars($usr['blurb'])); }else{ echo $defaultblurb; } ?></p>
      <p class="mb-0"><b>Friends: </b> N/A</p>
      <p class="mb-0"><b>Join Date: </b> <?=date('F j, Y', strtotime($usr['join_date'])); ?></p>
   </div>
</div>
            </div>

<div class="row">

        <div class="col-md-4">
            <div class="card bg-dark mb-4">
                <div class="card-header bg-warning text-white">
                    <h5 class="card-title mb-0">Games</h5>
                </div>
                
              <div class="card-body">
                    
                  <div class="row">
   <div class="col-6 col-md-3 text-center">
      <div class="col-auto p-0"><a href="#"><img src="https://goblox.space/images/NewFrontPageGuy.png" class="img-fluid rounded-circle" style="max-height: 6.5rem;"> <span class="text-light">Placeholder</span></a></div>
   </div>
   <div class="col-6 col-md-3 text-center">
      <div class="col-auto p-0"><a href="#"><img src="https://goblox.space/images/NewFrontPageGuy.png" class="img-fluid rounded-circle" style="max-height: 6.5rem;"> <span class="text-light">Placeholder</span></a></div>
   </div>
   <div class="col-6 col-md-3 text-center">
      <div class="col-auto p-0"><a href="#"><img src="https://goblox.space/images/NewFrontPageGuy.png" class="img-fluid rounded-circle" style="max-height: 6.5rem;"> <span class="text-light">Placeholder</span></a></div>
   </div>
   <div class="col-6 col-md-3 text-center">
      <div class="col-auto p-0"><a href="#"><img src="https://goblox.space/images/NewFrontPageGuy.png" class="img-fluid rounded-circle" style="max-height: 6.5rem;"> <span class="text-light">Placeholder</span></a></div>
   </div>
</div>
                  
                </div>
              
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-dark">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Groups</h5>
                </div>
                <div class="card-body">
                    
                  <div class="row">
   <div class="col-6 col-md-3 text-center">
      <div class="col-auto p-0"><a href="#"><img src="https://goblox.space/images/NewFrontPageGuy.png" class="img-fluid rounded-circle" style="max-height: 6.5rem;"> <span class="text-light">Placeholder</span></a></div>
   </div>
   <div class="col-6 col-md-3 text-center">
      <div class="col-auto p-0"><a href="#"><img src="https://goblox.space/images/NewFrontPageGuy.png" class="img-fluid rounded-circle" style="max-height: 6.5rem;"> <span class="text-light">Placeholder</span></a></div>
   </div>
   <div class="col-6 col-md-3 text-center">
      <div class="col-auto p-0"><a href="#"><img src="https://goblox.space/images/NewFrontPageGuy.png" class="img-fluid rounded-circle" style="max-height: 6.5rem;"> <span class="text-light">Placeholder</span></a></div>
   </div>
   <div class="col-6 col-md-3 text-center">
      <div class="col-auto p-0"><a href="#"><img src="https://goblox.space/images/NewFrontPageGuy.png" class="img-fluid rounded-circle" style="max-height: 6.5rem;"> <span class="text-light">Placeholder</span></a></div>
   </div>
</div>
                  
                </div>
            </div>
        </div>
  
  
  
  
  
  <div class="col-md-4">
            <div class="card bg-dark">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Friends</h5>
                </div>
                <div class="card-body">
                    
                  <div class="row">
   <div class="col-6 col-md-3 text-center">
      <div class="col-auto p-0"><a href="#"><img src="https://goblox.space/images/NewFrontPageGuy.png" class="img-fluid rounded-circle" style="max-height: 6.5rem;"> <span class="text-light">Placeholder</span></a></div>
   </div>
   <div class="col-6 col-md-3 text-center">
      <div class="col-auto p-0"><a href="#"><img src="https://goblox.space/images/NewFrontPageGuy.png" class="img-fluid rounded-circle" style="max-height: 6.5rem;"> <span class="text-light">Placeholder</span></a></div>
   </div>
   <div class="col-6 col-md-3 text-center">
      <div class="col-auto p-0"><a href="#"><img src="https://goblox.space/images/NewFrontPageGuy.png" class="img-fluid rounded-circle" style="max-height: 6.5rem;"> <span class="text-light">Placeholder</span></a></div>
   </div>
   <div class="col-6 col-md-3 text-center">
      <div class="col-auto p-0"><a href="#"><img src="https://goblox.space/images/NewFrontPageGuy.png" class="img-fluid rounded-circle" style="max-height: 6.5rem;"> <span class="text-light">Placeholder</span></a></div>
   </div>
</div>
                  
                </div>
            </div>
        </div>
  
  
  
  
  
  
    </div>
<?php include("php/footer.php"); ?>