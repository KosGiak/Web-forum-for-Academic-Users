<html lang="en" class="no-js"> <!--<![endif]-->
    <head>
		<?php
			session_start();
			include ('connectDB.php');
			if(!isset($_SESSION['username'])){
				echo "<script> alert('Seomthing is wrong with your registation. Try again later :(  ') </script>";

			}else{

				//echo $_SESSION['username'], $_SESSION['email1'], $_SESSION['pass1'];
				if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['LinkedID'])) ) {
					header("Location: register.php");
				}

				if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['Submit']))) {
					$username = $_SESSION['username'];
					$email = $_SESSION['email1'];
					$password = $_SESSION['pass1'];
					$Name = mysqli_real_escape_string($linkDB, $_POST['name']);
					$Surname = mysqli_real_escape_string($linkDB, $_POST['Surname']);
					$National = mysqli_real_escape_string($linkDB, $_POST['National']);
					$City = mysqli_real_escape_string($linkDB, $_POST['City']);
					$Avatar = mysqli_real_escape_string($linkDB, $_POST['avatar']);
					$Position = mysqli_real_escape_string($linkDB, $_POST['Position']);
					$Company = mysqli_real_escape_string($linkDB, $_POST['Company']);
					$Language1 = mysqli_real_escape_string($linkDB, $_POST['Language1']);
					$Language2 = mysqli_real_escape_string($linkDB, $_POST['Language2']);
					$Language3 = mysqli_real_escape_string($linkDB, $_POST['Language3']);
					
					
					
					
					$Gender=null; $Expertise=null; $BusinessP1=null; $BusinessP2=null; $BusinessP3=null; $Job=null;
					$Studies1=null; $Studies2=null; $Studies3=null;
					$Lang1=null; $Lang2=null; $Lang3=null;
					$Cert1=null; $Cert2=null; $Cert3=null;
					if(isset($_POST['CheckBox'])) {
						$box = $_POST['CheckBox'];
						foreach ($box as $value){
							//echo $value."<br />";
							if($value=='Male' || $value == 'Female'){
								$Gender = $value;
							}	     	      
							else if($value=='Environment' || $value=='SocialAdministration' || $value=='Arts' || $value=='Science' || $value=='Humanities'|| $value=='Agriculture' || $value=='Stock Raising'){
								$Expertise = $value;
							}
							else if($value=='Manager' || $value=='Academic' || $value=='Chief' || $value=='Self Employee' || $value=='Unemployed'){
								if(empty($BusinessP1)){
									$BusinessP1 = $value;
								}
								else if(empty($BusinessP2)){
									$BusinessP2 = $value;
								}
								else{
									$BusinessP3 = $value;
								}
								
							}
							else if($value=='Civil Servant' || $value=='Multinational Company' || $value=='Middle-class Business' || $value=='Small or Personal Business' || $value=='Non-Governmental Organization'){
								$Job=$value;
							}
							else if($value=='Technological Educational Institute' || $value=='University Degree' || $value=='Master' || $value=='PhD'){
								if(empty($Studies1)){
									$Studies1 = $value;
								}
								else if(empty($Studies2)){
									$Studies2 = $value;
								}
								else{
									$Studies3 = $value;
								}
							}
							else{
								//L1A1 Language1
								if(empty($Lang1) && !empty($Language1)){
									$Cert1 = $value;
									$Lang1 = $value;
								}
								else if(empty($Lang2) && !empty($Language2)){
									$Cert2 = $value;
									$Lang2 = $value;
								}
								else if(empty($Lang3) && !empty($Language3)){
									$Cert3 = $value;
									$Lang3 = $value;
								}
							}
						}
					}
					//Check photo:
					//if(empty($avatar)){
						//$Avatar = file("images/Unknown.txt");
					//}
					//Ranking Position:
					$RankPos=0; $RankDeg=0; $RankLang=0;
					
					//Business Rank:
					if(!empty($BusinessP3)){
						$RankPos=3;
					}
					else if(!empty($BusinessP2)){
						$RankPos=2;
					}
					else if(!empty($BusinessP1)){
						$RankPos=1;
					}
					
					//Studies Rank:
					if(!empty($Studies3)){
						$RankDeg=3;
					}
					else if(!empty($Studies2)){
						$RankDeg=2;
					}
					else if(!empty($Studies1)){
						$RankDeg=1;
					}
					//Languages Eank:
					if(!empty($Cert3)){
						$RankLang=3;
					}
					else if(!empty($Cert2)){
						$RankLang=2;
					}
					else if(!empty($Cert1)){
						$RankLang=1;
					}
					
					$Ranking = ($RankPos*10) + ($RankDeg*15) + ($RankLang*5);
					
					
					/*echo $username, " ",$email, " ",$password, " ",$Name, " ",$Surname, " ",$National, " ",$City, $Avatar;
					" ",$Position, " ",$Company, " ",$Gender, " ",$Expertise, " ",$BusinessP1, " ",$BusinessP2, " ",$BusinessP3, " ",$Job, " ",$Studies1, " ",$Studies2, " ",$Studies3;
					echo"Lang Certificates:</br>";*/
					$Language1=$Language1." ".$Cert1;
					$Language2=$Language2." ".$Cert2;
					$Language3=$Language3." ".$Cert3;
					//echo $Language1 , "</br>";
					//echo $Language2, "</br>";
					//echo $Language3, "</br>";
					//echo $Ranking;
					
					mysqli_query(
						$linkDB, 
						"INSERT INTO user
							(username, email, password, name, surname, Gender, nationality, city, avatar,
							Expertise, Position, BusinessP1, BusinessP2, BusinessP3,
							company, job,
							degree1, degree2, degree3, 
							language1, language2, language3,
							Rank) 
						VALUES 
							('$username', '$email', '$password', '$Name', '$Surname', '$Gender', '$National', '$City', '$Avatar',
							'$Expertise','$Position', '$BusinessP1', '$BusinessP2', '$BusinessP3', 
							'$Company', '$Job', 
							'$Studies1', '$Studies2', '$Studies3', 
							'$Language1', '$Language2', '$Language3',
							'$Ranking');"
					);
					$registered = mysqli_affected_rows($linkDB);
					//echo $registered."welcome";
					if($registered == 1){
						header("Location: home.php");
					}
					else{
						echo "<script> alert('Oops, something went wrong. Please try again later') </script>";
					}
					
					
				}
				
			}
			
			
			function isOn($x){
				if($x){
					return true;
				}else{
					return false;
				}
			}
		?>
        <script>		
			var totalExpChecks = 0;
			var oldExpCheck;
			
			var totalBPchecks = 0;
			var oldBPchecks;
			
			var totalJobChecks = 0;
			var oldJobChecks;
			
			var totalStudiesChecks = 0;
			var oldStudiesChecks;
			
			var toalLanChecks1 = 0;
			var oldLanChecks1;
			
			var toalLanChecks2 = 0;
			var oldLanChecks2;
			
			var toalLanChecks3 = 0;
			var oldLanChecks3;
				
			function Submit(){
				var texts = checkTexts();
				var gender = checkGender();
				
			}
           function checkTexts(){
                var name = document.getElementById('name');
				var Surname = document.getElementById('Surname');
				var National = document.getElementById('National');
				var City = document.getElementById('City');
				var Position = document.getElementById('Position');
				var Company = document.getElementById('Company');

				var badColor = "#ff6666";
				var flag = true;;
                if(name.value == ""){
					name.style.backgroundColor = badColor;
					flag = false;
				}
				if(Surname.value == ""){
					Surname.style.backgroundColor = badColor;
					flag = false;
				}
				if(National.value == ""){
					National.style.backgroundColor = badColor;
					flag = false;
				}
				if(City.value == ""){
					City.style.backgroundColor = badColor;
					flag = false;
				}
				if(Position.value == ""){
					Position.style.backgroundColor = badColor;
					flag = false;
				}
				if(Company.value == ""){
					Company.style.backgroundColor = badColor;
					flag = false;
				}
				return flag;
            }  
			
			function checkMale(){
				var male = document.getElementsByName('Male');
				
				if(document.getElementById("Male").checked == true){
					document.getElementById("Female").checked = false;
					
					document.getElementsByName('Male').htmlFor = "Male";
					document.getElementsByName('Female').htmlFor = "undefined";
				}				
			}
			
			function checkFemale(){
				var female = document.getElementsByName('Female');
				
				if(document.getElementById("Female").checked == true){
					document.getElementById("Male").checked = false;
					
					document.getElementsByName('Male').htmlFor = "undefined";
					document.getElementsByName('Female').htmlFor = "Female";
				}				
			}
			
			function checkGender(){
				if(document.getElementsByName('Male').htmlFor == "undefined" || document.getElementsByName('Female').htmlFor == "undefined"){
					return false;
				}
				return true;
			}

			function isBusinessChecked(x){
				if(document.getElementById(x).checked == true && totalBPchecks < 3){
					oldExpCheck = x;
					totalBPchecks = totalBPchecks + 1;
					document.getElementsByName(x).htmlFor = x;
				}
				else if(document.getElementById(x).checked == false && totalBPchecks == 1){
					totalBPchecks = totalBPchecks - 1;
					document.getElementsByName(x).htmlFor = x;
				}
				else if(document.getElementById(x).checked == false && totalBPchecks == 2){
					totalBPchecks = totalBPchecks - 1;
					document.getElementsByName(x).htmlFor = x;
				}
				else if(document.getElementById(x).checked == false && totalBPchecks == 3){
					totalBPchecks = totalBPchecks - 1;
					document.getElementsByName(x).htmlFor = x;
				}
				else{
					document.getElementById(oldExpCheck).checked = false;
					document.getElementsByName(oldExpCheck).htmlFor = "undefined";
					oldExpCheck = x;
					document.getElementsByName(x).htmlFor = "undefined";
				}
			}
			
			function isStudiesChecked(x){

				if(document.getElementById(x).checked == true && totalStudiesChecks < 3){
					oldStudiesChecks = x;
					totalStudiesChecks = totalStudiesChecks + 1;
				}
				else if(document.getElementById(x).checked == false && totalStudiesChecks == 1){
					totalStudiesChecks = totalStudiesChecks - 1;
				}
				else if(document.getElementById(x).checked == false && totalStudiesChecks == 2){
					totalStudiesChecks = totalStudiesChecks - 1;
				}
				else if(document.getElementById(x).checked == false && totalStudiesChecks == 3){
					totalStudiesChecks = totalStudiesChecks - 1;
				}
				else{
					document.getElementById(oldStudiesChecks).checked = false;
					oldStudiesChecks = x;
					if(document.getElementById(x).checked == true && totalStudiesChecks == 1){
						totalStudiesChecks=0;
					}
				}	
			}
			
			function isJobChecked(x){

				if(document.getElementById(x).checked == true && totalJobChecks < 1){
					oldJobChecks = x;
					totalJobChecks = totalJobChecks + 1;
				}
				else if(document.getElementById(x).checked == false && totalJobChecks == 1){
					totalJobChecks = totalJobChecks - 1;
				}
				else{
					document.getElementById(oldJobChecks).checked = false;
					oldJobChecks = x;
				}	
			}
			
			function isExpChecked(x){

				if(document.getElementById(x).checked == true && totalExpChecks < 1){
					oldExpCheck = x;
					totalExpChecks = totalExpChecks + 1;
				}
				else if(document.getElementById(x).checked == false && totalExpChecks == 1){
					totalExpChecks = totalExpChecks - 1;
				}
				else{
					document.getElementById(oldExpCheck).checked = false;
					oldExpCheck = x;
				}	
			}
			function isLang1Checked(x){

				if(document.getElementById(x).checked == true && toalLanChecks1 < 1){
					oldLanChecks1 = x;
					toalLanChecks1 = toalLanChecks1 + 1;
				}
				else if(document.getElementById(x).checked == false && toalLanChecks1 == 1){
					toalLanChecks1 = toalLanChecks1 - 1;
				}
				else{
					document.getElementById(oldLanChecks1).checked = false;
					oldLanChecks1 = x;
				}	
			}
			
			function isLang2Checked(x){

				if(document.getElementById(x).checked == true && toalLanChecks2 < 1){
					oldLanChecks2 = x;
					toalLanChecks2 = toalLanChecks2 + 1;
				}
				else if(document.getElementById(x).checked == false && toalLanChecks2 == 1){
					toalLanChecks2 = toalLanChecks2 - 1;
				}
				else{
					document.getElementById(oldLanChecks2).checked = false;
					oldLanChecks2 = x;
				}	
			}
			
			function isLang3Checked(x){

				if(document.getElementById(x).checked == true && toalLanChecks3 < 1){
					oldLanChecks3 = x;
					toalLanChecks3 = toalLanChecks3 + 1;
				}
				else if(document.getElementById(x).checked == false && toalLanChecks3 == 1){
					toalLanChecks3 = toalLanChecks3 - 1;
				}
				else{
					document.getElementById(oldLanChecks3).checked = false;
					oldLanChecks3 = x;
				}	
			}

			function checkSpecialation(){
				//Environment SocialAdministration Arts Science Humanities Agriculture stockraising
				var freeze = false;
				var total = 0;
				var env = document.getElementsByName('Environment').checked;
				var socAdm = document.getElementsByName('SocialAdministration').checked;
				var arts = document.getElementsByName('Arts').checked;
				var scien = document.getElementsByName('Science').checked;
				var hum = document.getElementsByName('Humanities').checked;
				var argi = document.getElementsByName('Agriculture').checked;
				var stock = document.getElementsByName('stockraising').checked;
				
			}
			
        </script>
        <title>UotA Social Community</title>
        <link rel="icon" href="images/logo.png">
		<meta charset="UTF-8" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
		<link href="css/CheckBox.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    </head>
	<body>
	<form action="register2.php" method="post">
	    <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">

                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
            <header>
                <h1>University of the Aegean <span>Social Community</span> </h1>
				<a href="index.php"><img id="logo" class="center-block"  src = "images/logo.png"></a>
            </header>
            
			
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
						<div class="panel panel-default">
								<button name="Submit" id="Submit" class="btn btn-lg btn-primary btn-block" type="submit" onclick="Submit();">Register via LinkedIN</button>
								<label for="inputName" class="sr-only">Name</label>
								<input name="name" id="name" type="name" class="form-control" placeholder="name" required autofocus>
								<label for="inputSurname" class="sr-only">Surname</label>
								<input name="Surname" id="Surname" type="surname" class="form-control" placeholder="surname" required>
								<label for="National" class="sr-only">National</label>
								<input name="National" id="National" type="National" class="form-control" placeholder="National" required>
								<label for="City" class="sr-only">City/State</label>
								<input name="City" id="City" type="City" class="form-control" placeholder="City/State" required>
			 
								<label class="control-label">Upload your avatar</label>
								<input id="avatar" name="avatar" type="file" accept="image/*" multiple class="file-loading">
								<!-- Gender -->
								<div class="panel-heading">Gender</div>
								<ul class="list-group">
									<li class="list-group-item">
										Male
										<div class="material-switch pull-right">
											<input name="CheckBox[]" id="Male" value="Male" type="checkbox" onclick="checkMale();"/>
											<label for="Male" value="Female" class="label-primary"></label>
										</div>
									</li>
									<li class="list-group-item">
										Female
										<div class="material-switch pull-right">
											<input name="CheckBox[]" id="Female" value="Female" type="checkbox" onclick="checkFemale();"/>
											<label for="Female" class="label-info"></label>
										</div>
									</li>
								</ul>
								<!-- Expertise -->
								<div class="panel-heading">Expertise</div>
								<label for="Position" class="sr-only">Position</label>
								<input id="Position" name="Position" type="Position" class="form-control" placeholder="Position">
								<!-- List group -->
								<ul class="list-group">
									<li class="list-group-item">
										Environment
										<div class="material-switch pull-right">
											<input id="Environment" name="CheckBox[]" value="Environment" type="checkbox"  onclick="isExpChecked('Environment');"/>
											<label for="Environment" class="label-default"></label>
										</div>
									</li>
									<li class="list-group-item">
										Social-Administration
										<div class="material-switch pull-right">
											<input id="SocialAdministration" name="CheckBox[]" value="SocialAdministration" type="checkbox" onclick="isExpChecked('SocialAdministration');"/>
											<label for="SocialAdministration" class="label-primary"></label>
										</div>
									</li>
									<li class="list-group-item">
										Arts
										<div class="material-switch pull-right">
											<input id="Arts" name="CheckBox[]" value="Arts" type="checkbox" onclick="isExpChecked('Arts');"/>
											<label for="Arts" class="label-success"></label>
										</div>
									</li>
									<li class="list-group-item">
										Science
										<div class="material-switch pull-right">
											<input id="Science" name="CheckBox[]" value="Science" type="checkbox" onclick="isExpChecked('Science');"/>
											<label for="Science" class="label-info"></label>
										</div>
									</li>
									<li class="list-group-item">
										Humanities
										<div class="material-switch pull-right">
											<input id="Humanities" name="CheckBox[]" value="Humanities" type="checkbox" onclick="isExpChecked('Humanities');"/>
											<label for="Humanities" class="label-warning"></label>
										</div>
									</li>
									<li class="list-group-item">
										Agriculture
										<div class="material-switch pull-right">
											<input id="Agriculture" name="CheckBox[]" value="Agriculture" type="checkbox" onclick="isExpChecked('Agriculture');"/>
											<label for="Agriculture" class="label-danger"></label>
										</div>
									</li>
									<li class="list-group-item">
										Stock Raising
										<div class="material-switch pull-right">
											<input id="stockraising" name="CheckBox[]" value="Stock Raising" type="checkbox" onclick="isExpChecked('stockraising');"/>
											<label for="stockraising" class="label-primary"></label>
										</div>
									</li>
								</ul>

								
								
								<!-- Business Position -->
								<div class="panel-heading">Business Position</div>
								<label for="Company" class="sr-only">Company</label>
								<input id="Company" name="Company" type="Company" class="form-control" placeholder="Company">
								<ul class="list-group">
									<li class="list-group-item">
										Manager
										<div class="material-switch pull-right">
											<input id="Manager" name="CheckBox[]" value="Manager" type="checkbox" onclick="isBusinessChecked('Manager');"/>
											<label for="Manager" class="label-primary"></label>
										</div>
									</li>
									<li class="list-group-item">
										Academic
										<div class="material-switch pull-right">
											<input id="Academic" name="CheckBox[]" value="Academic" type="checkbox" onclick="isBusinessChecked('Academic');"/>
											<label for="Academic" class="label-success"></label>
										</div>
									</li>
									<li class="list-group-item">
										Chief
										<div class="material-switch pull-right">
											<input id="Chief" name="CheckBox[]" value="Chief" type="checkbox" onclick="isBusinessChecked('Chief');"/>
											<label for="Chief" class="label-info"></label>
										</div>
									</li>
									<li class="list-group-item">
										Self Employee
										<div class="material-switch pull-right">
											<input id="SelfEmployee" name="CheckBox[]" value="Self Employee" type="checkbox" onclick="isBusinessChecked('SelfEmployee');"/>
											<label for="SelfEmployee" class="label-warning"></label>
										</div>
									</li>
									<li class="list-group-item">
										Unemployed
										<div class="material-switch pull-right">
											<input id="Unemployed" name="CheckBox[]" value="Unemployed" type="checkbox" onclick="isBusinessChecked('Unemployed');"/>
											<label for="Unemployed" class="label-danger"></label>
										</div>
									</li>
								</ul>
								
								<!-- Job -->
								<div class="panel-heading">Job</div>
								<ul class="list-group">
									<li class="list-group-item">
										Civil Servant
										<div class="material-switch pull-right">
											<input id="CivilServant" name="CheckBox[]" value="Civil Servant" type="checkbox" onclick="isJobChecked('CivilServant');"/>
											<label for="CivilServant" class="label-primary"></label>
										</div>
									</li>
									<li class="list-group-item">
										Multinational Company
										<div class="material-switch pull-right">
											<input id="MultinationalCompany" name="CheckBox[]" value="Multinational Company" type="checkbox" onclick="isJobChecked('MultinationalCompany');"/>
											<label for="MultinationalCompany" class="label-success"></label>
										</div>
									</li>
									<li class="list-group-item">
										Middle-class Business
										<div class="material-switch pull-right">
											<input id="MiddleClassBusiness" name="CheckBox[]" value="Middle-class Business" type="checkbox" onclick="isJobChecked('MiddleClassBusiness');"/>
											<label for="MiddleClassBusiness" class="label-info"></label>
										</div>
									</li>
									<li class="list-group-item">
										Small or Personal Business
										<div class="material-switch pull-right">
											<input id="SmallOrPersonalBusiness" name="CheckBox[]" value="Small or Personal Business" type="checkbox" onclick="isJobChecked('SmallOrPersonalBusiness');"/>
											<label for="SmallOrPersonalBusiness" class="label-warning"></label>
										</div>
									</li>
									<li class="list-group-item">
										Non-Governmental Organization
										<div class="material-switch pull-right">
											<input id="NonGovernmentalOrganization" name="CheckBox[]" value="Non-Governmental Organization" type="checkbox" onclick="isJobChecked('NonGovernmentalOrganization');"/>
											<label for="NonGovernmentalOrganization" class="label-danger"></label>
										</div>
									</li>
								</ul>
								
								<!-- Studies -->
								<div class="panel-heading">Studies</div>
								<ul class="list-group">
									<li class="list-group-item">
										Technological Educational Institute
										<div class="material-switch pull-right">
											<input id="tei" name="CheckBox[]" type="checkbox" value="Technological Educational Institute" onclick="isStudiesChecked('tei');"/>
											<label for="tei" class="label-primary"></label>
										</div>
									</li>
									<li class="list-group-item">
										University Degree
										<div class="material-switch pull-right">
											<input id="aei" name="CheckBox[]" type="checkbox" value="University Degree" onclick="isStudiesChecked('aei');"/>
											<label for="aei" class="label-success"></label>
										</div>
									</li>
									<li class="list-group-item">
										Master
										<div class="material-switch pull-right">
											<input id="master" name="CheckBox[]" type="checkbox" value="Master" onclick="isStudiesChecked('master');"/>
											<label for="master" class="label-info"></label>
										</div>
									</li>
									<li class="list-group-item">
										PhD
										<div class="material-switch pull-right">
											<input id="phd" name="CheckBox[]" type="checkbox" value="PhD" onclick="isStudiesChecked('phd');"/>
											<label for="phd" class="label-warning"></label>
										</div>
									</li>
								</ul>
								
								<!-- Languages -->
								<div class="panel-heading">Languages</div>
								<ul class="list-group">
									<label for="Language1" class="sr-only">Language 1</label>
									<input id="Language1" name="Language1" type="Language" class="form-control" placeholder="Language 1">
									<li class="list-group-item"> 
										A1
										<div class="material-switch pull-right">
											<input id="L1A1" name="CheckBox[]" value="A1" type="checkbox" onclick="isLang1Checked('L1A1');"/>
											<label for="L1A1" class="label-info"></label>
										</div>
									</li>
									<li class="list-group-item">
										A2
										<div class="material-switch pull-right">
											<input id="L1A2" name="CheckBox[]" value="A2" type="checkbox" onclick="isLang1Checked('L1A2');"/>
											<label for="L1A2" class="label-info"></label>
										</div>
									</li>
									<li class="list-group-item">
										B1
										<div class="material-switch pull-right">
											<input id="L1B1" name="CheckBox[]" value="B1" type="checkbox" onclick="isLang1Checked('L1B1');"/>
											<label for="L1B1" class="label-warning"></label>
										</div>
									</li>
									<li class="list-group-item">
										B2
										<div class="material-switch pull-right">
											<input id="L1B2" name="CheckBox[]" value="B2" type="checkbox" onclick="isLang1Checked('L1B2');"/>
											<label for="L1B2" class="label-warning"></label>
										</div>
									</li>
									<li class="list-group-item">
										C1
										<div class="material-switch pull-right">
											<input id="L1C1" name="CheckBox[]" value="C1" type="checkbox" onclick="isLang1Checked('L1C1');"/>
											<label for="L1C1" class="label-danger"></label>
										</div>
									</li>
									<li class="list-group-item">
										C2
										<div class="material-switch pull-right">
											<input id="L1C2" name="CheckBox[]" value="C2" type="checkbox" onclick="isLang1Checked('L1C2');"/>
											<label for="L1C2" class="label-danger"></label>
										</div>
									</li>
									
									<label for="Language2" class="sr-only">Language 2</label>
									<input id="Language2" name="Language2" type="Language" class="form-control" placeholder="Language 2">
									<li class="list-group-item">
										A1
										<div class="material-switch pull-right">
											<input id="L2A1" name="CheckBox[]" value="A1"  type="checkbox" onclick="isLang2Checked('L2A1');"/>
											<label for="L2A1" class="label-info"></label>
										</div>
									</li>
									<li class="list-group-item">
										A2
										<div class="material-switch pull-right">
											<input id="L2A2" name="CheckBox[]" value="A2" type="checkbox" onclick="isLang2Checked('L2A2');"/>
											<label for="L2A2" class="label-info"></label>
										</div>
									</li>
									<li class="list-group-item">
										B1
										<div class="material-switch pull-right">
											<input id="L2B1" name="CheckBox[]" value="B1" type="checkbox" onclick="isLang2Checked('L2B1');"/>
											<label for="L2B1" class="label-warning"></label>
										</div>
									</li>
									<li class="list-group-item">
										B2
										<div class="material-switch pull-right">
											<input id="L2B2" name="CheckBox[]" value="B2" type="checkbox" onclick="isLang2Checked('L2B2');"/>
											<label for="L2B2" class="label-warning"></label>
										</div>
									</li>
									<li class="list-group-item">
										C1
										<div class="material-switch pull-right">
											<input id="L2C1" name="CheckBox[]" value="C1" type="checkbox" onclick="isLang2Checked('L2C1');"/>
											<label for="L2C1" class="label-danger"></label>
										</div>
									</li>
									<li class="list-group-item">
										C2
										<div class="material-switch pull-right">
											<input id="L2C2" name="CheckBox[]" value="C2" type="checkbox" onclick="isLang2Checked('L2C2');"/>
											<label for="L2C2" class="label-danger"></label>
										</div>
									</li>
								</ul>
								
								<label for="Language3" class="sr-only">Language 3</label>
								<input id="Language3" name="Language3" type="Language" class="form-control" placeholder="Language 3">
									<li class="list-group-item">
										A1
										<div class="material-switch pull-right">
											<input id="L3A1" name="CheckBox[]" value="A1" type="checkbox" onclick="isLang3Checked('L3A1');"/>
											<label for="L3A1" class="label-info"></label>
										</div>
									</li>
									<li class="list-group-item">
										A2
										<div class="material-switch pull-right">
											<input id="L3A2" name="CheckBox[]" value="A2" type="checkbox" onclick="isLang3Checked('L3A2');"/>
											<label for="L3A2" class="label-info"></label>
										</div>
									</li>
									<li class="list-group-item">
										B1
										<div class="material-switch pull-right">
											<input id="L3B1" name="CheckBox[]" value="B1" type="checkbox" onclick="isLang3Checked('L3B1');"/>
											<label for="L3B1" class="label-warning"></label>
										</div>
									</li>
									<li class="list-group-item">
										B2
										<div class="material-switch pull-right">
											<input id="L3B2" name="CheckBox[]" value="B2" type="checkbox" onclick="isLang3Checked('L3B2');"/>
											<label for="L3B2" class="label-warning"></label>
										</div>
									</li>
									<li class="list-group-item">
										C1
										<div class="material-switch pull-right">
											<input id="L3C1" name="CheckBox[]" value="C1" type="checkbox" onclick="isLang3Checked('L3C1');"/>
											<label for="L3C1" class="label-danger"></label>
										</div>
									</li>
									<li class="list-group-item">
										C2
										<div class="material-switch pull-right">
											<input id="L3C2" name="CheckBox[]" value="C2" type="checkbox" onclick="isLang3Checked('L3C2');"/>
											<label for="L3C2" class="label-danger"></label>
										</div>
									</li>
									<button name="Submit" id="Submit" class="btn btn-lg btn-primary btn-block" type="submit" onclick="Submit();">Submit</button>
							</div>
						
                    </div>
                </div>
            </div>
        </div>
		</form>
    </body>
</html>