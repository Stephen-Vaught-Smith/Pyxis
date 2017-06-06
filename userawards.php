<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
die();
}
else{
  $loggedinuser=$_SESSION["username"];
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
      <script src="controllers/awardController.js"></script>
<script>
function addaward(){
  var awardname=$("#awardname").val();
  var awardemail=$("awardemail").val();
  var awardphone=$("#awardphone").val();

  $.ajax({
     type: "POST",
     url: "customphp/addawarduser.php",
    data: "awardname="+awardname+"&awardemail="+awardemail+"&awardphone="+awardphone,
     success: function(html){
          if(html==="added"){
                 window.location.href="userawards.php";
          }
          else if(html==="user"){
            window.location.href="usereditprofile.php";
          }
          else{
            console.log(html);
          }

     }
    });
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
        <li><a href="usereditprofile.php">Edit Profile</a></li>

        <li class="active"><a href="viewawards.php">Awards</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>







  <div class="container" ng-controller="awardController" ng-init="getRecords()">
      <div class="row">
          <div class="panel panel-default awards-content">
              <div class="panel-heading">Manage Awards <a href="javascript:void(0);" class="glyphicon glyphicon-plus" onclick="$('.formData').slideToggle();"></a></div>
              <div class="alert alert-danger none"><p></p></div>
              <div class="alert alert-success none"><p></p></div>
              <div class="panel-body none formData">
                  <form class="form" name="awardForm">
                      <div class="form-group">
                          <label>Name</label>
                          <input type="text" id="awardname" class="form-control" name="name" ng-model="tempAwardsData.name"/>
                      </div>
                      <div class="form-group">
                          <label>Email</label>
                          <input type="text" id="awardemail" class="form-control" name="email" ng-model="tempAwardsData.email"/>
                      </div>
                      <div class="form-group">
                          <label>Phone</label>
                          <input type="text" id="awardphone" class="form-control" name="phone" ng-model="tempAwardsData.phone"/>
                      </div>
                      <a href="javascript:void(0);" class="btn btn-warning" onclick="$('.formData').slideUp();">Cancel</a>
                      <a href="javascript:void(0);" class="btn btn-success" ng-hide="tempAwardsData.id" onclick="addaward();">Add Award</a>
                      <a href="javascript:void(0);" class="btn btn-success" ng-hide="!tempAwardsData.id" ng-click="updateAward()">Update Award</a>
                  </form>
              </div>
              <table class="table table-striped" id="myTable" style="display:none;">
                  <tr>
                      <th width="5%">#</th>
                      <th width="20%">Name</th>
                      <th width="30%">Email</th>
                      <th width="20%">Phone</th>
                      <th width="14%">Created</th>
                      <th width="10%"></th>
                  </tr>
                  <tr ng-repeat="award in awards | orderBy:'-created'">
                      <td>{{$index + 1}}</td>
                      <td>{{award.name}}</td>
                      <td>{{award.email}}</td>
                      <td>{{award.phone}}</td>
                      <td>{{award.created}}</td>
                      <td>
                          <a href="javascript:void(0);" class="glyphicon glyphicon-edit" ng-click="editAward(user)"></a>
                          <a href="javascript:void(0);" class="glyphicon glyphicon-trash" ng-click="deleteAward(user)"></a>
                      </td>
                  </tr>
              </table>
          </div>
      </div>
  </div>















  <div class="container">
  <table class="table table-striped">
      <tr class="header">
          <td>Id</td>
          <td>Name</td>
          <td>Email</td>
          <td>Phone</td>
          <td>Created</td>
          <td>Modified</td>
          <td>Status</td>
          <td>Created By</td>
      </tr>


  <?php
$servername = "oniddb.cws.oregonstate.edu";
$username = "leinings-db";
$password = "Q0u6N9bFIA8s672N";
$dbname = "leinings-db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM awards where createdby='$loggedinuser'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["email"]."</td>";
        echo "<td>".$row["phone"]."</td>";
        echo "<td>".$row["created"]."</td>";
        echo "<td>".$row["modified"]."</td>";
        echo "<td>".$row["status"]."</td>";
        echo "<td>".$row["createdby"]."</td>";

        echo "<td><a href='customphp/deleteaward.php?id=".$row['id']."'>x</a></td><tr>";

    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>

  </table>
</div>
    </body>
</html>
