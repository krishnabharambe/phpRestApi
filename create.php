<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);


  // Validate.
  if(trim($request->fullname) === ''||trim($request->nickname) === ''||trim($request->address) === ''||trim($request->dob) === ''||trim($request->gender) === ''||trim($request->email) === ''||trim($request->username) === ''||trim($request->password) === '' )
  {
    return http_response_code(400);
  }

  // Sanitize.
  $fullname = mysqli_real_escape_string($con, trim($request->fullname));
  $nickname = mysqli_real_escape_string($con, trim($request->nickname));
  $address = mysqli_real_escape_string($con, trim($request->address));
  $dob = mysqli_real_escape_string($con, trim($request->dob));
  $gender = mysqli_real_escape_string($con, trim($request->gender));
  $email = mysqli_real_escape_string($con, trim($request->email));
  $username = mysqli_real_escape_string($con, trim($request->username));
  $password = mysqli_real_escape_string($con, trim($request->password));
  $workexp = mysqli_real_escape_string($con, $request->workexp);


  // Create.
  $sql = "INSERT INTO `usermanager` (`id`,`fullname`,`nickname`,`address`,`dob`,`gender`,`workexp`,`email`,`username`,`password`) 
  VALUES (null,'{$fullname}','{$nickname}','{$address}','{$dob}','{$gender}','{$workexp}','{$email}','{$username}','{$password}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $policy = [
      'fullname' => $fullname,
      'nickname' => $nickname,
      'address' => $address,
      'dob' => $dob,
      'gender' => $gender,
      'workexp' => $workexp,
      'email' => $email,
      'username' => $username,
      'password' => $password,
      'id'    => mysqli_insert_id($con)
    ];
    echo json_encode($policy);
  }
  else
  {
    http_response_code(422);
  }
}