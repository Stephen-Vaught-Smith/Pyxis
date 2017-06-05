<?php
session_start();
if(isset($_SESSION["username"])){
  header("Location: index.php");
die();
}
?>

<!doctype HTML>
<html lang="en" data-ng-app="app" ng-controller="AppCtrl">
<head>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
  <script src="signature.js"></script>
  <script src="app.js"></script>
  <link rel="stylesheet" href="3rdParty/css/style.css">
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/custom.js"></script>


<style>
.container .signature {
            border: 1px solid orange;
            margin: 0 auto;
            cursor: pointer;
          }

          .container .signature canvas {
            border: 1px solid #999;
            margin: 0 auto;
            cursor: pointer;
          }

          .container .buttons {
            position: relative;
            bottom: 10px;
            left: 10px;
          }

          .container .sizes {
            position: absolute;
            bottom: 10px;
            right: 10px;
          }

          .container .sizes input {
            width: 4em;
            text-align: center;
          }

          .result {
            border: 1px solid blue;
            margin: 30px auto 0 auto;
            height: 300px;
            width: 490px;
          }
</style>
  <script>
  function login(){
    var username=$("#username").val();
    var password=$("#password").val();


    $.ajax({
		   type: "POST",
		   url: "customphp/login.php",
			data: "username="+username+"&password="+password,
		   success: function(html){
			      if(html=="Invalid Login Credentials."){
					$("#success").show();
            }
            else if(html=="True"){
              window.location.href="profileEdit.php";
            }
            else{
              console.log(html);
            }

		   }
		  });




  }
  </script>


  <script>
  function register(){

  var username=$("#usernamereg").val();
  var email=$("#emailreg").val();
  var password=$("#passwordreg").val();
  var confpassword=$("#confirm-passwordreg").val();
 var image=$("#imagepath").prop('src');
 if($("#admincheck").is(':checked')){
   var admin="admin";
 }
 else{
   var admin="user";
 }
var form=$("#register-form");

  if(password!=confpassword){

	$("#match").show("slow");


  }
 else{

       $.ajax({
		   type: "POST",
		   url: "customphp/register.php",



			data: "username="+username+"&password="+password+"&email="+email+"&image="+image+"&admin="+admin,
      //data:"{'username':'"+username+"','email':'"+email+"','password':'"+password+"','image':'"+image+"'}",
		   success: function(response){
			      if(response==="New User Added"){
					$("#useradded").show("slow");
            }
            else {
              $("#useradded").html(response);
			  $("#useradded").show("slow");
            }


		   }
		  });




 }
  }
  </script>
  <script>
  function forgetpass(){
    var foremail=$("#foremail").val();
    $.ajax({
       type: "POST",
       url: "customphp/forgot.php",
      data: "foremail="+foremail,
       success: function(html){
            $("#forpass").show("slow");


       }
      });
  }
  </script>
</head>
<body>

  <div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form"  method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input onclick="login();" type="button" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>

									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="" tabindex="5" class="forgot-password" data-toggle="modal" data-target="#myModal" onclick="forgetpass();">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
                  <div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<div id="success">Invalid Username Or Password</div>
												</div>
											</div>
										</div>
									</div>
								</form>

								<form id="register-form"  method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="usernamereg" id="usernamereg" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="email" name="emailreg" id="emailreg" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="passwordreg" id="passwordreg" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-passwordreg" id="confirm-passwordreg" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
                  <div class="form-group">
										Sign Up As Admin?<input type="checkbox" id="admincheck" name="vehicle" value="yes">Yes<br>
									</div>
                  <div class="container" ng-style="{'max-width': boundingBox.width + 'px', 'max-height': boundingBox.height + 'px'}">
                      <signature-pad accept="accept" clear="clear" height="220" width="568" dataurl="dataurl"></signature-pad>

                      <div class="buttons">
                          <button ng-click="clear()">Clear</button>
                          <button ng-click="dataurl = signature.dataUrl" ng-disabled="!signature">Reset</button>
                          <button ng-click="signature = accept()">Sign</button>
                      </div>

                  </div>

                  <div class="result" ng-show="signature">
                      <img id="imagepath" name="imagepath" ng-src="{{ signature.dataUrl }}">
                  </div>


									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="button" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now" onclick="register();">
											</div>
										</div>
									</div>

									<div id="match" style="text-align:center;color:red;display:none;">Password And Confirm Passwords Do Not Match</div>
									<div id="useradded" style="text-align:center;color:red;display:none;">User Succesfully Added. Please Login.</div>
								</form>
							</div>



              <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Forgot Password</h4>
      </div>
      <div class="modal-body">

          <div class="col-md-6">
        <p>Please Enter Your Email Address</p>
      </div>
      <div class="col-md-6">
        <input type="text" id="foremail">
      </div>

    </div>
    <div class="col-md-12" style="display:none;" id="forpass">Please Check Your Email Inbox For The Password. Thank you.</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="">Send Password</button>
      </div>
    </div>

  </div>
</div>






						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
