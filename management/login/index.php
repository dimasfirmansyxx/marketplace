<?php include '../../core/functions.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<?php include '../components/head.php' ?>
</head>
<body class="hold-transition login-page">

	<div class="login-box">
	  <div class="login-logo">
	    <b>MANAGEMENT</b>
	  </div>
	  <!-- /.login-logo -->
	  <div class="login-box-body">
	  	<div class="alert alert-success" role="alert" style="display: none;" id="AlertLoginSuccess">
		  Login Success. Please Wait
		</div>
		<div class="alert alert-danger" role="alert" style="display: none;" id="AlertLoginFailed">
		  Login Failed. <span id="LblReason">Password didn't match</span>
		</div>
	    <p class="login-box-msg">Sign in to start your session</p>

	    <form action="" method="post" id="FormLogin">
	      <div class="form-group has-feedback">
	        <input type="text" class="form-control" name="username" placeholder="Username" id="TxtUsername">
	        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	        <input type="password" class="form-control" name="password" placeholder="Password" id="TxtPassword">
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>
          <button type="submit" class="btn btn-primary btn-block btn-flat" id="BtnLogin">Sign In</button>
	    </form>

	  </div>
	</div>
	
	<?php include '../components/script.php'; ?>
	<?php include 'login_script.php'; ?>
</body>
</html>