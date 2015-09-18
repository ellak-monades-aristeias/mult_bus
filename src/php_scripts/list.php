<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>List</title>
  </head>
  <body>
    <table>
      <thead> 
        <tr> 
          <th> Id </th>
          <th> Time </th>
          <th> Lon </th>
          <th> Lat </th>
        </tr>
      </thead>
      <tbody>
        <?php
          include_once 'config.php';
          //Connect to the database.
          $dbh = new PDO('mysql:dbname='.$dbname.';host='.$host.';port='.$port, $user, $pass);
          $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //Get the results.
          $sql = "SELECT * FROM `position` ORDER BY `when` desc;";
          $statement = $dbh->prepare ($sql);
          $statement->execute ();
          while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $id   = $row['id'];
            $when = $row['when'];
            $lon  = $row['lon'];
            $lat  = $row['lat'];
            echo "<tr> <td>$id</td> <td>$when</td> <td>$lon</td> <td>$lat</td> </tr>";
          }
        ?>
      </tbody>
    </table>
  </body>
</html>