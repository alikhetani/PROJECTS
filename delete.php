<?php
header("Access-Control-Allow-Origin: *");              // Allow all domains (for testing; restrict in production)
header("Content-Type: application/json");              // Return data as JSON
header("Access-Control-Allow-Methods:DELETE"); // Allow REST methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

error_reporting(0);
$data=json_decode(file_get_contents("php://input"));//json-decode convert string into array
include('db.php');
if($data->id){
    
    $query="DELETE FROM products WHERE id=".$data->id;
   
    $run=mysqli_query($db,$query);
    
    if($run){
        echo json_encode(['Stauts'=>'Success','msg'=>'Product Deleted !']);
    
    }
    else{
        echo json_encode(['Stauts'=>'Fail','msg'=>'Product  Not Deleted !']);
    }


} else{
    echo json_encode(['Stauts'=>'Failed','msg'=>'product id is not given']);

 }

   

?>