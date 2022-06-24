<?php
/**
 * Returns the list of sport.
 */
require 'connect.php';
    
$sport = [];
$sql = "SELECT id, model, price FROM sport";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $sport[$cr]['id']    = $row['id'];
    $sport[$cr]['model'] = $row['model'];
    $sport[$cr]['price'] = $row['price'];
    $cr++;
  }
    
  echo json_encode(['data'=>$sport]);
}
else
{
  http_response_code(404);
}