<html>
<body>
<?php
$query=mysqli_connect("oniddb.cws.oregonstate.edu", "leinings-db", "Q0u6N9bFIA8s672N", "leinings-db");
if(isset($_GET['id']))
{
$id=$_GET['id'];
$query1=mysqli_query($query,"delete from awards where id='$id'");
if($query1)
{
header('location:../userawards.php');
}
}
?>
</body>
</html>
