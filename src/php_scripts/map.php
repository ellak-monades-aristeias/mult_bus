<?php
#Get the last coordinates of a bus.
include_once 'config.php';
if (isset($_GET["id"])){
  $id   = $_GET["id"];
  try {
    $dbh = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $dbh->prepare("SELECT * FROM `position` WHERE `id`=:id ORDER BY `when` desc LIMIT 1;");
    $stmt->bindParam(':id',   $id);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $when = $row['when'];
      $lon  = $row['lon'];
      $lat  = $row['lat'];
    }
  } catch (PDOException $e) {
    echo 'Error in sql: ' . $e->getMessage();
  }
  //Close connection.
  $dbh = null;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <style>
      #map {
        width: 100%;
        height: 100vh;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
      function initialize() {
        var myLatLng = {lat: <?php echo $lat; ?>, lng: <?php echo $lon; ?> };
        
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
          center: myLatLng,
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);
        
        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          label: 'Bus'
        });
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map"></div>
  </body>
</html>
