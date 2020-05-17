<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
		session_start();
		include ('connectDB.php');
		if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['register'])) ) {
			header("Location: register.php");
		}
		if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['withoutLog'])) ) {
			header("Location: noLogin.php");
		}
		if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['signIn']))) {
			$email = $_POST['email'];
			$pass = $_POST['password'];
			$pass = sha1($pass);
			
			$sql = "SELECT id, email FROM user WHERE email='$email' AND password='$pass'";
			$result = $linkDB->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$_SESSION["id"] = $row["id"];
				$user_id = $_SESSION["id"];
                $_SESSION["email"] = $email;
				header("Location: home.php");
            }  
			else{
				echo "<script> alert('wrong email adrress or password') </script>";
			}
			

		}
		
	?>
    <script>
    function ValidateEmail(mail1){
      var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            
      if (!filter.test(mail1)) {
          alert('Please provide a valid email address');
          mail1.focus;
          return false;
      }
      return true;
    }  
    function SumbitValidation(){
      var password = document.getElementById('password');
      var email = document.getElementById('email');
      var mailCheck = ValidateEmail(email.value);
      if(mailCheck != true && email.value && password.value == ""){
        alert("give your email address and your password.")
      }
    }
    </script>
    <title>UotA Social Community</title>
    <link rel="icon" href="images/logo.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
	  <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
	
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  	<!--Background img: -->
  	<link href="css/full.css" rel="stylesheet">
  </head>

  <body>
	
    <div class="container">
		<header>
        <h1>University of the Aegean <span>Social Community</span></h1>
				<a href="index.php"><img id="logo" class="center-block"  src = "images/logo.png"></a>
				<h1>Log <span>in</span></h1> 
				
		</header>
		
		<form action="index.php" method="post">
			<label for="inputEmail" class="sr-only">Email address</label>
			<input type="email" name="email"id="email" class="form-control" placeholder="Email address" autofocus>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" name="password" id="password" class="form-control" placeholder="Password">
			</br>
			  <div class="row">
					<div class="col-sm-4">
						<button name="signIn"class="btn btn-lg btn-primary btn-block" type="submit" onclick="SumbitValidation()">Sign in</button>
					</div>
					<div class="col-sm-4">
						<a href="register.php"><button name="register"class="btn btn-lg btn-primary btn-block" type="submit">Register</button></a>
					</div>
				<div class="col-sm-4"></div><div class="col-sm-4"></div><div class="col-sm-4"></div><div class="col-sm-4"></div>
				<div class="col-sm-4">
				  <a href="aegeanCommunity.html"><button name="withoutLog" class="btn btn-lg btn-primary btn-block" type="submit">Continue without Login</button></a>
				</div>
			  </div>
		  </form>

     

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
