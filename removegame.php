
<?php
    echo "<head><title>remove #".$_GET["code"]."</title></head>";
    require "connexion.php";
        $sql = " delete from games where code = ".$_GET["code"];
        $req = mysqli_query($con, $sql) or die('Erreur SQL');
        echo '<div>Game removed !</div>';
    ?>