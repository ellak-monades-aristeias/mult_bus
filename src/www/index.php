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
echo "<li> <a href=\"index.php?lang=GR&thesh=$thesh&pass=$pass\"> GR </a> </li>";
echo "<li> <a href=\"index.php?lang=EN&thesh=$thesh&pass=$pass\"> EN </a> </li>";
echo "</ul>";
    
if ($thesh==-1 || $pass==-1 || correctPass($thesh,$pass)==0 ) {
    echo "<form name =\"input\" action=\"index.php?lang=$lang\" method=\"get\">";
    echo getString($lang, "enter_id_pass");
    echo "<br />";
    echo "<input type=\"number\" placeholder=\"" . getString($lang, "seat") . "\" name=\"thesh\" />";
    echo "<br />";
    echo "<input type=\"number\" placeholder=\"" . getString($lang, "pass") . "\"  name=\"pass\" />";
    echo "<br />";
    echo "<input type=\"submit\" value=\"" . getString($lang, "submit") . "\" />";
    echo "</form>";
}
else {
    echo "<div class=\"title\">" . getString($lang, "h1") . "</div>";

    echo "<div class=\"title\">" . getString($lang, "h2" ) . "</div>";
    
    echo "<ul class=\"list_main\" >";
    
    
    echo "<li>";
    echo "<a href=\"option.php?lang=$lang&thesh=$thesh&pass=$pass\"> <div>" . getString($lang, "o2"). "</div> </a>";
    echo "</li>";
    
    echo "<li>";
    echo "<a href=\"http://bus-aggelos.rhcloud.com/map.php?id=1"> <div>" . getString($lang, "o3"). "</div> </a>";
    echo "</li>";
    
    echo "<li>";
    echo "<a href=\"https://www.facebook.com/ktelioanninon\"> <div>" . "Facebook Ktel Ioanninon" . "</div> </a>";
    echo "</li>";
    
    echo "<li>";
    echo "<a href=\"http://www.ktelioannina.gr\"> <div>" . getString($lang, "o5") . "</div> </a>";
    echo "</li>";
    
    echo "<li>";
    echo "<a href=\"info.php?lang=$lang&thesh=$thesh&pass=$pass\"> <div>" . getString($lang, "o1"). "</div> </a>";
    echo "</li>";
    
    echo "</ul>";
    
}
?>

 </body>
</html>