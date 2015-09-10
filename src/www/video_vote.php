<?php
    require_once('php_utils.php');
    $lang = getLang();
    $thesh = getThesh();
    $pass  = getPass();
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
    $id    = getId();
    
    echo "<ul class=\"list_lang\" >";
    echo "<li> <a href=\"music_vote.php?lang=GR&thesh=$thesh&pass=$pass\"> GR </a> </li>";
    echo "<li> <a href=\"music_vote.php?lang=EN&thesh=$thesh&pass=$pass\"> EN </a> </li>";
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
        
        $con = mysqli_connect("localhost", "root", getMysqlPass(), "multsyst");
        
        if (mysqli_connect_errno()) {
            echo "ERROR" . mysqli_connect_error();
        }
        
        mysqli_set_charset($con, "utf8");
        
        //Elegxos an yparxei video me sygkekrimeno id.
        $query = "SELECT * FROM `video` WHERE id=$id;";
        //echo $query;
        $result = mysqli_query($con, $query);
        
        if ($result && mysqli_num_rows($result)>0) {
            //To video yparxei.
            
            //Elegxos an exoyme pano apo 5 psifoys.
            $query = "SELECT count(*) FROM `psifoi_video` WHERE id_theshs=$thesh;";
            //echo $query;
            $result = mysqli_query($con, $query);
            
            if ($result && mysqli_num_rows($result)>0) {
                //Exei pano apo 5 psifoys.
                $row=mysqli_fetch_array($result);
                if ($row[0]>=5) {
                    echo getString($lang, "many_votes");
                }
                else {
                    //Exei kato apo 5 psifoys, opote katametroyme thn psifo.
                    $query = "INSERT INTO `psifoi_video` (`id_theshs`, `id_video`, `mytimestamp`) VALUES ($thesh, $id, CURRENT_TIMESTAMP);";
                    //echo $query;
                    $result = mysqli_query($con, $query);
                    
                    if (!$result) {
                        echo getString($lang, "vtnok");
                    }
                    else {
                        echo getString($lang, "vtok");
                    }
                }
            }
        }
        else {
            //Den yparxei to tragoydi.
            echo getString($lang, "vtnok");
        }
        
        mysqli_close($con);
        
        echo "</li>";
        echo "</ul>";
        
        echo "<a class=\"button\" href=\"video_list.php?lang=$lang&thesh=$thesh&pass=$pass\" >" . getString($lang, "bk") . "</a>";
    }
?>

 </body>
</html>