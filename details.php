<?php
    session_start();
    require "connexion.php";
    echo "<head><title>#".$_GET['code']."</title>";
    echo "<link rel=\"stylesheet\" href=\"style.css\"></head>";
?>
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
        </div>
    </header>
    <section id="details">
    <?php
    $sql = " select * from games where code =".$_GET['code'];
    $req = mysqli_query($con, $sql) or die('Erreur SQL');
    $data = mysqli_fetch_array($req);
    if($data) {
        echo '<h1 id="title">'.$data['name']."</h1>";
        echo '<div class="details"><img src="'.$data['image'].'"><br><p>';
        echo "genre : ".$data['genre']."<br>";
        echo "studio : ".$data['studio']."<br>";
        echo "date of release : ".$data['release_date']."<br>";
        echo "platforms : ";
        foreach(['pc', 'ps', 'xbox', 'nintendo'] as $p)
            if($data[$p])
                echo "$p ";
        echo "<br>awards : ".$data['awards']."<br>";
        echo "sales : ".$data['sales']."<br>";
        echo "rating : ".$data['rating']."&#11088<br>";
        echo "price : ";
        if($data['price'] == 0)
            echo "free<br>";
        elseif($data['discount']) {
            echo '(discount of '.$data['discount'].'%) ';
            echo $data['price']*(1-$data['discount']/100).'$ instead of '.$data['price'].' $<br>';
        } else
            echo $data['price'].'$<br>';
        echo '</p></div><div id="desc"><h4>Game Description :</h4>'.$data['description']."</div>";
    }
    mysqli_free_result($req);
    mysqli_close($con);
    ?>
    </section>
</body>