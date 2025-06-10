<?php
header("Access-Control-Allow-Origin: *");              // Allow all domains (for testing; restrict in production)
header("Content-Type: application/json");              // Return data as JSON
header("Access-Control-Allow-Methods:PUT"); // Allow REST methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

error_reporting(0);
$data=json_decode(file_get_contents("php://input"));//json-decode convert string into array
include('db.php');
if($data->id){
    $query2= "SELECT * FROM products WHERE id=".$data->id;
    $run2=mysqli_query($db,$query2);
    $product=mysqli_fetch_assoc($run2);

    $product_name=$product['product_name'];
    $product_price=$product['product_price'];    
    $stock=$product['stock'];
    $discount=$product['discount'];



    if($data->discount!=''){
       $discount=$data->discount;
    }

    if($data->product_name!=''){
        $product_name=$data->product_name;
    }
    if($data->product_price!=''){
      $product_price=$data->product_price;
    }

    if($data->stock!=''){
       $stock=$data->stock;
    }

    $query="UPDATE products SET ";
    $query.="product_name='$product_name',";
    $query.="product_price=$product_price,";
    $query.="stock=$stock,";
    $query.="discount=$discount WHERE id=".$data->id;
     
    $run=mysqli_query($db,$query);
    
    if($run){
        echo json_encode(['Stauts'=>'Success','msg'=>'Product Updated !']);
    
    }
    else{
        echo json_encode(['Stauts'=>'Fail','msg'=>'Product  Not Updated !']);
    }



} else{
    echo json_encode(['Stauts'=>'Failed','msg'=>'product id is not given']);

 }

   

?>