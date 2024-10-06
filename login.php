<?php
    session_start();
?>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styleForm.css">
</head>
<body>
    <form method="post">
        User Name <br>
        <input class="i" type="text" placeholder="user" name="user" required><br>
        Password <br>
        <input class="i" type="password" placeholder="password" name="pw" required><br>
        <input type="submit" value="Login"><br>
        <?php
        if(! empty($_POST)) {
            require "connexion.php";
            $user = $_POST['user'];
            $pw = $_POST['pw'];
            $sql1 = " select password from accounts where user = '$user'";
            $req1 = mysqli_query($con,$sql1) or die('Erreur SQL');
            if(mysqli_num_rows($req1) == 0)
                echo "Account doesn't exist !";
            else
                if(mysqli_fetch_array($req1)['password'] != $pw) {
                    echo "Wrong Password";
                    session_destroy();
                } else {
                    $_SESSION['user'] = $user;
                    header("Location: index.php");
                    exit();
                }
        }
    ?>
    </form>
    <p>You don't have an account ? Sign up !</p> <br>
    <a href="signup.php">Sign Up</a>
</body>
