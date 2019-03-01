<?php

//No security fast coding...

$username = $_POST['user'];
$password = $_POST['pass'];
$letmein = "no access";

if (isset($password) && $username === 'admin')
{
  $letmein = "no access";
  
  if ($password == "XXX")
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
