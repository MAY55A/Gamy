<?php
    session_start();
    require "connexion.php";
    if(empty($_GET['games']))
        header('Location: mycart.php');
    parse_str($_GET['games'], $games);
?>
<head>
    <title>Card Info</title>
    <link rel="stylesheet" href="styleForm.css">
</head>
<form method="post">
    Enter your card number<br><input type="text" required><br><br>
    Enter your card code<br><input type="password" required><br><br>
    <input type="submit" name="pay" value="pay">
</form>
<?php
    if(isset($_POST["pay"])) {
        foreach($games as $game) {
            $sql0 = "select price, discount, sales from games where code = $game";
            $req0 = mysqli_query($con, $sql0) or die('Erreur SQL');
            $data = mysqli_fetch_array($req0);
            $sql1 = " INSERT INTO purchases (client, game, price, discount) values ('".$_SESSION["user"]."', ".$game.', '.$data['price'].', '.$data['discount'].");";
            $req1 = mysqli_query($con, $sql1) or die('Erreur SQL');
            $sql2 = "delete from cart where user= '".$_SESSION['user']."' and game = $game";
            $req2 = mysqli_query($con, $sql2) or die('Erreur SQL');
            $sql3 = "update games set sales=".($data['sales']+1)." where code = $game";
            $req3 = mysqli_query($con, $sql3) or die('Erreur SQL');
        }
        header('Location: mycart.php');
    }
?>