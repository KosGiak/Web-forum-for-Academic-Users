<html lang="en" class="no-js"> <!--<![endif]-->
    <head>
	<?php
		session_start();
		
		include ('connectDB.php');
		if(!isset($_SESSION['id'])){
				header("Location: viewPost.php");
				echo 'Seomthing is wrong with your registation. Try again...!!!! :(';
		}
		else
		{
			echo"</br></br></br>";
			  if ($_GET['fn'] == "CurPost"){
				 if (!empty($_GET['id'])){
					 $tempID = $_GET['id'];
					//echo "user id pu thelw na dw ta post: ", $tempID;
					$sql = 
					"SELECT * FROM user, post 
					WHERE 
					user.id='$tempID' && user.id=post.user_id";
					$result = $linkDB->query($sql);
					FixTimeLine($result);
				 }
			  }
		}
		
		function FixTimeLine($result){
			if ($result->num_rows > 0) {
						
						echo "<div class=\"container\">
							  <div class=\"row\">
								<div class=\"col-lg-12\">
								<ul class=\"timeline\">";
								
								
								
								$sum = 0;
								while($row = $result->fetch_assoc()){
									//User Table:
									$_SESSION["id"] = $row["id"];
										$id = $_SESSION["id"];
									$_SESSION["name"] = $row["name"];
										$name = $_SESSION["name"];
									$_SESSION["surname"] = $row["surname"];
										$surname = $_SESSION["surname"];
									$_SESSION["Gender"] = $row["Gender"];
										$Gender = $_SESSION["Gender"];
									$_SESSION["nationality"] = $row["nationality"];
										$Nation = $_SESSION["nationality"];			
									$_SESSION["avatar"] = $row["avatar"];	
										$avatar = $_SESSION["avatar"];
									$_SESSION["city"] = $row["city"];	
										$city = $_SESSION["city"];
									$_SESSION["Expertise"] = $row["Expertise"];	
										$Expertise = $_SESSION["Expertise"];
									$_SESSION["Position"] = $row["Position"];	
										$Position = $_SESSION["Position"];
									$_SESSION["BusinessP1"] = $row["BusinessP1"];
										$BusinessP1 = $_SESSION["BusinessP1"];
									$_SESSION["BusinessP2"] = $row["BusinessP2"];	
										$BusinessP2 = $_SESSION["BusinessP2"];
									$_SESSION["BusinessP3"] = $row["BusinessP3"];
										$BusinessP3 = $_SESSION["BusinessP3"];
									$_SESSION["company"] = $row["company"];
										$company = $_SESSION["company"];
									$_SESSION["job"] = $row["job"];	
										$job = $_SESSION["job"];
									$_SESSION["degree1"] = $row["degree1"];	
										$degree1 = $_SESSION["degree1"];
									$_SESSION["degree2"] = $row["degree2"];	
										$degree2 = $_SESSION["degree2"];
									$_SESSION["degree3"] = $row["degree3"];	
										$degree3 = $_SESSION["degree3"];
									$_SESSION["language1"] = $row["language1"];	
										$language1 = $_SESSION["language1"];
									$_SESSION["language2"] = $row["language2"];	
										$language2 = $_SESSION["language2"];
									$_SESSION["language3"] = $row["language3"];	
										$language3 = $_SESSION["language3"];
									$_SESSION["Rank"] = $row["Rank"];	
										$Rank = $_SESSION["Rank"];
									//Post Table:
									$_SESSION["StartDate"] = $row["StartDate"];
										$Date1=$_SESSION["StartDate"];
									$_SESSION["EndDate"] = $row["EndDate"];
										$Date2=$_SESSION["EndDate"];
									$_SESSION["Title"] = $row["Title"];
										$Title = $_SESSION["Title"];
									$_SESSION["Author"] = $row["Author"];
										$Author = $_SESSION["Author"];
									$_SESSION["linkPDF"] = $row["linkPDF"];
										$LinkPDF = $_SESSION["linkPDF"];
									$_SESSION["FilePDF"] = $row["FilePDF"];
										$FilePDF = $_SESSION["FilePDF"];
									$_SESSION["Category"] = $row["Category"];
										$Category = $_SESSION["Category"];
									$_SESSION["Description"] = $row["Description"];
										$Description = $_SESSION["Description"];
								
									
												
									

									if($sum == 0){			
										echo "
														
															<li>
															  <div class=\"timeline-image\">
																<a href=".'viewPost.php?fn=CurPost&id='.$id." name=".'viewpost'.">
																<img style=\"width:200; height:190;\" class=\"img-circle img-responsive\" src=\"images/" .  $avatar  . "\">
																</a>
															  </div>
															  <div class=\"timeline-panel\">
																<div class=\"timeline-heading\">
																  <h4>".$name." ".$surname."</h4>
																  <h4 class=\"subheading\">".$Nation.", ".$city."</h4>
																</div>
																<div class=\"timeline-body\">
																  <p class=\"text-muted\">
																	Ranking Points: ".$Rank.", Expertise: ".$Expertise.",Position: ".$BusinessP1." ".$BusinessP2." ".$BusinessP3.","."
																	Company: ".$company.", Job: ".$job.",Degree: ".$degree1." ".$degree2." ".$degree3.","."
																	Language: ".$language1." ".$language2." ".$language3."
																  </p>
																</div>
																
															  </div>
															</li></br></br></br>";
									}
									
										echo"					<li>
																
																  <h4>".$Title."</h4>
																  <h4 class=\"subheading\">".$Category.", ".$Author."</h4>
																<div class=\"timeline-body\">
																  <p class=\"text-muted\">
																	Date: ".$Date1." - ".$Date2.", PDF: ".$LinkPDF." ".$FilePDF."
																	Description: ".$Description."
																  </p>
																</div>
																</li>";
									
									
									$sum++;																
								}
								echo		"</ul>
												</div>
											</div>
											</div>		
											";	
					}
					else{
						echo "<script>
							alert('This user has no post. :(');
							window.location.href='home.php';
							</script>";
					}
		}
	?>
        <title>UotA Social Community</title>
		<link rel="icon" href="images/logo.png">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/timeLine.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!--Background img: -->
		<link href="css/topFooter.css" rel="stylesheet">
    </head>
	<body>
	
		<div class="navbar navbar-default navbar-fixed-top" role="navigation" id="slide-nav">
		
		<div class="container">
		 <div class="navbar-header">
		  <a class="navbar-toggle"> 
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		   </a>
		   <a href="home.php"><img id="logo" class="navbar-brand"  src = "images/logo.png"></a>
		  
		 </div>
		 <div id="slidemenu">
				<form action="home.php" method="post" class="navbar-form navbar-right" role="form">
				  <div class="form-group">
					<input name="search" id="search" type="search" placeholder="search" class="form-control">
				  </div>
				  <button name="searchB" id="searchB"type="submit" class="btn btn-primary">Search</button>
				</form>
	 
		  <ul class="nav navbar-nav">
		   <li><a href="home.php">Home</a></li>
		   <li><a href="newProcess.php">Create new process</a></li>
		   <li><a href="editProfile.php">Edit your Profile</a></li>
		   <li><a href="logout.php">Logout</a></li>
		   
		  </ul>          
		 </div>
		</div>
	  </div>
	 </body>
</html>
