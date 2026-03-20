<?php ob_start(); include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$pagetitle;?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <script src="//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
</head>
<body class="d-flex flex-column vh-100">

<style>
@keyframes scroll {
    from {
        background-position: 0 0;
    }

    to {
        background-position: -10000px 0;
    }
}

#scrollingcity {
    background-image: url("/media/backgrounds/header/city.png");
    background-repeat: repeat;
    background-position: 0 0;
    background-size: auto 100%;
    animation: scroll 500s linear infinite;
}
</style>

<?php if(!$hideheader){?>
<nav class="navbar navbar-expand-lg navbar-dark bg-<?=$navcolor;?>" id="scrollingcity">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><img src="<?=$icon;?>" style="height: 1.9rem; vertical-align: top;"> <?=$sitename;?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Games</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Catalog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/users">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="https://funcher.sadert.fun">Forum</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <?php if(!$loggedin){?>
        <li class="nav-item">
          <a class="nav-link active" href="/">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/register">Register</a>
        </li>
        <?}else{?>
        <li class="nav-item">
          <a class="nav-link active" href="/messages"><i class="fa fa-envelope"></i> N/A</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/currency" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tooltip on bottom"><img src="<?=$currencyicon;?>" style="height: 1.5rem; vertical-align: top;"> <?=number_format($u['currency']);?> <?php if($u['currency'] !== 1){ /* echo $currencies; */ }else{ /* echo $currency; */ } ?></a>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?=htmlspecialchars($u['username']);?>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-right" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="/user/<?=$u['id'];?>"><i class="fa fa-user"></i> Profile</a></li>
            <li><a class="dropdown-item" href="/settings"><i class="fa fa-cog"></i> Settings</a></li>
            <li><a class="dropdown-item" href="/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
        </li>
        <?}?>
      </ul>
    </div>
  </div>
</nav>
<?php if($loggedin){?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: <?=$subnavcolor;?> !important; padding: 0px;" id="subnav">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="/user/<?=$u['id'];?>">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Avatar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Develop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Download</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Groups</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Messages <span class="badge bg-danger">N/A</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Friends <span class="badge bg-danger">N/A</span></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?}?>

<?}?>

<?php if($alert){?>
<div class="alert alert-<?=$alert['type'];?> text-white" role="alert" style="text-align: center; font-weight: bold;">
  <?=$alert['content'];?>
</div>
<?}?>

<main class="flex-shrink-0">

<div class="container mt-3 mb-3">
  
  <?php if($dberror){?>
  <div class="card bg-dark" style="margin-top: 7rem;">
  <div class="card-header">
    Error
  </div>
  <div class="card-body">
    <h5 class="card-title"><?=$sitename;?> cannot connect to the database. <text class="text-muted">Please report this to a developer.</text></h5>
    <p class="card-text"><b>For developers:</b> <code><?=$dberror;?></code></p>
    <a href="/" class="btn btn-primary">Go Home</a>
  </div>
</div>
  <?php include("footer.php"); exit; } ?>
