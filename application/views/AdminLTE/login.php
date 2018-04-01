<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
	<style>
	<!--
		.login-page {
		  background-attachment: fixed;
		  background-image: url(<?php echo base_url();?>assets/puskesmas.jpg);
		  background-repeat: no-repeat;
		  background-position: center center;
		}
	//-->
	</style>
	
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<a href="<?php echo site_url("");?>"><b>Simpus</b>ONLINE</a>
	</div>
	<!-- /.login-logo -->
	
	<div class="login-box-body">
		<p class="login-box-msg lead">
			<?php
			if($this->session->flashdata('response')){
				echo '<div class="alert alert-warning">'.$this->session->flashdata('response').'</div>';
			}else{
				echo 'Sign in to start your session';
			}
			?>
		</p>
		
		<form action="<?php echo base_url('dashboard'); ?>" method="post">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" name="username" placeholder="Username">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" name="password" placeholder="Password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<button type="submit" class="btn btn-primary btn-block btn-flat btn-lg">Sign In</button>
		</form>
		
		<hr>
		<p class="login-box-msg lead hide">
			<a href="<?php echo site_url("register");?>" class="text-center">Register a new membership</a>
		</p>

	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</body>
</html>
