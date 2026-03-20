<?php
  $host = "localhost";
  $database = "minish";
  $username = "root";
  $password = "odditea";

  try {
      $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  } catch (PDOException $e) {
      $dberror = $e->getMessage();
  }
?>