<?php
    session_start();
    if(isset($_POST["game"])){
        $name = $_POST["game"];
        $platform = null;
    }else if(isset($_POST["pcgame"])){
        $name = $_POST["pcgame"];
        $platform = "pc";
    }else if(isset($_POST["psgame"])){
        $name = $_POST["psgame"];
        $platform = "ps";
    }else if(isset($_POST["xgame"])){
        $name = $_POST["xgame"];
        $platform = "xbox";
    }else if(isset($_POST["ngame"])){
        $name = $_POST["ngame"];
        $platform = "nintendo";
    }
?>
<head>
    <title>searching <?php echo $name;?></title>
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
                <form method="post" action="search.php"><input type="search" value=<?php echo $name;?> id="search" placeholder="search game ...." name=<?php echo array_key_first($_POST);?>></form>
        </div>
    </header>
    <section class="games">
    <?php
        require "connexion.php";
        if($platform)
            $sql = " select * from games where name like '%$name%' and $platform = 1";
        else
            $sql = " select * from games where name like '%$name%'";
            $req = mysqli_query($con, $sql) or die('Erreur SQL');
            if(mysqli_num_rows($req) == 0)
                echo "No matching results for '$name'!";
            while($data = mysqli_fetch_array($req)) {
                echo "<div class=\"game\"><div><h2>".$data['name']."</h2><p>".$data['price']*(1-$data['discount']/100)." $</p>";
                if($data['discount'])
                    echo "<p>(discount ".$data['discount']." % )</p>";
                echo "<p>".$data['rating']." &#11088</p>";
                if(isset($_SESSION['user'])) {
                    $sql2 = 'select client game from purchases where client="'.$_SESSION['user'].'" and game = '.$data['code'].' union select user game from cart where user="'.$_SESSION['user'].'" and game = '.$data['code'];
                    $req2 = mysqli_query($con, $sql2) or die('Erreur SQL');
                    if(mysqli_num_rows($req2) == 0)
                        echo "<a class=\"add\" href=\"addtocart.php?code=".$data['code']."\">add to cart</a>";
                } else
                    echo '<a class="add" href="login.php">add to cart</a>';
                echo "</div><a href=\"details.php?code=".$data['code']."\"><img src=\"".$data['image']."\" width=300px height=200px></a></div>";
            }
        ?>
    </section>