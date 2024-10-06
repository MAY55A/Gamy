<head>
    <title>Administration Key</title>
    <link rel="stylesheet" href="styleForm.css">
</head>
<body>
    <form method="post">
        <h4>This space is only for the site administrator !<br>
            A special key is needed in order to access this private space !
        </h4>
        
        Key :
        <input class="i" type="password" name="key"><br>
        <input type="submit" value="Confirm"><br>
    </form>
    <?php
        if(isset($_POST["key"]))
           if($_POST["key"] == "admkey")
              header("Location: adminHome.html");
           else
               echo "WRONG KEY !";
        else
            echo "please enter the key";
    ?>
</body>