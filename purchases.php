<html>
    <head>
        <title>Game Purchases</title>
        <link rel="stylesheet" href="styleList.css">
    </head>
    <body>
        <h2>Purchases Made</h2>
        <?php
            require "connexion.php";
            $sql = ' select * from purchases ';
            $req = mysqli_query($con, $sql) or die('Erreur SQL');
            echo '<h3>- total : '.mysqli_num_rows($req).' - </h3>';
            echo "<table><tr><th>Client account</th><th>Game Code</th><th>Purchase Date</th><th>Amount Payed</th><th>Original Price</th></tr>";
            while($data = mysqli_fetch_array($req)) {
                echo "<tr>";
                echo "<td>".$data['client']."</td>";
                echo '<td><a href="details.php?code='.$data['game'].'">#'.$data['game'].'</a></td>';
                echo "<td>".$data['date']."</td>";
                echo "<td>".$data['price']*(1-$data['discount']/100)." $</td>";
                echo "<td>".$data['price']." $</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($req);
            mysqli_close($con);
        ?>
    </body>
</html>