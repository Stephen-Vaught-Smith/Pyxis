<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
die();
}
else{
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pyxis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username, email, password FROM myusers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$username=$row["username"];
		$email=$row["email"];
		$password=$row["password"];

    }
} else {
    echo "0 results";
}
$conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <script src="3rdParty/js/jquery-3.2.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="3rdParty/css/style.css">
  <link rel="stylesheet" href="3rdParty/css/style.css" type="text/css"/>
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/custom.js"></script>
<script>
function showpass(){
  $("#password").prop("type", "text");
  $("#newpass").prop("type", "text");
  $("#conpass").prop("type", "text");



}
function update(){
  var username=$("#username").val();
  var email=$("#email").val();
  var password=$("#password").val();
  var newpass=$("#newpass").val();
  var conpass=$("#conpass").val();
  if(newpass===conpass){
    $.ajax({
    type: "POST",
    url: "customphp/profileedit.php",
   data: "username="+username+"&password="+newpass,
    success: function(response){
         if(response==="Record updated successfully"){
       $("#userupdated").show("slow");
         }
         else {
           $("#userupdated").html(response);
     $("#userupdated").show("slow");
         }


    }
   });
  }
  else{
    $("#passmatcherror").show("slow");
  }
}
</script>
</head>

<body>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Pyxis</a>
    </div>
    <ul class="nav navbar-nav pull-right">
      <li class="active"><a href="profileEdit.php">Edit Profile</a></li>
      <li><a href="index.php">Users</a></li>
      <li><a href="viewawards.php">Awards</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>


	<div class="container">
  <h1 class="page-header">Edit Profile</h1>
  <div class="row">
    <!-- left column -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
        <img src="images/gravatar.png" class="avatar img-circle img-thumbnail" alt="avatar">
      </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
      <h3>Personal info</h3>
      <form class="form-horizontal" role="form">
        <div class="form-group">
          <label class="col-lg-3 control-label">Username:</label>
          <div class="col-lg-8">
            <input disabled id="username" class="form-control" value="<?php echo $username; ?>" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Email:</label>
          <div class="col-lg-8">
            <input disabled id="email" class="form-control" value="<?php echo $email;?>" type="email">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Old Password:</label>
          <div class="col-lg-8">
            <input id="password" class="form-control" value="<?php echo $password;?>" type="password">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">New Password:</label>
          <div class="col-lg-8">
            <input id="newpass" class="form-control" value="" type="password" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label">Confirm New Password:</label>
          <div class="col-md-8">
            <input id="conpass" class="form-control" value="" type="password" required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <input class="btn btn-primary" value="Save Changes" type="button" onclick="();">
            <span></span>
            <input class="btn btn-default" value="Cancel" type="reset">
            <span></span>
            <input class="btn btn-primary" value="Show Password" type="button" onclick="showpass();return false;">
          </div>
        </div>
        <div id="passmatcherror" style="display:none;text-align:center;color:red;">New Password And Confirm Password Do Not Match</div>
        <div id="userupdated" style="display:none;text-align:center;color:red;">User Successfully Updated</div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
