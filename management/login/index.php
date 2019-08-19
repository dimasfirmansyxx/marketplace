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
	    <p class="login-box-msg">Sign in to start your session</p>

	    <form action="../../index2.html" method="post">
	      <div class="form-group has-feedback">
	        <input type="email" class="form-control" placeholder="Email">
	        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	        <input type="password" class="form-control" placeholder="Password">
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
	    </form>

	  </div>
	</div>
	
	<?php include '../components/script.php'; ?>
</body>
</html>