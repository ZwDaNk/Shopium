<?php $title = "Landing"; include("php/head.php"); ?>
  <div class="row">
    <div class="col" style="border-right: 1px solid gray;">
      <?php
  
  if (isset($_SESSION['id'])) {
    header("Location: /dashboard");
    exit();
}
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $checkQuery = "SELECT id, username, password FROM users WHERE username = :username";
        $checkStatement = $pdo->prepare($checkQuery);
        $checkStatement->bindParam(':username', $username, PDO::PARAM_STR);
        $checkStatement->execute();

        if ($checkStatement->rowCount() > 0) {
            $user = $checkStatement->fetch(PDO::FETCH_ASSOC);
            if ($user['password'] == hash('sha512',$password)) {

                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                echo alert("success", "Login successful!", false);

                header("Refresh: 1; URL=/dashboard");
            } else {
                echo alert("danger", "Incorrect password", true);
            }
        } else {
            echo alert("danger", "User does not exist", true);
        }
    } catch (PDOException $e) {
        echo alert("danger", "Error: " . $e->getMessage(), true);
    }
}
  ?>
<form method="POST">
<h1>Login to <?=$sitename;?></h1>
<?php include("php/fun/randomname.php"); ?>
<b>Username:</b> <input type="text" class="form-control" placeholder="<?=randomname();?>" style="width: unset; display: inline-block; height: 3ch;" name="username">
<br>
<br>
<b>Password:</b> <input type="password" class="form-control" placeholder="********" style="width: unset; display: inline-block; height: 3ch;" name="password">
<input type="submit" style="display: none;">
</form>
</div>
    
    <div class="col" style="text-align: center;">
<h6>Not a member of <?=$sitename;?>?</h6>
<h2>What are you waiting for?</h2>
<a href="/register" class="btn btn-lg btn-<?=$maincolor;?>">Join Today</a>
</div>

<div class="col" style="border-left: 1px solid gray; text-align: center;">
<iframe width="300" height="200" src="https://www.youtube.com/embed/<?=randomvideo();?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
</div>

</div>

<div style="border-top: 1px solid gray;" class="mt-4">
<h3>You don't even need an account.</h3>
That's right. Want to see if you like <?=$sitename;?> before you decide to fully join? <a href="/games" class="btn btn-sm btn-<?=$maincolor;?>">Play as Guest</a>
</div>

<?php include("php/footer.php"); ?>
