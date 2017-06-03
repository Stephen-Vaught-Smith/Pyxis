<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
die();
}
else{
 $pass=$_POST["password"];
 $user=$_POST["username"];
  $servername = "oniddb.cws.oregonstate.edu";
  $username = "leinings-db";
  $password = "Q0u6N9bFIA8s672N";
  $dbname = "leinings-db";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $sql = "UPDATE myusers SET password='$pass' WHERE username='$user'";

  if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $conn->error;
  }

  $conn->close();


}


 ?>
