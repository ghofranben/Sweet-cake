<?php

@include 'config.php';

$id = $_GET['edit'];

   if(isset($_POST['update_prodact'])){
        $prodact_name = $_POST['prodact_name'];
        $prodact_image = $_FILES['prodact_image']['name'];
        $prodact_image_tmp_name = $_FILES['prodact_image']['tmp_name'];
        $prodact_image_folder = 'uploaded_img/' .$prodact_image;

        if(empty($prodact_name) || empty($prodact_image)){
            $massage[] = 'please fill out all';
        }else{
            $update = "UPDATE prodact SET name= '$prodact_name', image= '$prodact_image' 
            WHERE id = $id";
            $upload = mysqli_query($conn,$update);
            if($upload){
                move_uploaded_file($prodact_image_tmp_name, $prodact_image_folder);
                $massage[] = 'new prodact added successfully';
            }else{
                $massage[] = 'could not add the prodact';
            }
        }
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="prodact.css">
    <title>update page</title>
</head>
<body>
<?php
if(isset($massage)){
    foreach($massage as $massage){
        echo '<span class="massage">'.$massage. '</span>';
    }
}
?>

<div class="update">

    <?php
       $select = mysqli_query($conn, "SELECT * FROM prodact WHERE id = $id");
        while($row = mysqli_fetch_assoc($select)){

    ?>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <h3>Update the prodact</h3>
            <input type="text" name="prodact_name" placeholder="enter the prodact name" value= "<?php $row['name']; ?>">
            <input type="file" name="prodact_image" accept="image/*">
            <input type="submit" name="update_prodact" value="UPDATE PRODACT" class="btn">
            <a href="prodact.php" class="btn">go back</a>
        </form>
    <?php
        };
    ?>
    </div>
</body>
</html>