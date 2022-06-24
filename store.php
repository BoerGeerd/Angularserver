<?php
require 'connect.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
	

  // Validate.
  if(trim($request->data->model) === '' ||  (int)$request->data->price < 1)
  {
    return http_response_code(400);
  }
	
  // Sanitize.
  $model = mysqli_real_escape_string($con, trim($request->data->model));
  $merk = mysqli_real_escape_string($con, trim($request->data->merk));
  $price = mysqli_real_escape_string($con, (int)$request->data->price);
    

  // Store.
  $sql = "INSERT INTO `sport`(`id`,`model`,`price`, 'merk') VALUES (null,'{$model}','{$price}','{$merk}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $sport = [
      'model' => $model,
      'price' => $price,
      'id'    => mysqli_insert_id($con),
      'merk'  => $merk,
    ];
    echo json_encode(['data'=>$sport]);
  }
  else
  {
    http_response_code(422);
  }
}