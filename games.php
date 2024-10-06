<html>
    <head>
        <title>Games</title>
        <link rel="stylesheet" href="styleList.css">
    </head>
    <body>
        <h2>Games Available</h2>
        <a id="l0" href="addgame.php">&#10009 Add game</a>
        <?php
            require "connexion.php";
            $sql = ' select * from games ';
            $req = mysqli_query($con, $sql) or die('Erreur SQL');
            echo '<h3>- total : '.mysqli_num_rows($req).' - </h3>';
            echo "<table><tr><th>Code</th><th>Name</th><th>Price</th><th>Discount</th></tr>";
            while($data = mysqli_fetch_array($req)) {
                echo "<tr>";
                echo "<td>".$data['code']."</td>";
                echo "<td>".$data['name']."</td>";
                echo "<td>".$data['price']."$</td>";
                echo "<td>".$data['discount']."%</td>";
                echo "<td><a id=\"l1\" href=\"details.php?code=".$data['code']."\">view details</a></td>";
                echo "<td><a id=\"l2\" href=\"editgame.php?code=".$data['code']."\">edit</a></td>";
                echo "<td><a id=\"l3\" href=\"removegame.php?code=".$data['code']."\">remove</a></td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($req);
            mysqli_close($con);
        ?>
        <?php

        ?>
    </body>
</html>