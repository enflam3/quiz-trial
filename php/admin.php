<?php

//No security fast coding...

$username = $_POST['user'];
$password = $_POST['pass'];
$letmein = "no access";

if (isset($password) && $username === 'admin')
{
  $letmein = "no access";
  
  if ($password == "printful-trial")
  {
    $letmein = 'seems legit';
  }
  else
  {
    $letmein = "no access";
  }
}

echo $letmein;
$conn->close();