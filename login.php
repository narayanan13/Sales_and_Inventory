<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Sales & Inventory Management System</title>
 	

<?php include('./header.php'); ?>
<?php include('./db_connect.php'); ?>
<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['setting_'.$key] = $value;
		}
?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    background: gray;
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position:absolute;
		right:0;
		width:35%;
		height: calc(100%);
		/* background:white; */
		display: block;
		align-items: center;
	}
	#login-right .logo{
		width:42px;
		height:50px;	
		/* border-radius:10rem; */
		margin-top:3rem;
		margin-left:3.2rem;
	}
	img{
		border-radius:50rem;
		margin-left:0;
	}
	#login-left{
		position: fixed;
		left:0;
		width:65%;
		height: calc(100%);
		background-image: url("front_bg.jpg");
		background-size:50rem 50rem;
		background-repeat: no-repeat;
	}
	#login-right .card{
		margin-left:0;
		margin-top:15rem;
	}
	
.title{
	color: white;
	margin-top: 16rem;
	text-align: center;
}
.note{
	top: 5rem;
	text-align: center;
}
h3{
	text-align: center;
	text-decoration: underline;
}
</style>

<body>


  <main id="main" class=" bg-dark">
  		<div id="login-left">
  		</div>
  		<div id="login-right">
			<div class="logo">
				<img src="logo.png">
			</div>
  			<div class="card col-md-8">
  				<div class="card-body">
				  <h3>Login Here</h3><br><br>
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label">Username</label>
  							<input type="text" id="username" name="username" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label">Password</label>
  							<input type="password" id="password" name="password" class="form-control">
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
  					</form>
  				</div>
  			</div>
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger"> '+resp+'Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>