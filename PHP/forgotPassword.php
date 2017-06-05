<?php
$servername = "oniddb.cws.oregonstate.edu";
$username = "leinings-db";
$password = "Q0u6N9bFIA8s672N";
$dbname = "leinings-db";
$foremail=$_POST["foremail"];


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT password FROM myusers where email='$foremail'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $to = 'bob@example.com';

      $subject = 'Password Reset Request';

      $headers = "From: " . strip_tags($_POST['req-email']) . "\r\n";
      $headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
      $headers .= "CC: susan@example.com\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      $message = '<html><body>';
      $message .= "<h1>Your Password Is ".$row["password"]."</h1>";
      $message .= '</body></html>';
      mail($foremail, $subject, $message, $headers);
      echo $row["password"];








    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
