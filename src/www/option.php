<?php
    require_once('php_utils.php');
    $lang = getLang();
    ?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="./mystyle.css" />
  <title><?php echoString($lang, "optiontitle") ?> </title>
 </head>
 <body>

<?php
    $thesh = getThesh();
    $pass  = getPass();
    
    echo "<ul class=\"list_lang\" >";
    echo "<li> <a href=\"option.php?lang=GR&thesh=$thesh&pass=$pass\"> GR </a> </li>";
    echo "<li> <a href=\"option.php?lang=EN&thesh=$thesh&pass=$pass\"> EN </a> </li>";
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
        echo "<ul class=\"list_main\" >";
        echo "<li>";
        echo "<a href=\"music_list.php?lang=$lang&thesh=$thesh&pass=$pass\" > <div>" . getString($lang, "m1") . "</div> </a>";
        echo "</li>";
        echo "<li>";
        echo "<a href=\"video_list.php?lang=$lang&thesh=$thesh&pass=$pass\" > <div>" . getString($lang, "v1") . "</div> </a>";
        echo "</li>";
        echo "</ul>";
        
        echo "<a class=\"button\" href=\"index.php?lang=$lang&thesh=$thesh&pass=$pass\" >" . getString($lang, "bk") . "</a>";
    }
?>

 </body>
</html>