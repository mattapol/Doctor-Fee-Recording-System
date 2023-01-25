<?php
    $hostName = "localhost";
    $user = "root";
    $pass = "root";
    $dbName = "df";
    $connect = mysqli_connect($hostName, $user, $pass, $dbName) or die("Error");
    mysqli_query($connect, "SET NAMES 'utf8' ");
?>