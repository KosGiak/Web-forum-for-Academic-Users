<html lang="en" class="no-js"> <!--<![endif]-->
    <head>
	
	<?php
		session_start();
		include ('connectDB.php');
		if ($_SERVER['REQUEST_METHOD'] == "POST") {
			
			
					$username = mysqli_real_escape_string($linkDB, $_POST['username']);
					$email1 = mysqli_real_escape_string($linkDB, $_POST['mail1']);
					$email2 = mysqli_real_escape_string($linkDB, $_POST['mail2']);
					$pass1 = mysqli_real_escape_string($linkDB, $_POST['pass1']);
					$pass2 = mysqli_real_escape_string($linkDB, $_POST['pass2']);
					
					
					//check mail:
					$filter = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/";
					if($email1!=$email2 && !filter_var($email, FILTER_VALIDATE_EMAIL)){
						header("Location: register.php");
						echo "<script> alert('wrong email adrress') </script>";
						return;
					}
					//check password:
					if (strlen($pass1) < 8 || preg_match($filter, $pass1)) {
						//header("Location: register.php");
						
						return;
					}
					//check for unique username, email:
                    $sql = "SELECT * FROM user WHERE username = '$username'";
					$result = $linkDB->query($sql);
					$sql1 = "SELECT * FROM user WHERE email = '$email1'";
					$result1 = $linkDB->query($sql1);
					//echo $result->num_rows;
                    
                    if ($result->num_rows>0 || $result1->num_rows> 0) {
						echo "<script> alert('This username or email already exist ') </script>";
                    }  
					if($pass1 != $pass2){
						echo "<script> alert('incorect password') </script>";
					}
					else{
						$pass1 = sha1($pass1);
						$pass2 = sha1($pass2);
						$_SESSION['username'] = $username;
						$_SESSION['email1'] = $email1;
						$_SESSION['pass1'] = $pass1;
						header("Location: WelcomeAboard.php");
					}
					/*else{
						$pass = sha1($pass1);
						mysqli_query($linkDB, "INSERT INTO users (username, email, password) VALUES ('$username', '$email1', '$pass')");
						$registered = mysqli_affected_rows($linkDB);
						//echo $registered."welcome";
						header("Location: WelcomeAboard.php");
					}*/
					//echo "<script> alert('your username is: ') </script>", $username;
					
					
			
		}
	?>
        <script>
            function checkMail(){
                //Store the password field objects into variables ...
                var mail1 = document.getElementById('mail1');
                var mail2 = document.getElementById('mail2');
                //Set the colors we will be using ...
                var goodColor = "#66cc66";
                var badColor = "#ff6666";
                //Compare the values in the password field 
                //and the confirmation field
                if(mail1.value == mail2.value){
                    //The passwords match. 
                    //Set the color to the good color and inform
                    //the user that they have entered the correct password 
                    mail2.style.backgroundColor = goodColor;
                    }else{
                    //The passwords do not match.
                    //Set the color to the bad color and
                    //notify the user.
                    mail2.style.backgroundColor = badColor;
                }
            }  
            function checkPass(){
                //Store the password field objects into variables ...
                var pass1 = document.getElementById('pass1');
                var pass2 = document.getElementById('pass2');
                //Set the colors we will be using ...
                var goodColor = "#66cc66";
                var badColor = "#ff6666";
                //Compare the values in the password field 
                //and the confirmation field
                if(pass1.value == pass2.value){
                    //The passwords match. 
                    //Set the color to the good color and inform
                    //the user that they have entered the correct password 
                    pass2.style.backgroundColor = goodColor;
                }else{
                    //The passwords do not match.
                    //Set the color to the bad color and
                    //notify the user.
                    pass2.style.backgroundColor = badColor;
                }
            }  

            function SubmitValidation(){
                 var pass1 = document.getElementById('pass1');
                 var pass2 = document.getElementById('pass2');
                 var mail1 = document.getElementById('mail1');
                 var mail2 = document.getElementById('mail2');
                 var mailCheck = ValidateEmail(mail1.value);
                 var checkPass = ValidatePassword(pass1.value);
                 if(checkPass == true && mailCheck == true && pass1.value == pass2.value && mail1.value == mail2.value && pass1.value != "" && mail1.value != ""){
					 return true;
                     //window.open("WelcomeAboard.php", "_self");
                      //alert("Welcome aboard!!! Validate your account from your email.");
                 }
				 return false;
             }
            function ValidateEmail(mail1){
                var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            
                if (!filter.test(mail1)) {
                    alert('Please provide a valid email address');
                    mail1.focus;
                    return false;
                }
                return true;
            } 
            
            function ValidatePassword(pass1){
                var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{8,}$/;
                if (!regex.test(pass1)) {
                    alert("Minimum 8 characters at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special");
                    pass1.focus;
                    return false;
                } else {
                    return true;
                }
            }
        </script>
        <title>UotA Social Community</title>
        <link rel="icon" href="images/logo.png">
		<meta charset="UTF-8" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </head>
	
	<body>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">

                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
            <header>
                <h1>University of the Aegean <span>Social Community</span> </h1>
				<a href="index.php"><img id="logo" class="center-block"  src = "images/logo.png"></a>
            </header>
			<form action="register.php" method="post">
				<label for="inputEmail" class="sr-only">Username</label>
				<input name="username" id="username" type="username" class="form-control" placeholder="username" required autofocus>
				<label for="inputEmail" class="sr-only">Email address</label>
				<input name="mail1" id="mail1" type="email" class="form-control" placeholder="Email address">
				<label for="inputEmail" class="sr-only">Confirm your email address</label>
				<input name="mail2" id="mail2" type="email" onkeyup="checkMail(); return false;" class="form-control" placeholder="Confirm your email address" required>
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" name="pass1" id="pass1" class="form-control" placeholder="Password" required>
				<label for="inputPassword" class="sr-only">Confirm your password</label>
				<input type="password" name="pass2"id="pass2" onkeyup="checkPass(); return false;" class="form-control" placeholder="Confirm your password" required>
				<div class="row">
				</br>
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<button type="submit" class="btn btn-lg btn-primary btn-block" value="change Location" onclick="SubmitValidation()">Sign Up</button>
					</div>
				</div>
			</form>
        </div>
	</body>
	
	
</html>