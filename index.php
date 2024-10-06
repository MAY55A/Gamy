<?php
    session_start();
?>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav class="main-nav">
            <a href="index.php" id="logo"><em>Gamy</em></a>
            <?php
                if(isset($_SESSION['user'])) {
                    echo '<a href="mycart.php" class="l1"> My Cart &#128722</a>';
                    echo '<a href="mygames.php" class="l1"> My Games &#127918</a>';
                    echo '<a href="Logout.php" class="l1 redbt"> Logout</a>';
                } else {
                    echo '<a href="Login.php" class="l1"> Login</a>';
                    echo '<a href="signup.php" class="l1 redbt"> Sign Up</a>';
                }
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
                <form method="post" action="search.php"><input type="search" id="search" placeholder="search game ...." name="game"></form>
        </div>
    </header>
    <section class="home">
        <?php
            require "connexion.php";
            $sql = " select * from games;";
            $req1 = mysqli_query($con, $sql) or die('Erreur SQL');
            while($data= mysqli_fetch_array($req1))
                $games[] = $data;
            function recent($a, $b) {
                return $a['release_date'] < $b['release_date'];
            }
            function highest($a, $b) {
                return $a['rating'] < $b['rating'];
            }
            function topseller($a, $b) {
                return $a['sales'] < $b['sales'];
            }
            function deal($a, $b) {
                return $a['discount'] < $b['discount'];
            }
            function display_games(array $games, $criteria, $con) {
                echo '<div class="scroll">';
                usort($games, $criteria);
                for($i=0; $i<6; $i++) {
                    echo "<div class=\"game animated\"><div><h2>".$games[$i]['name']."</h2><p>".$games[$i]['price']*(1-$games[$i]['discount']/100)." $ ";
                    if($games[$i]['discount'])
                        echo "( ".$games[$i]['discount']." % off )";
                    echo "<br>".$games[$i]['rating']." &#11088</p>";
                    if(isset($_SESSION['user'])) {
                        $sql2 = 'select client game from purchases where client="'.$_SESSION['user'].'" and game = '.$games[$i]['code'].' union select user game from cart where user="'.$_SESSION['user'].'" and game = '.$games[$i]['code'];
                        $req2 = mysqli_query($con, $sql2) or die('Erreur SQL');
                        if(mysqli_num_rows($req2) == 0)
                            echo "<a class=\"add\" href=\"addtocart.php?code=".$games[$i]['code']."\">add to cart</a>";
                    } else
                        echo '<a class="add" href="login.php">add to cart</a>';
                    echo "</div><a href=\"details.php?code=".$games[$i]['code']."\"><img src=\"".$games[$i]['image']."\"></a></div>";
                    }
                echo '</div>';
            }
        ?>
        <h1>Most Recent</h1>
        <?php
            display_games($games, "recent", $con);
        ?>
        <h1> Highest Ranked</h1>
        <?php
            display_games($games, "highest", $con);
        ?>
        <h1>Top Sellers</h1>
        <?php
            display_games($games, "topseller", $con);
        ?>
        <h1>Deals of the month</h1>
        <?php
            display_games($games, "deal", $con);
        ?>
    </section>
</body>