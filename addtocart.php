<?php
    session_start();
    require "connexion.php";
    $sql = " INSERT INTO cart (user, game) values ('".$_SESSION["user"]."', ".$_GET["code"].")";
    $req = mysqli_query($con, $sql) or die('Erreur SQL');
    echo 'game added to cart !';
    header("Location:".$_SERVER['HTTP_REFERER']);
    die();
?>