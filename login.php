<?php
session_start();
if(isset($_SESSION["username"])){
  header("Location: index.php");
die();
}
?>

<!doctype HTML>
<html>
<head>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="3rdParty/css/style.css">
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/custom.js"></script>



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

  if(password!=confpassword){

	$("#match").show("slow");


  }
 else{
       $.ajax({
		   type: "POST",
		   url: "customphp/register.php",
			data: "username="+username+"&password="+password+"&email="+email,
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
													<a href="" tabindex="5" class="forgot-password">Forgot Password?</a>
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
										<input type="text" name="username" id="usernamereg" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="emailreg" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="passwordreg" id="passwordreg" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-passwordreg" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="button" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now" onclick="register();">
											</div>
										</div>
									</div>
									<div id="match" style="text-align:center;color:red;display:none;">Password And Confirm Passwords Do Not Match</div>
									<div id="useradded" style="text-align:center;color:red;display:none;">User Succesfully Added.Plese Login</div>
								</form>
							</div>






						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
