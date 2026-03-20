<?php $title = "Dashboard"; include("php/head.php");error_reporting(E_ALL);
   if (!isset($_SESSION['id'])) {
       header("Location: /");
       exit();
   }
  
   ?>
<h3 class="font-weight-light mb-2 pb-1" style="border-bottom: 1px solid gray;"><i class="fa fa-cog"></i> Settings</h3>
<div class="row">
   <div class="col-md-4">
      <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
         <a class="nav-link active" id="v-pills-user-details-tab" data-bs-toggle="pill" href="#v-pills-user-details" role="tab" aria-controls="v-pills-user-details" aria-selected="true">User Details</a>
         <a class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">Password</a>
      </div>
   </div>
   <div class="col-md-8">
      <div class="tab-content" id="v-pills-tabContent">
         <div class="tab-pane fade show active" id="v-pills-user-details" role="tabpanel" aria-labelledby="v-pills-user-details-tab">
            <h4>User Details</h4>
            <div class="card bg-dark">
               <div class="card-body">
                  <p class="mb-1" style="margin-bottom:0px;"><strong>Username: </strong>
                     <?=htmlspecialchars($u['username']);?>                                
                  </p>
                  <p style="margin-bottom: 0px;">
                     <strong>E-mail: </strong>
                     <?=htmlspecialchars($u['email']);?>                                   
                  </p>
               </div>
            </div>
            <div class="mt-3">
               <form role="form" method="POST" enctype="multipart/form-data">
                  <div class="form-group row">
                     <label for="blurb" class="col-form-label text-md-right" style="margin-left:15px;">
                        <h4>Blurb</h4>
                     </label>
                     <div class="col-md-12">
                       <?php
  if (isset($_POST['blurb'])) {
    $blurb = htmlspecialchars($_POST['blurb']);

    try {
        $updateQuery = "UPDATE users SET blurb = :blurb WHERE id = :id";
        $updateStatement = $pdo->prepare($updateQuery);
        $updateStatement->bindParam(':blurb', $blurb, PDO::PARAM_STR);
        $updateStatement->bindParam(':id', $u['id'], PDO::PARAM_INT);

        if ($updateStatement->execute()) {
            echo alert("success", "Blurb updated successfully.", true);
        } else {
            echo alert("danger", "Error updating blurb.", true);
        }
    } catch (PDOException $e) {
        echo alert("danger", "Error: " . $e->getMessage(), true);
    }
}
  ?>
<textarea type="text" id="blurb" name="blurb" value="" placeholder="Blurb" class="form-control" rows="8">
<?php if($u['blurb']){ echo htmlspecialchars($u['blurb']); }else{ echo $defaultblurb; } ?>
</textarea>
                     </div>
                     <label class="col-form-label text-md-right row" style="margin-left:15px;">
                        <strong>Note:</strong>
                        <p class="text-danger" style="margin:0 3px 0 3px">!{myCurrency}</p>
                        will be replaced with
                        the amount of <?=$currencies;?> you have.
                     </label>
                  </div>
                  <div class="form-group col-md-2" style="padding-left: 0px;">
                     <button type="submit" class="btn btn-success">Update</button>
                  </div>
               </form>
            </div>
         </div>
         <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
            <h4>Password</h4>
            <p>Placeholder</p>
         </div>
      </div>
   </div>
</div>
<?php include("php/footer.php"); ?>