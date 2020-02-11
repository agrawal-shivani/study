<?php
include "controller/master.php";
session_start();
$login = new master();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>sales managements</title>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="csslogin/animate.css">
  	<link rel="stylesheet" href="csslogin/login.css">
</head>
<body class="login">
	<section id="form-h" class="login-box animated fadeInUp">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						<form action="" method="post">
						    <div class="card-block">
						        <div class="form-header  purple darken-4">
						            <h3><i class="fa fa-lock"></i> Login:</h3>
						        </div>
						        <div class="md-form">
						            <i class="fa fa-envelope prefix"></i>
						            <input type="text" id="form2" class="form-control" name="userName" placeholder="EmailId">
						            <!-- <label for="form2">Your email</label> -->
						        </div>
						        <div class="md-form">
						            <i class="fa fa-lock prefix"></i>
						            <input type="password" id="form4" class="form-control" name="password" placeholder="password">
						            <!-- <label for="form4">Your password</label> -->
						        </div>
						        <div class="text-center">
						           <button class="btn btn-deep-purple" name="submit" type="submit">log in</button>
						        </div>
						    </div>
					    </form>	    
					</div>
				</div>
			</div>
		</div>
	</section>	
</body>
</html>


<?php
  if(isset($_POST['submit']))
  {
     // print_r($_POST);
     $EmailId=$_POST['userName'];
     $password=$_POST['password'];
     
      $status=$login->logIn($EmailId,$password);
      // echo $status;
      if ($status==true) 
      {
      	 $_SESSION['usrnme']=$EmailId;
      	 $_SESSION['psswrd']=$password;
      	 header('location:admin/index.php');

      }
  }





?>