<?php
include 'DB.php';

//Turn off error reporting
ini_set('display_errors', 'On');

$db = new DB();

//Connects to the database
$mysqli = new mysqli($db->dbHost,$db->dbUsername,$db->dbPassword,$db->dbName);
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}


//select the image
if(!($stmt = $mysqli->prepare("SELECT Signature FROM user_signature WHERE UserID = ".$_GET['id'].";"))){
  echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
}
if(!$stmt->execute()){
  echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($image)){
  echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
$stmt->fetch();

header("Content-type: image/png");
if($image) {  
  echo $image;
  //echo file_get_contents("img_not_available.png");
} else {
  header("Content-type: image/png");
  echo file_get_contents("img_not_available.png");
}

?>
