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
        var busLatLng = {lat: <?php echo $lat; ?>, lng: <?php echo $lon; ?> };
        
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
          center: busLatLng,
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(mapCanvas, mapOptions);
        
        <?php
          //Get posible locations that are near and display them.
          try { //try 3
            //Get all places of the user.
            $dbh = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("SELECT * FROM `place` WHERE `lat`>:latMin AND `lat`<:latMax AND `lon`>:lonMin AND `lon`<:lonMax");
            $step1 = 0.1;
            $latMin = $lat - $step1;
            $latMax = $lat + $step1;
            $lonMin = $lon - $step1;
            $lonMax = $lon + $step1;
            $stmt->bindParam(':latMin', $latMin);
            $stmt->bindParam(':latMax', $latMax);
            $stmt->bindParam(':lonMin', $lonMin);
            $stmt->bindParam(':lonMax', $lonMax);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $title       = $row['title'];
              $description = $row['description'];
              $image       = $row['image'];
              $imageType   = $row['imageType'];
              $lon1         = $row['lon'];
              $lat1         = $row['lat'];
              
              $imageIcon = "";
              if (!empty($image)) {
                $imageIcon   = "<img src=\"data:$imageType;base64," . base64_encode($image) . "\" alt=\"icon\" width=\"80px\" height=\"60px\"/>";
              }
              
              $content = "<div>$title</div> <div>$description</div> $imageIcon";
              
              echo "myLatLng1 = {lat: $lat1, lng: $lon1 };";
              echo "infoWindow1 = new google.maps.InfoWindow({ content: '$content' });";
              echo "marker1 = new google.maps.Marker({";
              echo "  position: myLatLng1,";
              echo "  map: map";
              echo "});";
              echo "infoWindow1.open( map, marker1 );";
              
            }
          } //End try 3
          catch (PDOException $e) {
            echo 'Error in sql: ' . $e->getMessage();
          }
        ?>
        
        var busMarker = new google.maps.Marker({
          position: busLatLng,
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
