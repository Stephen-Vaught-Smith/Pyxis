<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Awards</title>

    <link rel="stylesheet" href="3rdParty/css/style.css" type="text/css"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

    <script src="3rdParty/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>

    <script src="app.js"></script>
    <script src="controllers/awardController.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/corejs-typeahead/1.1.1/typeahead.jquery.min.js"></script>
    <script>
    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
    </script>

</head>

<body ng-app="Recognize">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Pyxis</a>
    </div>
    <ul class="nav navbar-nav pull-right">
      <li><a href="profileEdit.php">Edit Profile</a></li>
      <li><a href="index.php">Users</a></li>
      <li class="active"><a href="viewawards.php">Awards</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>



<div class="container">
<div class="col-md-12">
Enter A Keyword To Search Awards <input type="text" id="myInput" onkeyup="myFunction()">
</div>
</div>
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
                        <input type="text" class="form-control" name="name" ng-model="tempAwardsData.name"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" ng-model="tempAwardsData.email"/>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" ng-model="tempAwardsData.phone"/>
                    </div>
                    <a href="javascript:void(0);" class="btn btn-warning" onclick="$('.formData').slideUp();">Cancel</a>
                    <a href="javascript:void(0);" class="btn btn-success" ng-hide="tempAwardsData.id" ng-click="addAward()">Add Award</a>
                    <a href="javascript:void(0);" class="btn btn-success" ng-hide="!tempAwardsData.id" ng-click="updateAward()">Update Award</a>
                </form>
            </div>
            <table class="table table-striped" id="myTable">
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




</body>
</html>
