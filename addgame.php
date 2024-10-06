<head>
    <title>Add Game</title>
    <link rel="stylesheet" href="styleadd.css">
</head>
<body>
    <h2>Add new game</h2>
    <form method="post" enctype="multipart/form-data">
        <label>Name</label>
        <input type="text" name="name" required>
        <br><br>
        <label>Genre</label>
        <input type="text" name="genre" required>
        <br><br>
        <label>Studio</label>
        <input type="text" name="studio" required>
        <br><br>
        <label>Date of release <i>(yyyy-mm-dd)</i></label>
        <input type="date" name="date">
        <br><br>
        <label>Platforms</label><br>
        pc <input type="checkbox" name="pc" value="1" checked>
        ps <input type="checkbox" name="ps" value="1">
        xbox <input type="checkbox" name="xbox" value="1">
        nintendo <input type="checkbox" name="nintendo" value="1">
        <br><br>
        <label>Description</label><br>
        <textarea cols="40" rows="10" name="desc" required>description ...</textarea>
        <br><br>
        <label>Awards</label>
        <input type="text" name="awards">
        <br><br>
        <label>Image</label>
        <input type="file" name="img" required>
        <br><br>
        <label>Price</label>
        <input type="number" name="price" value=0 step="0.01" min=0 required>&nbsp $
        <br><br>
        <label>Discount</label>
        <input type="number" name="discount" min=0>&nbsp %
        <br><br>
        <input type="submit" value=" +  Add">
        <br><br>
    </form>
    <?php
        require "connexion.php";
        if($_POST){
            require "uploadimage.php";
            $sql = " INSERT INTO games (name, genre, description, studio, awards, release_date, pc, ps, xbox, nintendo, price, discount, image)
            VALUES ('$_POST[name]', '$_POST[genre]', '$_POST[desc]', '$_POST[studio]', '$_POST[awards]', '$_POST[date]', '".(isset($_POST['pc'])?1:0)."', '".(isset($_POST['ps'])?1:0)."', '".(isset($_POST['xbox'])?1:0)."', '".(isset($_POST['nintendo'])?1:0)."', '$_POST[price]', '$_POST[discount]', '$target_file')";
            $req = mysqli_query($con, $sql) or die('Erreur SQL');
            header("Location: games.php"); 
        }
    ?>
</body>