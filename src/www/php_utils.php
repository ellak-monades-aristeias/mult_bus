<?php

    function getMysqlPass() {
        return "raspberry";
    }

    function correctPass($thesh, $pass) {
        $con = mysqli_connect("localhost", "root", getMysqlPass(), "multsyst");
        
        if (mysqli_connect_errno()) {
            echo "ERROR" . mysqli_connect_error();
        }
        
        mysqli_set_charset($con, "utf8");
        
        $query = "SELECT id FROM `theseis` WHERE `id`=$thesh AND `pass`=$pass";
        
        //echo $query;
        $result = mysqli_query($con, $query);
        
        $ret = 0;
        if ($result && mysqli_num_rows($result)>0) {
            $ret = 1;
        }
        
        mysqli_close($con);
        
        return $ret;
    }
    
    function getThesh() {
        $thesh = -1;
        if(isset($_GET['thesh'])) {
            $thesh = $_GET['thesh'];
        }
        return $thesh;
    }
    
    function getPass() {
        $pass = -1;
        if(isset($_GET['pass'])) {
            $pass = $_GET['pass'];
        }
        return $pass;
    }
    
    function getId() {
        $id = -1;
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        return $id;
    }

    function getLang() {
        $lang = "GR";
        if(isset($_GET['lang'])) {
            $lang = $_GET['lang'];
        }
        return $lang;
    }
    
    function getString($lang, $key) {
        $con = mysqli_connect("localhost", "root", getMysqlPass(), "multsyst");
        
        if (mysqli_connect_errno()) {
            echo "ERROR" . mysqli_connect_error();
        }
        
        mysqli_set_charset($con, "utf8");
        
        $query = "SELECT value FROM `metafraseis` WHERE `key` LIKE '$key' AND `lang` LIKE '$lang'";
        //echo $query;
        $result = mysqli_query($con, $query);
        
        $res="$key";
        if ($row=mysqli_fetch_array($result)) {
            $res = $row[0];
        }
        
        mysqli_close($con);
        
        return $res;
    }
    
    function echoString($lang, $key) {
        echo getString($lang, $key);
    }

?>