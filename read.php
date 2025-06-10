<?php
header("Access-Control-Allow-Origin: *");              // Allow all domains (for testing; restrict in production)
header("Content-Type: application/json");              // Return data as JSON
header("Access-Control-Allow-Methods:GET"); // Allow REST methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

error_reporting(0);
$data=json_decode(file_get_contents("php://input"));//json-decode convert string into array
include('db.php');
$query= "SELECT * FROM products";

if(isset($_GET['id'])){
    $query= "SELECT * FROM products WHERE id=".$_GET['id'];
}

    
    $run=mysqli_query($db,$query);
    $products=mysqli_fetch_all($run,MYSQLI_ASSOC);

    echo json_encode($products);


?>