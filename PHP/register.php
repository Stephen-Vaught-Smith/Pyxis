<?php  

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




$username = $_POST['username'];
$password = $_POST['password'];
$email=$_POST['email'];

$sql = "INSERT into myusers (username,password,email) values ('$username','$password','$email')";

if (mysqli_query($conn, $sql)) {
    echo "New User Added";
} else {
    echo "Undefined Error";
}

mysqli_close($conn);

?>
