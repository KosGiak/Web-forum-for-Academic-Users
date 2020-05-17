<html lang="en" class="no-js"> <!--<![endif]-->
    <head>
	<?php
			session_start();
			include ('connectDB.php');
			if(!isset($_SESSION['email'])){
				header("Location: index.php");
			}else{
				if ($_SERVER['REQUEST_METHOD'] == "POST" && (isset($_POST['Share']))) {
					$email = $_SESSION['email'];
					$sql = 
					"SELECT id FROM user 
					WHERE 
					email='$email'";
					$result = $linkDB->query($sql);
					$row = $result->fetch_assoc();
					$_SESSION["id"] = $row["id"];
						$user_id = $_SESSION["id"];
					$Date1 = mysqli_real_escape_string($linkDB, $_POST['Date1']);
					$Date2 = mysqli_real_escape_string($linkDB, $_POST['Date2']);
					$Title = mysqli_real_escape_string($linkDB, $_POST['Title']);
					$Author = mysqli_real_escape_string($linkDB, $_POST['Author']);
					$LinkPDF = mysqli_real_escape_string($linkDB, $_POST['pdfLink']);
					$FilePDF = mysqli_real_escape_string($linkDB, $_POST['pdf']);
					$Descr = mysqli_real_escape_string($linkDB, $_POST['tweet']);
					if(empty($FilePDF)){
						$FilePDF = null;
					}
					else if(empty($LinkPDF)){
						$LinkPDF = null;
					}

					if(empty($_POST['CheckBox'])){
						echo "<script> alert('You must select a Category') </script>";
					}
					else{
						$box = $_POST['CheckBox'];
						if(empty($Date1)){
							$Date1 = date("Y-m-d") . "<br>";
						}
						if(FixDate($Date2)!=1){
							echo "<script> alert('Wrong Date') </script>";
						}
						else{
							if($Date2<$Date1){
								echo "<script> alert('Wrong Dates') </script>";
							}
							if(isset($_POST['CheckBox'])) {
								foreach ($box as $value){
									if(!empty($value)){
										break;
									}
								}
								
							echo "User ID: ", $user_id,"</br>", "Email: ",$email,"</br>", "Date1: ",$Date1,"</br>", "Date2: ",$Date2,"</br>";
							echo "Title: ",$Title,"</br>", "Author: ",$Author,"</br>", "LinkPDF: ",$LinkPDF,"</br>", "FilePDF: ",$FilePDF,"</br>";
							echo "Category: ",$value,"</br>", "Tweet: ",$Descr;
							
								mysqli_query(
									$linkDB, 
									"INSERT INTO post
										(user_id, email, StartDate, EndDate, Title, Author, linkPDF, FilePDF, Category, Description) 
									VALUES 
										('$user_id', '$email', '$Date1', '$Date2', '$Title', '$Author', '$LinkPDF', '$FilePDF', '$value', '$Descr')"
								);
								$registered = mysqli_affected_rows($linkDB);
							echo $registered;
							if($registered == 1){
								header("Location: home.php");
							}
							else{
								echo "<script> alert('Oops, something went wrong. Please try again later') </script>";
							}


					}	
						}
					}						
				}
			}
			
			function FixDate($Date){
				if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$Date))
				{
					return true;
				}else{
					return false;
				}
			}
			

	?>
	<script>
	totalProcChecks=0;
	oldProcChecks;
	function isProcChecked(x){
		
		if(document.getElementById(x).checked == true && totalProcChecks < 1){
			oldProcChecks = x;
			totalProcChecks = totalProcChecks + 1;
		}
		else if(document.getElementById(x).checked == false && totalProcChecks == 1){
			totalProcChecks = totalProcChecks - 1;
		}
		else{
			document.getElementById(oldProcChecks).checked = false;
			oldProcChecks = x;
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
		<link href="css/CheckBox.css" rel="stylesheet">
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
				<a href="home.php"><img id="logo" class="center-block"  src = "images/logo.png"></a>
            </header>
            
		<form action="newProcess.php" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                        <div class="panel panel-default">
                            <label for="Title" class="sr-only">Title</label>
                            <input name="Title" id="Title" type="Title" class="form-control" placeholder="Title" required autofocus>
							<label for="Author" class="sr-only">Author</label>
                            <input name="Author" id="Author" type="Author" class="form-control" placeholder="Author" required>
							<label for="Date1" class="sr-only">Date</label>
                            <input name="Date1" id="Date1" type="date" class="form-control" placeholder="Start Date (YYYY/MM/DD)">
							<label for="Date1" class="sr-only">Date</label>
                            <input name="Date2" id="Date2" type="date" class="form-control" placeholder="End Date (YYYY/MM/DD)" required>
							<label for="pdfLink" class="sr-only">PDF Link</label>
                            <input name="pdfLink" id="pdfLink" type="link" class="form-control" placeholder="PDF Link">
							<label class="control-label">Upload your pdf</label>
                            <input name="pdf" id="pdf" type="file" multiple class="file-loading">
                            
                            
                            <!-- Category -->
                            <div class="panel-heading">Category</div>
                            <label for="Category" class="sr-only">Category</label>
                            <!-- List group -->
                            <ul class="list-group">
                                <li class="list-group-item">
                                    Science Article
                                    <div class="material-switch pull-right">
                                        <input name="CheckBox[]" id="ScienceArticle" value="Science Article" type="checkbox" onclick="isProcChecked('ScienceArticle');"/>
                                        <label for="ScienceArticle" class="label-default"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Public Authority
                                    <div class="material-switch pull-right">
                                        <input name="CheckBox[]" id="PublicAuthority" value="Public Authority" type="checkbox" onclick="isProcChecked('PublicAuthority');"/>
                                        <label for="PublicAuthority" class="label-primary"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Company Documents
                                    <div class="material-switch pull-right">
                                        <input name="CheckBox[]" id="CompanyDocuments" value=" Company Documents" type="checkbox" onclick="isProcChecked('CompanyDocuments');"/>
                                        <label for="CompanyDocuments" class="label-success"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Personal Opinion/Blog
                                    <div class="material-switch pull-right">
                                        <input name="CheckBox[]" id="PersonalOpinion" value="Personal Opinion/Blog" type="checkbox" onclick="isProcChecked('PersonalOpinion');"/>
                                        <label for="PersonalOpinion" class="label-info"></label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    Other
                                    <div class="material-switch pull-right">
                                        <input name="CheckBox[]" id="Other" value="Other" type="checkbox" onclick="isProcChecked('Other');"/>
                                        <label for="Other" class="label-warning"></label>
                                    </div>
                                </li>
								<div class="row">
    
									<div class="col-md-6">
										<div class="widget-area no-padding blank">
											<div class="status-upload">
												
													<textarea name="tweet" id="tweet" placeholder="Write a description" required></textarea>
												
											</div><!-- Status Upload  -->
										</div><!-- Widget Area -->
									</div>
        
								</div>
								
                            </ul>
							<button name="Share" class="btn btn-lg btn-primary btn-block" type="Share">Share</button>
                        </div>            
                    </div>
                </div>
            </div>
		</form>
        </div>
    </body>
</html>