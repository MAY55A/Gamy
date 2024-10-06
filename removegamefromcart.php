<?php
    session_start();
    require "connexion.php";
    $sql = " delete from cart where user = '".$_SESSION['user']."' and game = ".$_GET["code"];
    $req = mysqli_query($con, $sql) or die('Erreur SQL');
    header("Location: mycart.php");      
?>