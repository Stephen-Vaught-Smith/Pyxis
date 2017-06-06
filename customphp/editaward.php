
<html>
<script src="https://code.jquery.com/jquery-3.2.1.min.js">

</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<body>



  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Pyxis</a>
      </div>
      <ul class="nav navbar-nav pull-right">
        <li><a href="usereditprofile.php">Edit Profile</a></li>

        <li class="active"><a href="viewawards.php">Awards</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>

<div class="container">

<?php
$query=mysqli_connect("oniddb.cws.oregonstate.edu", "leinings-db", "Q0u6N9bFIA8s672N", "leinings-db");
if(isset($_GET['id']))
{
$id=$_GET['id'];
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$email=$_POST['email'];
$current = date("Y-m-d H:i:s");
$query3=mysqli_query($query,"update awards set name='$name', email='$email',modified='$current' where id='$id'");
if($query3)
{
header('location:../userawards.php');
}
}
$query1=mysqli_query($query,"select * from awards where id='$id'");
$query2=mysqli_fetch_array($query1);
?>
<form method="post" action="">
  <div class="form-group">
  <label for="name">Name:
</label>
<input type="text" name="name" value="<?php echo $query2['name']; ?>" /><br />
</div>
<div class="form-group">
  <label for="age">Email:
  </label><input type="text" name="email" value="<?php echo $query2['email']; ?>" /><br /><br /></div>
<br />
<input type="submit" name="submit" value="update" />
</form>
<?php
}
?>


</div>
</body>
</html>
