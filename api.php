<?php
header("Access-Control-Allow-Origin: *");              // Allow all domains (for testing; restrict in production)
header("Content-Type: application/json");              // Return data as JSON
header("Access-Control-Allow-Methods:POST"); // Allow REST methods
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

error_reporting(0);
$data=json_decode(file_get_contents("php://input"));//json-decode convert string into array
include('db.php');

$id = $_POST["id"];
if($db){
   $sql= "select * from products WHERE id='$id';";

    $result=mysqli_query($db,$sql);
    if($result){

            $i=0;
            while($row=mysqli_fetch_assoc($result)){
                $response[$i]['id'] = $row ['id'];
                $response[$i]['product_name'] = $row ['product_name'];
                $response[$i]['product_price'] = $row ['product_price'];
                $response[$i]['stock'] = $row ['stock'];
                $response[$i]['discount'] = $row ['discount'];
                $i++;        
            }
        echo json_encode($response,JSON_PRETTY_PRINT);
    }
}
else{
    echo "Database connection failed";
}
?>