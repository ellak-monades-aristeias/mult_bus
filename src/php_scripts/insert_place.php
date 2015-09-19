<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Insert place</title>
  </head>
  <body>
    
    <?php
      include_once 'config.php';
      
      $id   = NULL;
      $pass1 = NULL;
      //Check if the user name and password have been set.
      if (isset($_POST["id"]) && isset($_POST["pass"]) ) {  //if 0
        $id    = $_POST["id"];
        $pass1  = $_POST["pass"];
        //Check if they are correct.
        try {
          $dbh = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $dbh->prepare("SELECT * FROM `user` WHERE `id`=:id AND `pass`=:pass");
          $stmt->bindParam(':id',   $id);
          $stmt->bindParam(':pass', $pass1);
          $stmt->execute();
          //If at least one row has been returned, then the id and the pass are correct.
          if($stmt->fetch()) {
            //Nothing here, they exist on the database, so they are correct.
          } else {
            $id   = NULL;
            $pass1 = NULL;
          }
        } catch (PDOException $e) {
          echo 'Error in sql: ' . $e->getMessage();
        }
        //Close connection.
        $dbh = null;
      } //End if 0
      
      //If the password or username is not set or are not correct, display the login form.
      if (is_null($id) or is_null($pass1)) { //if 1
    ?>
      <form method="POST" action="">
        <table>
          <tr>
            <td>UserId: </td>
            <td><input type="text" name="id"></td>
          </tr>
          <tr>
            <td>Password: </td>
            <td><input type="text" name="pass"></td>
          </tr>
          <tr>
            <td> <input type="submit" name="submit1" value="Login"/> </td>
            <td></td>
          </tr>
        </table>
      </FORM>
    <?php
      } //End if 1
      else {  //else 1
        // The username is $id, the password is $pass1.
        //Check to see if some other info are provided, in order to store the data.
        if (isset($_POST["title"]) && isset($_POST["lon"]) && isset($_POST["lat"])) { //if 2
          try { //try 2
            //Connect to the database.
            $dbh = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //Get post parameters
            $title = $_POST["title"];
            $lon   = $_POST["lon"];
            $lat   = $_POST["lat"];
            
            //The parameters below are optional.
	          $description = NULL;
	          if (isset($_POST["description"])) {
          		$description = $_POST["description"];
	          }
	          $image = NULL;
            $imageType = NULL;
	          if (isset($_FILES["image"])) {
              $image = file_get_contents($_FILES["image"]["tmp_name"]);
              $imageProperties = getimageSize($_FILES['image']['tmp_name']);
              $imageType = $imageProperties['mime'];
	          }
            
            
            //Insert the place.
            $stmt = $dbh->prepare("INSERT INTO `place` (`title`, `description`, `image`, `imageType`, `lon`, `lat`, `ownerid`) VALUES (:title, :description, :image, :imageType, :lon, :lat, :ownerid)");
            $stmt->bindParam(':title',   $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':imageType', $imageType);
            $stmt->bindParam(':lon',  $lon);
            $stmt->bindParam(':lat',  $lat);
            $stmt->bindParam(':ownerid',  $id);
            $stmt->execute();
          } //End try 2
          catch (PDOException $e) {
            echo 'Error in sql: ' . $e->getMessage();
          }
          //Close connection.
          $dbh = null;
          
          
        } //End if 2
        
        //Display the input fields and the list of places bello.
    ?>
        <form method="POST" action="" enctype="multipart/form-data">
          <table>
            <tr> <td>Title: </td> <td><input type="text" name="title"></td> </tr>
            <tr> <td>Description: </td> <td><input type="text" name="description"></td> </tr>
            <tr> <td>Image: </td> <td><input type="file" name="image"/></td> </tr>
            <tr> <td>Longtitute: </td> <td><input type="text" name="lon"></td> </tr>
            <tr> <td>Latitute: </td> <td><input type="text" name="lat"></td> </tr>
            <tr> <td> <input type="submit" name="submit" value="Save"/> </td> <td></td></tr>
          </table>
          <input type="hidden" name="id"   value="<?php echo $id; ?>" />
          <input type="hidden" name="pass" value="<?php echo $pass1; ?>" />
        </form>
    <?php
        //Dislay a list of the places.
        try { //try 3
          //Get all places of the user.
          $dbh = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $dbh->prepare("SELECT * FROM `place` WHERE `ownerid`=:id");
          $stmt->bindParam(':id',   $id);
          $stmt->execute();
          echo "<table>";
          echo "<tr> <th>Title</th> <th>Description</th> <th>Lon</th> <th>Lat</th> <th>Image</th>  <th></th> </tr>";
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $title       = $row['title'];
            $description = $row['description'];
            $image       = $row['image'];
            $imageType   = $row['imageType'];
            $lon         = $row['lon'];
            $lat         = $row['lat'];
            $ownerid     = $row['ownerid'];
            $imageIcon = "";
            if (!empty($image)) {
              $imageIcon   = "<img src=\"data:$imageType;base64," . base64_encode($image) . "\" alt=\"icon\" width=\"160px\" height=\"120px\"/>";
            }
            $deleteButton  = "<a href=\"delete_place.php?id=$id&pass=$pass1&title=$title&lon=$lon&lat=$lat\"> Delete </a>";
            echo "<tr> <td>$title</td> <td>$description</td> <td>$lon</td> <td>$lat</td> <td>$imageIcon</td> <td>$deleteButton</td> </tr>";
          }
          echo "</table>";
        } //End try 3
        catch (PDOException $e) {
          echo 'Error in sql: ' . $e->getMessage();
        }
        //Close connection.
        $dbh = null;
      } //End else 1
      
    ?>
  </body>
</html>