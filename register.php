<?php $title = "Register"; include("php/head.php"); ?>
<form method="POST">
<br>
  <div class="row mt-5">
    <div class="col" style="text-align: center;">
<h1><img src="<?=$icon;?>" style="height: 14rem;"></h1>
<h3 class="badge bg-dark" style="font-size: 2rem; margin-top: 0px;"><?=randomquote();?></h3>
</div>
    
    <div class="col" style="text-align: center;">
      
      <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm'];
    $email = $_POST['email'];

    if (strlen($username) < 3) {
        echo alert("danger", "Username must be at least 3 characters", true);
        $unamerror = true;
    } elseif (strlen($username) > 20) {
        echo alert("danger", "Username must be under 20 characters", true);
        $unamerror = true;
    } elseif (!preg_match('/^[a-zA-Z0-9_\-\s]+$/', $username)) {
        echo alert("danger", "Username must not use special characters", true);
        $unamerror = true;
    } elseif (strlen($password) < 4) {
        echo alert("danger", "Password must be at least 4 characters", true);
        $passerror = true;
    } elseif ($password != $confirmPassword) {
        echo alert("danger", "Password and confirm password do not match", true);
        $passerror = true;
    } else {
        try {
            $checkQuery = "SELECT id FROM users WHERE username = :username";
            $checkStatement = $pdo->prepare($checkQuery);
            $checkStatement->bindParam(':username', $username, PDO::PARAM_STR);
            $checkStatement->execute();

            if ($checkStatement->rowCount() > 0) {
                echo alert("danger", "Username is taken", true);
                $unamerror = true;
            } else {
                $insertQuery = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
                $insertStatement = $pdo->prepare($insertQuery);
                $insertStatement->bindParam(':username', $username, PDO::PARAM_STR);
                $hashedPassword = hash('sha512',$password);
                $insertStatement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
                $insertStatement->bindParam(':email', $email, PDO::PARAM_STR);

                $insertStatement->execute();
                
                $checkQuery = "SELECT id, username FROM users WHERE username = :username";
                $checkStatement = $pdo->prepare($checkQuery);
                $checkStatement->bindParam(':username', $username, PDO::PARAM_STR);
                $checkStatement->execute();

                $user = $checkStatement->fetch(PDO::FETCH_ASSOC);
                
                unset($_SESSION['id']);
                unset($_SESSION['username']); // apparently helps against simple bot protection

                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                echo alert("success", "Registration successful!", false);

                header("Refresh: 1; URL=/");
            }

        } catch (PDOException $e) {
            echo alert("danger", "Error: " . $e->getMessage(), true);
        }
    }
}
  
  if($_GET['use']){
    $autoname = htmlspecialchars($_GET['use']);
  }elseif($_POST['username'] && !$unamerror){
    $autoname = htmlspecialchars($_POST['username']);
  }

  ?>

      <div class="card card-body bg-dark">
        <h3 class="card-title" style="text-align: left; border-bottom: 1px solid gray; padding-bottom: 1ch;">Sign up and join in on the fun</h3>
        <input type="text" class="form-control" placeholder="Username (3-20 characters, spaces allowed)" name="username" <?php if($autoname){?>value="<?=$autoname;?>"<?}?>>
        <input type="email" class="form-control mt-2" placeholder="Email" name="email">
        <input type="password" class="form-control mt-2" placeholder="Password (4 letters minimum)" name="password">
        <input type="password" class="form-control mt-2" placeholder="Confirm Password" name="confirm">
        <input type="submit" class="btn btn-<?=$maincolor;?> w-100 mt-2" value="Sign Up">
      </div>
</div>

</div>

<div style="border-top: 1px solid gray;" class="mt-4">
<h3>Can't think of a username?</h3>
Pick your favorite:
<?php include("php/fun/randomname.php");
$randomname1 = randomname();
$randomname2 = randomname();
$randomname3 = randomname();
?>
<a href="?use=<?=$randomname1;?>" class="btn btn-sm btn-outline-primary"><?=$randomname1;?></a> <a href="?use=<?=$randomname2;?>" class="btn btn-sm btn-outline-success"><?=$randomname2;?></a> <a href="?use=<?=$randomname3;?>" class="btn btn-sm btn-outline-danger"><?=$randomname3;?></a>

</div>

</form>

<?php include("php/footer.php"); ?>