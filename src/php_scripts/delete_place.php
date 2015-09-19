<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Delete place</title>
  </head>
  <body>
    <?php
      include_once 'config.php';
      
      $id    = NULL;
      $pass1 = NULL;
      //Check if the user name and password have been set.
      if (isset($_GET["id"]) && isset($_GET["pass"]) ) {  //if 0
        $id    = $_GET["id"];
        $pass1  = $_GET["pass"];
        //Check if they are correct.
        try {
          $dbh = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $dbh->prepare("SELECT * FROM `user` WHERE `id`=:id AND `pass`=:pass");
          $stmt->bindParam(':id',   $id);
          $stmt->bindParam(':pass', $pass1);
          $stmt->execute();
          //If at least one row has been returned, then the id and the pass are correct.
          if($stmt->fetch()) {  //if 1
            //Remove the desired place.
            if (isset($_GET["title"]) && isset($_GET["lon"]) && isset($_GET["lat"])) { //if 2
              $title = $_GET["title"];
              $lon   = $_GET["lon"];
              $lat   = $_GET["lat"];
              $stmt = $dbh->prepare("DELETE FROM `place` WHERE `ownerid`=:id AND `title`=:title AND `lon`=:lon AND `lat`=:lat");
              $stmt->bindParam(':id',    $id);
              $stmt->bindParam(':title', $title);
              $stmt->bindParam(':lon',   $lon);
              $stmt->bindParam(':lat',   $lat);
              $stmt->execute();
              echo "Delete OK";
    ?>
              <form method="POST" action="insert_place.php" enctype="multipart/form-data">
                <input type="hidden" name="id"   value="<?php echo $id; ?>" />
                <input type="hidden" name="pass" value="<?php echo $pass1; ?>" />
                <input type="submit" name="submit" value="Go back"/>
              </form>
    <?php
            } //End if 2
            else {
              echo "Need: id, title, lon, lat.";
            }
          } //End if 1
          else {
            echo "Wrong username or password.";
          }
        } catch (PDOException $e) {
          echo 'Error in sql: ' . $e->getMessage();
        }
        //Close connection.
        $dbh = null;
      } //End if 0
      else {
        echo "Need: id, pass";
      }
    ?>
  </body>
</html>