<?php

   @include 'config.php';
   if(isset($_POST['add_prodact'])){
        $prodact_name = $_POST['prodact_name'];
        $prodact_image = $_FILES['prodact_image']['name'];
        $prodact_image_tmp_name = $_FILES['prodact_image']['tmp_name'];
        $prodact_image_folder = 'uploaded_img/' .$prodact_image;

        if(empty($prodact_name) || empty($prodact_image)){
            $massage[] = 'please fill out all';
        }else{
            $insert = "INSERT INTO prodact(name, image) VALUES('$prodact_name' , '$prodact_image')";
            $upload = mysqli_query($conn,$insert);
            if($upload){
                move_uploaded_file($prodact_image_tmp_name, $prodact_image_folder);
                $massage[] = 'new prodact added successfully';
            }else{
                $massage[] = 'could not add the prodact';
            }
        }
    };

    if(isset($_GET['delet'])){
        $id = $_GET['delet'];
        mysqli_query($conn, "DELETE FROM prodact WHERE id = $id");
        header('localhost:prodact.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="prodact.css">
    <title>prodact page</title>
</head>
<body>

<?php
if(isset($massage)){
    foreach($massage as $massage){
        echo '<span class="massage">'.$massage. '</span>';
    }
}
?>
<?php
        $select = mysqli_query($conn, "SELECT *FROM prodact");
?>
    <header>
        <div class="logo">
            <img src="./image/logo.jfif" alt="">
       </div>
       <nav class="navbar">
       <?php
        while($row = mysqli_fetch_assoc($select)){

         ?>
            <a href="#"><?php echo $row['name']; ?></a>
        <?php
        };
        ?>
        </nav>
    </header>
    <div class="add">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Add a new prodact</h3>
            <input type="text" name="prodact_name" placeholder="enter the prodact name">
            <input type="file" name="prodact_image" accept="image/*">
            <input type="submit" name="add_prodact" value="ADD" class="btn">
        </form>
    </div>
    <?php
        $select = mysqli_query($conn, "SELECT *FROM prodact");
    ?>

    

    <section class="product" id="product">
        <div class="product-cake">
        <?php
        while($row = mysqli_fetch_assoc($select)){

        ?>
            <div class="cake-box1 cake">
                <div class="img">
                    <img src="uploaded_img/<?php echo $row['image']; ?>" alt="">
                    <h3><?php echo $row['name']; ?></h3>
                </div>
                <div class="product-content">
                    <div class="orderNow">
                        <a href="update.php?edit=<?php echo $row['id']; ?>"><button class="edit" >Edit</button> </a>
                        <a href="prodact.php?delet=<?php echo $row['id']; ?>"><button class="delet">Delet</button></a>
                    </div>
                </div>
            </div>
        <?php
        };
        ?>
        </div>
    </section>


</body>
</html>