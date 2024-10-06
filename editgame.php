<head>
    <title>Edit Game</title>
    <link rel="stylesheet" href="styleadd.css">
</head>
<body>
    <?php
        require "connexion.php";
        $sql1 = " select * from games where code =".$_GET['code'];
        $req1 = mysqli_query($con, $sql1) or die('Erreur SQL');
        $data = mysqli_fetch_array($req1);
            $name = $data['name'];
            $genre = $data['genre'];
            $desc = $data['description'];
            $studio = $data['studio'];
            $awards = $data['awards'];
            $img = $data['image'];
            $price = $data['price'];
            $discount = $data['discount'];
            $date = $data['release_date'];
    ?>
    <form method="post" enctype="multipart/form-data">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $name?>" required>
        <br><br>
        <label>Genre</label>
        <input type="text" name="genre" value="<?php echo $genre?>" required>
        <br><br>
        <label>Studio</label>
        <input type="text" name="studio" value="<?php echo $studio?>" required>
        <br><br>
        <label>Date of release <i>(yyyy-mm-dd)</i></label>
        <input type="text" name="date" value="<?php echo $date?>" >
        <br><br>
        <label>Platforms</label><br>
        pc <input type="checkbox" name="pc" value="1" <?php if($data['pc']) echo "checked";?>>
        ps <input type="checkbox" name="ps" value="1" <?php if($data['ps']) echo "checked";?>>
        xbox <input type="checkbox" name="xbox" value="1" <?php if($data['xbox']) echo "checked";?>>
        nintendo <input type="checkbox" name="nintendo" value="1" <?php if($data['nintendo']) echo "checked";?>>
        <br><br>
        <label>Description</label><br>
        <textarea cols="40" rows="10" name="desc" required><?php echo $desc?></textarea>
        <br><br>
        <label>Awards</label>
        <input type="text" name="awards" value="<?php echo $awards?>">
        <br><br>
        <label>Image</label>
        <img src="<?php echo $img?>" alt="Current Image">
        <input type="file" name="img">
        <br><br>
        <label>Price</label>
        <input type="number" name="price" value="<?php echo $price?>" required>&nbsp $
        <br><br>
        <label>Discount</label>
        <input type="number" name="discount" value="<?php echo $discount?>">&nbsp %
        <br><br>
        <input type="submit" value=" Save">
        <br><br>
    </form>
    <?php
        if($_POST) {
            $pc=isset($_POST['pc'])? 1 : 0;
            $ps=isset($_POST['ps'])? 1 : 0;
            $x=isset($_POST['xbox'])? 1 : 0;
            $n=isset($_POST['nintendo'])? 1 : 0;
            if(basename("images/".$_FILES["img"]["name"]) != $img) {
                require "uploadimage.php";
                $_POST['img'] = $target_file;
            }
            $sql2 = " update games set name='".$_POST['name']."', genre='".$_POST['genre']."', description='".$_POST['desc']."', studio='".$_POST['studio']."', awards='".$_POST['awards']."', release_date='".$_POST['date']."', pc=$pc, ps=$ps, xbox=$x, nintendo=$n, price=".$_POST['price'].", discount=".$_POST['discount'].", image='".$_POST['img']."' where code=".$_GET['code'];
            $req2 = mysqli_query($con, $sql2) or die('Erreur SQL');
            header("Location: games.php");
        }
    ?>
</body>