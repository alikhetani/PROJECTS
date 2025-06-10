<?php
header("Access-Control-Allow-Origin: *");              // Allow all domains (for testing; restrict in production)
header("Content-Type: application/json");              // Return data as JSON
header("Access-Control-Allow-Methods:POST"); // Allow REST methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

error_reporting(0);
$data=json_decode(file_get_contents("php://input"));//json-decode convert string into array
include('db.php');


    $query= "INSERT INTO products(product_name, product_price, stock, discount)VALUES('.$data->product_name.','$data->product_price',$data->stock,$data->discount)";
    $run=mysqli_query($db,$query);
    
    if($run){
        echo json_encode(['Stauts'=>'Success','msg'=>'Product Added !']);
    
    }
    else{
        echo json_encode(['Stauts'=>'Fail','msg'=>'Product  Not Added !']);
    }


?>