<?php
$db = mysqli_connect('localhost','root','','ajax_demo');



$sql= "INSERT INTO students(first_name,last_name) VALUES ('{$first_name}','{$last_name}')";
//$result= mysqli_query($db,$sql) or die("SQL Query Failed");

if(mysqli_query($db,$sql)){
    echo 1;
}else{
    echo 0;
}

?>