<html>
    <head>
        <title>Accounts</title>
        <link rel="stylesheet" href="styleList.css">
    </head>
    <body>
        <h2>Accounts Created</h2>
        <?php
            require "connexion.php";
            $sql = ' select * from accounts ';
            $req = mysqli_query($con, $sql) or die('Erreur SQL');
            echo '<h3>- total : '.mysqli_num_rows($req).' - </h3>';
            echo "<table><tr><th>User Name</th><th>Password</th><th>Creation Date</th></tr>";
            while($data = mysqli_fetch_array($req)) {
                echo "<tr>";
                echo "<td>".$data['user']."</td>";
                echo "<td>".$data['password']."</td>";
                echo "<td>".$data['creation_date']."</td>";
                echo "<td><a id=\"l3\" href=\"deleteaccount.php?user=".$data['user']."\">delete</a></td>";
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