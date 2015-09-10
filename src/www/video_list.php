<?php
    require_once('php_utils.php');
    $lang = getLang();
?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="./mystyle.css" />
<title> <?php echoString($lang, "title") ?> </title>
 </head>
 <body>

<?php
    $thesh = getThesh();
    $pass  = getPass();
    
    echo "<ul class=\"list_lang\" >";
    echo "<li> <a href=\"video_list.php?lang=GR&thesh=$thesh&pass=$pass\"> GR </a> </li>";
    echo "<li> <a href=\"video_list.php?lang=EN&thesh=$thesh&pass=$pass\"> EN </a> </li>";
    echo "</ul>";
    
    
    if ($thesh==-1 || $pass==-1 || correctPass($thesh,$pass)==0 ) {
        echo "<ul class=\"list_main\" >";
        echo "<li>";
        echo getString($lang, "please_connect");
        echo "</li>";
        echo "</ul>";
        echo "<a class=\"button\" href=\"index.php?lang=$lang\"> " . getString($lang, "connect") . " </a>";
    }
    else {
        $con = mysqli_connect("localhost", "root", getMysqlPass(), "multsyst");
        
        if (mysqli_connect_errno()) {
            echo "ERROR" . mysqli_connect_error();
        }
        
        mysqli_set_charset($con, "utf8");
        
        $query = "SELECT id, name FROM `video`";
        //echo $query;
        $result = mysqli_query($con, $query);
        
        echo "<form action=''>\n";
        echo "<ul class=\"list_main\">\n";
        while ($row=mysqli_fetch_array($result)) {
            echo "<li>\n";
            echo "<a href=\"video_vote.php?lang=$lang&thesh=$thesh&pass=$pass&id=$row[0]\"> <div>" . $row[1] . "</div> </a>\n";
            echo "</li>\n";
        }
        echo "</ul>\n";
        echo "</form>\n";
        
        mysqli_close($con);
        
        echo "<a class=\"button\" href=\"option.php?lang=$lang&thesh=$thesh&pass=$pass\" >" . getString($lang, "bk") . "</a>";
    }
?>

 </body>
</html>