<?php
session_start();
$curruser=$_SESSION['username'];
$servername = "oniddb.cws.oregonstate.edu";
$username = "leinings-db";
$password = "Q0u6N9bFIA8s672N";
$dbname = "leinings-db";
$awardname=$_POST["awardname"];
$awardemail=$_POST["awardemail"];
$awardphone=$_POST["awardphone"];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$current = date("Y-m-d H:i:s");

$sql = "INSERT INTO awards (name, email, phone,created,modified,status,createdby)
VALUES ('$awardname', '$awardemail', '$awardphone','$current','$current',1,'$curruser')";

if (mysqli_query($conn, $sql)) {
    echo "added";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
