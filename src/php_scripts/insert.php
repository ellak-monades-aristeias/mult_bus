<?php

include_once 'config.php';

try {
  //Connect to the database.
  $dbh = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //Check if the url has the correct parameters
  if (isset($_GET["id"]) && isset($_GET["pass"]) && isset($_GET["when"]) && isset($_GET["lon"]) && isset($_GET["lat"])){
    $id   = $_GET["id"];
    $pass = $_GET["pass"];
    $when = $_GET["when"];
    $lon  = $_GET["lon"];
    $lat  = $_GET["lat"];

    $stmt = $dbh->prepare("SELECT * FROM `bus` WHERE `id`=:id AND `pass`=:pass");
    $stmt->bindParam(':id',   $id);
    $stmt->bindParam(':pass', $pass);
    $stmt->execute();
	
    //If at least one row has been returned, then the id and the pass are correct.
    if($stmt->fetch()) {
      //Insert the lon and lat.
      $stmt = $dbh->prepare("INSERT INTO `position` (`id`, `when`, `lon`, `lat`) VALUES (:id, :when, :lon, :lat)");
      $stmt->bindParam(':id',   $id);
      $stmt->bindParam(':when', $when);
      $stmt->bindParam(':lon',  $lon);
      $stmt->bindParam(':lat',  $lat);
      $stmt->execute();
    } else {
      echo "Wrong id or pass.";
    }
  } else {
    echo "Error in url parameters.";
  }
} catch (PDOException $e) {
  echo 'Error in sql: ' . $e->getMessage();
}

//Close connection.
  $dbh = null;
?>