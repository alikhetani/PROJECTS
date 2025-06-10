<?php

include('db.php');
$sql = "SELECT * FROM `products`";
$result= $db->query($sql);
$data = array();

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }
}
echo json_encode($data);
$db->close();
?>
  