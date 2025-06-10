<?php


if(isset($_POST['uploadfilebutton'])){
    $db = mysqli_connect('localhost','root','','product');
    if($db){
        echo "connectd to datbase";
    }


    $filename = $_FILES['uploadfile']['name'];
    $tmpname = $_FILES['uploadfile']['tmp_name'];



    echo $filename;
    echo $tmpname;

    $folder = 'uploads/';

    move_uploaded_file($tmpname,$folder.$filename);


    $sql = "INSERT INTO products (product_image) VALUES('$filename') ";

    $query= mysqli_query($db,$sql);

    if($query){
        echo "<br>Image uploaded to database";
    }

}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image upload using MYsqil</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="uploadfile">
    <input type="submit" value="upload" name="uploadfilebutton">
</form>
</body>
</html>