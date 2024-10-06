<?php
    echo "<head><title>remove user: ".$_GET["user"]."</title></head>";
    require "connexion.php";
        $sql = " delete from accounts where user = '".$_GET["user"]."'";
        $req = mysqli_query($con, $sql) or die('Erreur SQL');
        echo '<div>Account Deleted !</div>';
    ?>