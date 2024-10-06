<?php
    session_start();
?>
<head>
    <title>My Games</title>
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
    <section class="mygames">
        <?php
            require "connexion.php";
            $sql1 = ' select * from purchases where client ="'.$_SESSION['user'].'"';
            $req1 = mysqli_query($con, $sql1) or die('Erreur SQL');
            while($data = mysqli_fetch_array($req1)) {
                $sql2 = ' select * from games where code ='.$data['game'];
                $req2 = mysqli_query($con, $sql2) or die('Erreur SQL');
                if(mysqli_num_rows($req2) > 0) {
                    $game = mysqli_fetch_array($req2);
                    echo '<div class="mygame">';
                    echo '<a href="details.php?code='.$game['code'].'"><img src="'.$game['image'].'"></a><p>';
                    echo $game['name']."<br>bought with ";
                    if($data["discount"])
                        echo $data['price']*(1-$data["discount"]/100).' $ instead of '.$data['price'].' $';
                    else
                        echo $data['price'].' $';
                    echo '<br>at '.$data['date'];
                    echo '</p><p>my rating : '.$data['rating'].'&#11088'.'<br>site rating : '.$game['rating'].'&#11088'.'</p>';
                    echo '<form id="rate" method="post"><input name="'.$data['game'].'" type="number" min="0" max="5" step="0.1" required><br><input type="submit" value="Rate"></form></div>';
                    if(isset($_POST[$data['game']])) {
                        $myrating = $_POST[$data['game']];
                        $sql3 = "update purchases set rating= $myrating where client= '".$_SESSION['user']."' and game= ".$data['game'];
                        $req3 = mysqli_query($con, $sql3) or die('Erreur SQL');
                        $sql4 = 'select round(avg(rating),2) as value from purchases where game ='.$data['game'];
                        $req4 = mysqli_query($con, $sql4) or die('Erreur SQL');
                        $rating = mysqli_fetch_array($req4)['value'];
                        $sql5 = "update games set rating= $rating where code= ".$data['game'];
                        $req5 = mysqli_query($con, $sql5) or die('Erreur SQL');
                        header("Location: mygames.php");
                    }
                }
            }
        ?>
    </section>