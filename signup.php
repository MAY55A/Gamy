<?php
    session_start();
?>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="styleForm.css">
</head>
<body>
    <h1>Create a new account !</h1>
    <form method="post">
        User Name <br>
        <input class="i" type="text" placeholder="user" name="user" required><br>
        Password <br>
        <input class="i" type="password" placeholder="password" name="pw" required><br>
        <input type="submit" value="Confirm"><br>
    </form>
    <?php
        if(! empty($_POST)) {
            require "connexion.php";
            $user = $_POST['user'];
            $pw = $_POST['pw'];
            $sql1 = " select * from accounts where user = '$user'";
            $req1 = mysqli_query($con,$sql1) or die('Erreur SQL');
            if(mysqli_num_rows($req1) == 0) {
                $sql2 = " insert into accounts(user, password) values ('$user', '$pw')";
                mysqli_query($con,$sql2) or die('Erreur SQL');
                $_SESSION['user'] = $user;
                header("Location: index.php");
                exit();
            } else
                echo 'Account already exists !';   
        }
    ?>
    <p>You already have an account ? Login !</p> <br>
    <a href="login.php">Login</a>
</body>
</html>