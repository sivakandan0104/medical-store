<?php
    $server = "localhost";
    $user = "root";
    $password = "siva";
    $dbname = "myproject";

    $conn = mysqli_connect($server,$user,$password,$dbname);

    if(!$conn){
        echo " please connect";
    }
    
?>



