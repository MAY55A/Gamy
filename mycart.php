<?php
    session_start();
?>
<head>
    <title>My Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="main-nav">
            <a href="index.php" id="logo"><em>Gamy</em></a>
            <?php
                echo '<a href="mycart.php" class="l1"> My Cart &#128722</a>';
                echo '<a href="mygames.php" class="l1"> My Games &#127918</a>';
                echo '<a href="logout.php" class="l1 redbt"> Logout</a>';
            ?>
            <a href="admin.php" id="admin">&#128736</a>
        </nav>
        <div id="img">
            <nav class="nav">
                <a href="PC.php" class="l2">PC</a>
                <a href="PS.php" class="l2">Playstation</a>
                <a href="X.php" class="l2">Xbox</a>
                <a href="N.php" class="l2">Nintendo</a>
            </nav>
        </div>
    </header>
    <section>
        <form method="post" class="container">
        <?php
            require "connexion.php";
            $sum = 0;
            $disc = 0;
            $gamestobuy = [];
            $sql1 = ' select game from cart where user ="'.$_SESSION['user'].'"';
            $req1 = mysqli_query($con, $sql1) or die('Erreur SQL');
            echo '<table class="cart">';
            while($data = mysqli_fetch_array($req1)) {
                $sql2 = ' select * from games where code ='.$data['game'];
                $req2 = mysqli_query($con, $sql2) or die('Erreur SQL');
                $game = mysqli_fetch_array($req2);
                if(mysqli_num_rows($req2) > 0) {
                    echo '<tr>';
                    echo '<td><a href="details.php?code='.$game['code'].'"><img src="'.$game['image'].'"></a></td>';
                    echo "<td>".$game['name']."</td>";
                    echo "<td>".$game['price']." $";
                    if($game["discount"])
                        echo " => ".$game["price"]*(1-$game["discount"]/100)." $";
                    echo '</td><td><a id="remove" href="removegamefromcart.php?code='.$data['game'].'">&#10006</a><input id="check" type="checkbox" name='.$data['game'];
                    if(isset($_POST[$data['game']])) {
                        echo " checked";
                        $gamestobuy[] = $data['game'];
                        $sum += $game['price'];
                        $disc += ($game['price']*$game['discount']/100);
                    }
                    echo '></td>';
                    echo "</tr>";
                }
            }
            echo "</table>";
            $query = urlencode(http_build_query($gamestobuy));
        ?>
        <div class="total">
            <input type="submit" value="Get Total"><br>
            original total : <?php echo $sum?> $<br>
            total discount : <?php echo $disc?> $
            <h3>Total</h3>
            <?php
                echo '<p>'.$sum - $disc.' $</p><br>';
                echo "<a href=\"buygames.php?games=".$query."\">Buy</a>";
            ?>
        </div>
        </form>
    </section>

</body>