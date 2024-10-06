<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $basename = "gamy";

    $con = mysqli_connect($hostname, $username, $password, $basename);
    if(mysqli_connect_errno())
        echo "Connection failed :". mysqli_connect_errno();
?>